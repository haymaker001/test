<?php

namespace App\Http\Controllers;
use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Rate;
use App\Models\WorkOrder;
use App\Models\Center;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Location;
use App\Models\TravelType;
use App\Models\Subcontractor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    private $locationList;

    function __construct()
    {
        $this->locationList = Location::all();
    }

    public function index()
    {

        if(Gate::denies('Gestionar Conduces'))
            abort(401);
            
        if (intval(Auth::user()->customer_id) == 0)
            $bookings = Booking::orderBy('id', 'DESC')->paginate(10);
        else
            $bookings = Booking::where('customer_id', intval(Auth::user()->customer_id))->orderBy('id', 'DESC')->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        if(Gate::denies('Nuevo Conduce'))
            abort(401);

        $vehicles = Vehicle::get();
        $travel_types = TravelType::get();
        $vehicle_types = $this->truck_types();
        $subcontractors = Subcontractor::get();
        $drivers = User::where('user_type', 'driver')->get();
        $customers = User::where('user_type', 'customer')->get();
        return view('bookings.create', compact('customers', 'drivers', 'vehicles', 'vehicle_types', 'travel_types', 'subcontractors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'pickup' => 'required|date',
            'dropoff' => 'required|date',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'driver_id' => 'required|integer|exists:users,id',
            'helper' => 'nullable|string',
            'travellers' => 'nullable|string',
            'container' => 'nullable|string',
            'dolly' => 'nullable|string',
            'diet' => 'nullable|numeric|min:0',
            'vehicle_type_id' => 'required|integer|min:1',
            'travel_type_id' => 'required|integer|exists:travel_types,id',
            'attachment' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf',
            'note' => 'nullable|string',
            'package' => 'nullable|string',
            'license_plate' => 'nullable|string',
            'subcontractor_id' => 'nullable|integer|exists:subcontractors,id',
            'work_order_id' => 'nullable|integer|exists:work_orders,id',
        ]);
        
        DB::transaction(function() use ($request, $data)
        {
            $booking = new Booking;
            $booking->fill($data);
            $booking->user_id = Auth::user()->id;
            $booking->save();
    
            $higestRate = 0;
    		$higestRateOutSource = 0;						 
            $locationList = $this->locationList;
            $location_id = $request->locations;
            $location_id = $location_id[0] ?? 0;
            $locations = implode(',', $request->locations);
            
            $customer = User::findOrFail($request->customer_id);
            
            if($customer->calculation_type == 'cantidad_destinos')
            {
                $rate = Rate::where('location_id', $location_id)
                        ->where('center_id',   $request->center_id)
                        ->where('customer_id', $request->customer_id)
                        ->where('travel_type_id', $request->travel_type_id)
                        ->where('vehicle_type_id', $request->vehicle_type_id)->first();
            
                $higestRate = $rate->rate ?? 0;
    			$higestRateOutSource = $rate->rate_outsource ?? 0;												  
                $rates = collect();
    			$rateOutSource = collect();						   
                if(count($request->locations) > 0)
                {
                    foreach(explode(",", $locations) as $location){
                        $actual_location = $locationList->where('id', $location)->first();
                        if($actual_location->is_active)
                        {
                            $rate = Rate::where('location_id', $location)
                                ->where('center_id',   $request->center_id)
                                ->where('customer_id', $request->customer_id)
                                ->where('travel_type_id', $request->travel_type_id)
                                ->where('vehicle_type_id', $request->vehicle_type_id)->first();
                        
                            //validar que los adicionales no sean sumados a la Tarifa
                            $validation = $actual_location->location_type == 'PD';
                            
    						$rateVal = ($rate != null) ? floatval($rate->rate) : 0;
                            $rate_outsource = ($rate != null) ? floatval($rate->rate_outsource) : 0;
                            
                            if(!$validation)
                                $rates->push($rateVal);
                                
                            if(!$validation)
                                $rateOutSource->push($rate_outsource);
                        }
                    }   
                }
                
                $higestRate = $rates->sum();
    			$higestRateOutSource = $rateOutSource->sum();
            }
            else
            {
                $rate = Rate::where('location_id', $location_id)
                        ->where('center_id',   $request->center_id)
                        ->where('customer_id', $request->customer_id)
                        ->where('travel_type_id', $request->travel_type_id)
                        ->where('vehicle_type_id', $request->vehicle_type_id)->first();
            
                $higestRate = $rate->rate ?? 0;
    			$higestRateOutSource = $rate->rate_outsource ?? 0;												  
    			
                $rates = collect();
    			$rateOutSource = collect();						   
    			
                if(count($request->locations) > 1)
                {
                    foreach(explode(",", $locations) as $location){
                        $actual_location = $locationList->where('id', $location)->first();
                        if($actual_location->is_active){
                            $rate = Rate::where('location_id', $location)
                                ->where('center_id',   $request->center_id)
                                ->where('customer_id', $request->customer_id)
                                ->where('travel_type_id', $request->travel_type_id)
                                ->where('vehicle_type_id', $request->vehicle_type_id)->first();
                        
                            $rateVal = ($rate != null) ? floatval($rate->rate) : 0;
                            $rate_outsource = ($rate != null) ? floatval($rate->rate_outsource) : 0;
                            
                            $rates->push($rateVal);
                            $rateOutSource->push($rate_outsource);
                            
                            $higestRate = $rateVal > $higestRate ? $rateVal : $higestRate;
                            $higestRateOutSource = $rate_outsource > $higestRateOutSource ? $rate_outsource : $higestRateOutSource;
                        }
                    }   
                }
            }
            
            if($higestRate <= 0)
                abort(response()->json(['message' => 'Esta ruta no tiene una tarifa configurada.'], 401));
            
            if($request->hasFile('attachment'))
            {
                $location = 'assets/media/attachments/';
            
                $attachment = $request->file('attachment');
                $filename = uniqid() . '.' . $attachment->getClientOriginalExtension();
                //Image::make($filename)->save($location . $filename);
                $attachment->move($location, $filename);
                $booking->attachment = $filename;
            }
    
            $booking->locations = $locations;
            $booking->rate = $higestRate;
    		$booking->rate_outsource = $higestRateOutSource;												
            $booking->save();
            
            if($request->work_order_id != null)
            {
                $booking->work_order_id = $request->work_order_id;
                $work_order = WorkOrder::findOrFail($request->work_order_id);
                $work_order->booking_id = $booking->id;
                $work_order->status = 'PROCESADO';
                $work_order->save();
            }
    
            //calcular los destinos y adicionales
            $booking->destinations = $this->destinations($booking);
            $booking->additionals  = $this->calculate_aditionals($booking);
            $booking->additionals_outsource = $this->calculate_aditionals_outsource($booking);
            $booking->save();
            
        });
    }

    public function edit(Booking $booking)
    {
        $vehicles = Vehicle::get();
        $travel_types = TravelType::get();
        $vehicle_types = $this->truck_types();
        $subcontractors = Subcontractor::get();
        $drivers = User::where('user_type', 'driver')->get();
        $customers = User::where('user_type', 'customer')->get();
        return view('bookings.edit', compact('booking', 'customers', 'drivers', 'vehicles', 'vehicle_types', 'travel_types', 'subcontractors'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'pickup' => 'required|date',
            'dropoff' => 'required|date',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'driver_id' => 'required|integer|exists:users,id',
            'helper' => 'nullable|string',
            'travellers' => 'nullable|string',
            'container' => 'nullable|string',
            'dolly' => 'nullable|string',
            'diet' => 'nullable|numeric|min:0',
            'vehicle_type_id' => 'required|integer|min:1',
            'subcontractor_id' => 'nullable|integer|exists:subcontractors,id',
            'attachment' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf',
            'travel_type_id' => 'required|integer|exists:travel_types,id',
            'note' => 'nullable|string',
            'license_plate' => 'nullable|string',
            'package' => 'nullable|string',
        ]);
        
        DB::transaction(function() use ($request, $data, $booking)
        {
        
            $booking->fill($data);
            $booking->save();
    
            $higestRate = 0;
            $higestRateOutSource = 0;
            $locationList = $this->locationList;
            $location_id = $request->locations;
            $location_id = $location_id[0] ?? 0;
            $locations = implode(',', $request->locations);
            
            $customer = User::findOrFail($request->customer_id);
            
            if($customer->calculation_type == 'cantidad_destinos')
            {
                $rate = Rate::where('location_id', $location_id)
                        ->where('center_id',   $request->center_id)
                        ->where('customer_id', $request->customer_id)
                        ->where('travel_type_id', $request->travel_type_id)
                        ->where('vehicle_type_id', $request->vehicle_type_id)->first();
            
                $higestRate = $rate->rate ?? 0;
                $higestRateOutSource = $rate->rate_outsource ?? 0;
                $rates = collect();
                $rateOutSource = collect();
                if(count($request->locations) > 0)
                {
                    foreach(explode(",", $locations) as $location){
                        $actual_location = $locationList->where('id', $location)->first();
                        if($actual_location->is_active){
                            $rate = Rate::where('location_id', $location)
                                    ->where('center_id',   $request->center_id)
                                    ->where('customer_id', $request->customer_id)
                                    ->where('travel_type_id', $request->travel_type_id)
                                    ->where('vehicle_type_id', $request->vehicle_type_id)->first();
                            
                            //validar que los adicionales no sean sumados a la Tarifa
                            $validation = $actual_location->location_type == 'PD';
                            
                            $rateVal = ($rate != null) ? floatval($rate->rate) : 0;
                            $rate_outsource = ($rate != null) ? floatval($rate->rate_outsource) : 0;
                            
                            if(!$validation)
                                $rates->push($rateVal);
                                
                            if(!$validation)
                                $rateOutSource->push($rate_outsource);
                        }
                    }   
                }
                
                $higestRate = $rates->sum();
                $higestRateOutSource = $rateOutSource->sum();
            }
            else
            {
                $rate = Rate::where('location_id', $location_id)
                        ->where('center_id',   $request->center_id)
                        ->where('customer_id', $request->customer_id)
                        ->where('travel_type_id', $request->travel_type_id)
                        ->where('vehicle_type_id', $request->vehicle_type_id)->first();
            
                $higestRate = $rate->rate ?? 0;
                $higestRateOutSource = $rate->rate_outsource ?? 0;
                
                $rates = collect();
                $rateOutSource = collect();
                
                if(count($request->locations) > 1)
                {
                    foreach(explode(",", $locations) as $location){
                        $actual_location = $locationList->where('id', $location)->first();
                        if($actual_location->is_active){
                            $rate = Rate::where('location_id', $location)
                                    ->where('center_id',   $request->center_id)
                                    ->where('customer_id', $request->customer_id)
                                    ->where('travel_type_id', $request->travel_type_id)
                                    ->where('vehicle_type_id', $request->vehicle_type_id)->first();
                            
                            $rateVal = ($rate != null) ? floatval($rate->rate) : 0;
                            $rate_outsource = ($rate != null) ? floatval($rate->rate_outsource) : 0;
                            
                            $rates->push($rateVal);
                            $rateOutSource->push($rate_outsource);
                            
                            $higestRate = $rateVal > $higestRate ? $rateVal : $higestRate;
                            $higestRateOutSource = $rate_outsource > $higestRateOutSource ? $rate_outsource : $higestRateOutSource;
                        }
                    }   
                }
            }
            
            if($higestRate <= 0)
                abort(response()->json(['message' => 'Esta ruta no tiene una tarifa configurada.'], 401));
            
            if($request->hasFile('attachment')){
                $location = 'assets/media/attachments/';
    
                if(is_file($location . $booking->attachment))
                    unlink($location . $booking->attachment);
                    
                $attachment = $request->file('attachment');
                $filename = uniqid() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move($location, $filename);
                $booking->attachment = $filename;
            }
    
            $booking->locations = $locations;
            $booking->rate = $higestRate;
            $booking->rate_outsource = $higestRateOutSource;
            $booking->save();
            
            $booking->destinations = $this->destinations($booking);
            $booking->additionals  = $this->calculate_aditionals($booking);
            $booking->additionals_outsource = $this->calculate_aditionals_outsource($booking);
            $booking->save();
        });
    }

    function destroy(Booking $booking)
    {
        $booking->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $sort_by = $request->get('sort_by');
            $sort_type = $request->get('sort_type');
            $filter = str_replace("%", " ", $filter);
            
            
            if (intval(Auth::user()->customer_id) == 0)
            {
                if(isset($sort_by) && isset($sort_type))
                {
                    $data = $request->validate([
                        //list of columns to be filter in order to avoid sql injection
                        'sort_by' => 'nullable|string|in:customer_id,pickup,center_id,vehicle_id,driver_id,helper,travellers',
                        'sort_type' => 'required|string|in:asc,desc',
                    ]);
                    
                    $sort_by = $request->get('sort_by');
                    $sort_type = $request->get('sort_type');
                    
                    $bookings = Booking::where('id', $filter)
                    ->orWhere('dolly', 'like', '%' . $filter . '%')
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
                    })->orwhereHas('work_order', function ($query) use ($filter) {
                        return $query->where('number', 'like', '%' . $filter . '%');
                    })->orderBy('id', 'desc')->paginate(10);
                }
            }
            else
            {
                if(isset($sort_by) && isset($sort_type))
                {
                    $data = $request->validate([
                        //list of columns to be filter in order to avoid sql injection
                        'sort_by' => 'nullable|string|in:customer_id,pickup,center_id,vehicle_id,driver_id,helper,travellers',
                        'sort_type' => 'required|string|in:asc,desc',
                    ]);
                    
                    $sort_by = $request->get('sort_by');
                    $sort_type = $request->get('sort_type');
                    
                    $bookings = Booking::where('id', $filter)
                    ->where('customer_id', Auth::user()->customer_id)
                    ->andWhere('dolly', 'like', '%' . $filter . '%')
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
                    $bookings = Booking::where('customer_id', Auth::user()->customer_id)
                    ->andWhere('dolly', 'like', '%' . $filter . '%')
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
                    })->orwhereHas('work_order', function ($query) use ($filter) {
                        return $query->where('number', 'like', '%' . $filter . '%');
                    })->orderBy('id', 'desc')->paginate(10);
                }
            }
            
            
            if(1 != 1)
            {
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
                    
                    $bookings = Booking::where('id', $filter)
                    ->orWhere('dolly', 'like', '%' . $filter . '%')
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
                    })->orwhereHas('work_order', function ($query) use ($filter) {
                        return $query->where('number', 'like', '%' . $filter . '%');
                    })->orderBy('id', 'desc')->paginate(10);
                }
            }
            
            return view('dynamics.bookings', compact('bookings'))->render();
        }
    }

    function pdf(Booking $booking)
    {
        $locationsName = array();
        $locations = $booking->locations;
        if($locations != null){
            foreach(explode(",", $locations) as $location){
                $location = Location::where('id', $location)->first();
                array_push($locationsName, $location->location);
            }
        }
        $booking->locations = implode(",", $locationsName);

        $pdf = PDF::loadView('bookings.pdf', compact('booking'));
        return $pdf->setPaper('letter')->stream('booking.pdf');
    }
    
    public function confirm_payment(Request $request)
    {
        $id = intval($request->booking_id);
        $booking = Booking::findOrFail($id);
        $booking->pay_date = now();
        $booking->payed = 1;
        $booking->save();
        
        return redirect()->route('bookings.index');
    }

    //helpers
    /* Determina la cantidad de destinos de los viajes de los cliente según su configuración */
    public function destinations($booking)
    {
        $customer = $booking->customer;
        $locationList = $this->locationList;
        if($customer->calculation_type == 'cantidad_destinos')
        {
            $destinations = 1;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    //validar que los adicionales no sean sumados a la cantidad de destinos
                    $validation = Str::startsWith($location->location, 'Adicional');
                    if($location->location_type == 'PD')
                        if(!$validation)
                            $destinations += intval($location->destinations);
                }
            }
            
            //special condition for Frito Lay Destinations
            /*$destinations = ($booking->customer_id == 144 && $booking->vehicle_type_id == 1) ?
                $destinations = $destinations - 1 :
                $destinations;*/
            
            return $destinations;
        }
        
        if($customer->calculation_type == 'ruta_mas_larga')
        {
            $destinations = 0;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    //validar que los adicionales no sean sumados a la cantidad de destinos
                    $validation = Str::startsWith($location->location, 'Adicional');
                    $aditional = (intval($location->destinations) == 0) ? 1 : intval($location->destinations);
                    
                    if($location->location_type == 'DT' && $validation == false)
                        $destinations += $aditional;
                }
            }
            return $destinations;
        }
    }

    /* Determina el calculo de los adicionales de las rutas según configuración del cliente */
    public function calculate_aditionals($data)
    {
        $higestRate = 0;
        $client = $data->customer;
        $locations = $data->locations;
        $amount = $client->amount ?? 0;
        $locationList = $this->locationList;
        $clientAdditionals = intval($data->customer->additional ?? 0);
        if($clientAdditionals == 0)
        {
            foreach(explode(",", $locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    if($location->location_type == 'PD'){
                        $number = intval($location->location);
                        $validation = Str::startsWith($location->location, 'Adicional');
                        
                        //special condition for Frito Lay Destinations
                        /*$number = ($client->id == 144 && $data->vehicle_type_id == 1) ?
                            $location->destinations - 1 :
                            $location->destinations;*/
                        
                        if($number > 2 || ($validation))
                        {
                            $rate = Rate::where('location_id', $location->id)
                                ->where('customer_id', $data->customer_id)
                                ->where('center_id',   $data->center_id)
                                ->where('travel_type_id', $data->travel_type_id)
                                ->where('vehicle_type_id', $data->vehicle_type_id)->first();
                                
                            $rate = $rate->rate ?? 0;
                            $higestRate += $rate;
                        }
                    }   
                }
            }
            $aditionals = $higestRate;
            return $higestRate;
        }
        else
        {
            $destinations = $this->destinations($data);
            $higestRate = $data->destinations > $client->additional ? (($destinations - $client->additional) * $amount) : 0;
            return $higestRate;
        }
    }
    
    public function destinations_outsource($booking)
    {
        $customer = $booking->customer;
        $locationList = $this->locationList;
        if($customer->calculation_type == 'cantidad_destinos')
        {
            $destinations = 1;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    //validar que los adicionales no sean sumados a la cantidad de destinos
                    $validation = Str::startsWith($location->location, 'Adicional');
                    if($location->location_type == 'PD')
                        if(!$validation)
                            $destinations += intval($location->destinations);
                }
            }
            return $destinations;
        }
        
        if($customer->calculation_type == 'ruta_mas_larga')
        {
            $destinations = 0;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    //validar que los adicionales no sean sumados a la cantidad de destinos
                    $validation = Str::startsWith($location->location, 'Adicional');
                    $aditional = (intval($location->destinations) == 0) ? 1 : intval($location->destinations);
                    
                    if($location->location_type == 'DT' && $validation == false)
                        $destinations += $aditional;
                }
            }
            return $destinations;
        }
    }
    
    public function calculate_aditionals_outsource($data)
    {
        $higestRate = 0;
        $additionals = 0;
        $client = $data->customer;
        $locations = $data->locations;
        $amount = $client->amount_outsource ?? 0;
        $locationList = $this->locationList;
        $clientAdditionals = intval($data->customer->additional_outsource ?? 0);
        
        if($clientAdditionals == 0)
        {
            foreach(explode(",", $locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que solo afecte a las localidades que esten habilitadas.
                if($location->is_active)
                {
                    if($location->location_type == 'PD'){
                        $number = intval($location->location);
                        $validation = Str::startsWith($location->location, 'Adicional');
                        if($number > 2 || ($validation))
                        {
                            $rate = Rate::where('location_id', $location->id)
                                ->where('customer_id', $data->customer_id)
                                ->where('center_id',   $data->center_id)
                                ->where('travel_type_id', $data->travel_type_id)
                                ->where('vehicle_type_id', $data->vehicle_type_id)->first();
                                
                            $rate = $rate->rate_outsource ?? 0;
                            $higestRate += $rate;
                        }
                    }   
                }
            }
            $aditionals = $higestRate;
            return $higestRate;
        }
        else
        {
            foreach(explode(",", $locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                if($location->is_active)
                {
                    if($location->location_type == 'PD'){
                        $number = intval($location->location);
                        $validation = Str::startsWith($location->location, 'Adicional');
                        if($validation)
                        {
                            $rate = Rate::where('location_id', $location->id)
                                ->where('customer_id', $data->customer_id)
                                ->where('center_id',   $data->center_id)
                                ->where('travel_type_id', $data->travel_type_id)
                                ->where('vehicle_type_id', $data->vehicle_type_id)->first();
                                
                            $additionals += $rate->rate_outsource ?? 0;
                        }
                    }   
                }
            }
            
            $destinations = $this->destinations_outsource($data);
            $higestRate = $data->destinations >= $client->additional ? (($destinations - $clientAdditionals) * $amount) + $additionals : 0;
            
            if($higestRate < 0)
                $higestRate = 0;
            
            return $higestRate;
        }
    }
}
