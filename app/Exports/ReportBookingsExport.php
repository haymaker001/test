<?php

namespace App\Exports;

use Auth;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportBookingsExport implements FromView, ShouldAutoSize
{
    protected $customer_id;
    protected $vehicle_id;
    protected $center_id;
    protected $from;
    protected $to;

    function __construct($from, $to, $center_id, $vehicle_id, $customer_id)
    {
        $this->customer_id = $customer_id;
        $this->vehicle_id = $vehicle_id;
        $this->center_id = $center_id;
        $this->from = $from;
        $this->to = $to;
    }

    function view(): View
    {
        $purchases = array();
        
        $from = $this->from . " 00:00:00";
        $to   = $this->to   . " 23:59:59";
        
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '2048M');
        set_time_limit(300);
        
        $bookings = Booking::whereBetween('pickup', [$from, $to]);

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $bookings = $bookings->where('user_id', Auth::user()->id);
        
        if ($this->vehicle_id != "") {
            $bookings = $bookings->where("vehicle_id", $this->vehicle_id);
        }
        if ($this->customer_id != "") {
            $bookings = $bookings->where("customer_id", $this->customer_id);
        }
        if ($this->center_id != "") {
            $bookings = $bookings->where("center_id", $this->center_id);
        }
        $bookings = $bookings->get();
        
        //Locations
        $locationList = Location::all();
        foreach($bookings as $booking){
            $locationsName = array();
            $locations = $booking->locations;
            
            if($locations != null){
                foreach(explode(",", $locations) as $location){
                    $location = $locationList->where('id', $location)->first();
                    if($location != null)
                        array_push($locationsName, $location->location);
                }
            }
            $booking->locations = implode(",", $locationsName);
        }
        
        //dd($data['bookings'][0]);
        
        return view('exports.bookings', [
            'bookings' => $bookings,
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }
}
