<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Rate;
use App\Models\Center;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Location;
use App\Models\WorkOrder;
use App\Models\TravelType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

use Illuminate\Support\Facades\Gate;

class WorkOrderController extends Controller
{
    private $locationList;

    function __construct()
    {
        $this->locationList = Location::all();
    }

    public function index()
    {

        //if(Gate::denies('Gestionar Conduces'))
        //    abort(401);

        $bookings = WorkOrder::orderBy('id', 'DESC')->paginate(10);
        return view('work-orders.index', compact('bookings'));
    }

    public function create()
    {
        //if(Gate::denies('Nuevo Conduce'))
        //    abort(401);

        $customers = User::where('user_type', 'customer')->get();
        return view('work-orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'pickup' => 'required|date',
            'dropoff' => 'required|date',
        ]);

        $locations = implode(',', $request->locations);

        $booking = new WorkOrder;
        $booking->fill($data);
        $booking->status = 'REGISTRADO';
        $booking->locations = $locations;
        $booking->user_id = Auth::user()->id;
        $booking->save();
        
        $booking->number = 'WO' . $booking->id;
        $booking->save();
    }

    public function edit(WorkOrder $work_order)
    {
        $booking = $work_order;
        $vehicles = Vehicle::get();
        $drivers = User::where('user_type', 'driver')->get();
        $customers = User::where('user_type', 'customer')->get();
        return view('work-orders.edit', compact('booking', 'customers', 'drivers', 'vehicles'));
    }

    public function update(Request $request, WorkOrder $work_order)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'pickup' => 'required|date',
            'dropoff' => 'required|date',
            //'vehicle_id' => 'required|integer|exists:vehicles,id',
            //'driver_id' => 'required|integer|exists:users,id',
        ]);
        
        $locations = implode(',', $request->locations);
        $booking = $work_order;
        $booking->fill($data);
        $booking->locations = $locations;
        $booking->save();
    }

    function destroy(WorkOrder $work_order)
    {
        $work_order->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $sort_by = $request->get('sort_by');
            $sort_type = $request->get('sort_type');
            $filter = str_replace("%", " ", $filter);
            
            //if search has filters.
            if(isset($sort_by) && isset($sort_type))
            {
                $data = $request->validate([
                    //list of columns to be filter in order to avoid sql injection
                    'sort_by' => 'nullable|string|in:customer_id,pickup,center_id,vehicle_id,driver_id,helper,travellers',
                    'sort_type' => 'required|string|in:asc,desc',
                ]);
                
                $sort_by = $request->get('sort_by');
                $sort_type = $request->get('sort_type');
                
                $bookings = Booking::where('dolly', 'like', '%' . $filter . '%')
                ->orWhere('travellers', 'like', '%' . $filter . '%')
                ->orwhereHas('customer', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('center', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('vehicle', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('driver', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('travel_type', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy($sort_by, $sort_type)->paginate(10);
            }
            else
            {
                $bookings = Booking::where('dolly', 'like', '%' . $filter . '%')
                ->orWhere('travellers', 'like', '%' . $filter . '%')
                ->orwhereHas('customer', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('center', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('vehicle', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('driver', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('travel_type', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);
            }
                
            return view('dynamics.work-orders', compact('bookings'))->render();
        }
    }

    //helpers
    function assign_driver($id)
    {
        $id = intval($id);
        $work_order = WorkOrder::findOrFail($id);
        $vehicles = Vehicle::get();
        $drivers = User::where('user_type', 'driver')->get();
        return view('modals.assign-driver', compact('work_order', 'vehicles', 'drivers'));
    }
    
    
    function assign_driver_store(Request $request)
    {
        $data = $request->validate([
            'work_order_id' => 'required|integer|exists:work_orders,id',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'driver_id' => 'required|integer|exists:users,id',
        ]);
        $booking = WorkOrder::findOrFail($request->work_order_id);
        $booking->vehicle_id = $request->vehicle_id;
        $booking->driver_id = $request->driver_id;
        $booking->status = 'ASIGNADO';
        $booking->save();
    }
    
    function convert_to_booking(WorkOrder $work_order)
    {
        $booking = $work_order;
        $vehicles = Vehicle::get();
        $travel_types = TravelType::get();
        $vehicle_types = $this->truck_types();
        $drivers = User::where('user_type', 'driver')->get();
        $customers = User::where('user_type', 'customer')->get();
        return view('work-orders.convert', compact('booking', 'customers', 'drivers', 'vehicles', 'vehicle_types', 'travel_types'));
    }
    
    function convert_to_booking_store(Request $request)
    {
        
    }
}
