<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startDate = $now->copy()->subMonths(3)->startOfMonth()->toDateString();
        
        $lastMonthDay = date('t'); // Obtén el último día del mes actual
        $endDate = date('Y-m-d', strtotime(date('Y-m').'-'.$lastMonthDay));
        
        $startDate = $startDate . " 00:00:00";
        $endDate   = $endDate   . " 23:59:59";
        
        $bookings = Booking::whereBetween('pickup', [$startDate, $endDate])
            ->orderBy('id', 'DESC')
            ->get(['customer_id', 'pickup', 'locations', 'driver_id', 'rate', 'center_id', 'additionals', 'vehicle_type_id', 'travel_type_id']);


        $formattedBookings = $bookings->map(function ($booking) {
            return [
                'costumer_name' => $booking->customer->name,
                'pickup' => $booking->pickup,
                'locations' => $booking->locations,
                'driver' => $booking->driver->name,
                'rate' => $booking->rate,
                'center_name' => $booking->center->name,
                'additionals' => $booking->additionals,
                'vehicle_type_name' => $booking->vehicle_type_name,
                'travel_type_name' => $booking->travel_type->name,
            ];
        });

        return $formattedBookings;
    }

    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->name = $request->booking["name"];
        $booking->customer_id = $request->booking["customer_id"];
        $booking->save();
        return $booking;
    }

    public function update(UpdateCenterRequest $request, $id)
    {
        $id = intval($id);
        $booking = Booking::where('id', $id)->first();

        if ($booking) {
            $booking->name = $request->booking["name"];
            $booking->customer_id = $request->booking["customer_id"];
            $booking->save();
            return $booking;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $booking = Booking::where('id', $id)->first();

        if ($booking) {
            $booking->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
