<?php

namespace App\Exports;

use Auth;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BookingsExport implements FromView, ShouldAutoSize
{
    protected $bookings;
    protected $from;
    protected $to;

    function __construct($bookings)
    {
        $this->bookings = $bookings;
        $this->from = $from;
        $this->to = $to;
    }

    function view(): View
    {
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '2048M');
        set_time_limit(300);
        
        return view('exports.bookings-excel', [
            'bookings' => $bookings,
            'from' => $this->from,
            'to' => $this->to,
        ]);
    }
}
