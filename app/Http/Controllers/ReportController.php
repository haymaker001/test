<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use App\Models\User;
use App\Models\Rate;
use App\Models\Center;
use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\Section;
use App\Models\Warehouse;
use App\Models\Location;
use App\Models\Inventory;
use App\Models\TravelType;
use App\Models\SupplyCenter;
use App\Models\FuelConsumption;
use App\Models\WarehouseLocation;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RatesExport;
use App\Exports\VehiclesExport;
use App\Exports\InventoriesExport;
use App\Exports\BookingsExport;
use App\Exports\ReportBookingsExport;

use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    private $locationList;

    function __construct()
    {
        $this->locationList = Location::all();
    }

    public function billing()
    {
        if(Gate::denies('Informe de Facturación'))
            abort(401);

        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['centers'] = Center::all();
        $data['center_select'] = "";
        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");       
        return view("reports.billing", $data);
    }
    
    public function pdf()
    {
        $pdf = PDF::setPaper('letter', 'portrait')->loadView('reports.pdf.venta');
        return $pdf->stream('Informacion-de-venta.pdf');
    }

    public function billing_pdf(Request $request)
    {
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";
        $data['show_rate'] = $request->show_rate;
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
        
        if(!is_null($request->customer_id))
            $data['bookings'] = $data['bookings']->where('customer_id' , $request->customer_id);
            
        if(!is_null($request->center_id))
            $data['bookings'] = $data['bookings']->where('center_id' , $request->center_id);
            
        $data['bookings'] = $data['bookings']->get();
        $data['clients'] = $data['bookings']->unique('customer_id')->sortBy('customer.name')->pluck(['customer']);

        $locationList = $this->locationList;
        foreach($data['bookings'] as $booking){
            $locationsName = array();
            //$destinationList = array();
            $locations = $booking->locations;
            
            if($locations != null){
                foreach(explode(",", $locations) as $location){
                    $location = $locationList->where('id', $location)->first();
                    array_push($locationsName, $location->location);
                }
            }
            $booking->locations = implode(",", $locationsName);
        }
        
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '2048M');
        set_time_limit(300);
        
        $pdf = PDF::setPaper('landscape')->loadView('reports.pdf.billing', $data);
        return $pdf->stream('billing.pdf');
    }
    
    public function weekly()
    {
        if(Gate::denies('Informe de Paradas'))
            abort(401);

        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");
        
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data["locations"] = Location::where('customer_id', 142)->where('location_type', 'DT')->orderBy('location')->get();
        
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);

        $data['bookings'] = $data['bookings']->get();
        
        $locationList = $data["locations"];
        foreach($data['locations'] as $location){
            $counter = 0; $amount  = 0;
            foreach($data['bookings'] as $booking){
                
                $BookingLocationsCount = count(explode(',', $booking->locations));

                //Foreach Booking Location
                foreach(explode(',', $booking->locations) as $BL){
                    if($location->id == $BL)
                    {
                        $amount += $booking->rate / $BookingLocationsCount;
                        $counter++;
                    }
                }
            }
            
            $location['amount']  = $amount;
            $location['counter'] = $counter;
        }
        
        $data['locations'] = $data['locations']->where('amount', '>', '0');
        
        return view("reports.weekly", $data);
    }
    
    public function weekly_post(Request $request)
    {
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $data['customer_select'] = $request->customer_id;
        
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);
        
        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
        
        if ($request->customer_id != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->customer_id);
        }
        $data['bookings'] = $data['bookings']->get();
        
        $destinations = array();
        $locationList = $this->locationList;
        
        foreach($data['bookings'] as $booking){
            foreach(explode(',', $booking->locations) as $location){
                if(!in_array($location, $destinations))
                    array_push($destinations, $location);
            }
        }
        
        $Locations = Location::whereIn('id', $destinations)->where('location_type', 'DT')->orderBy('location')->get();
        foreach($Locations as $location){
            
            $location['normal'] = 0;
            $location['dolly'] = 0;
            
            
            foreach($data['bookings'] as $booking){
                $destinationList = explode(',', $booking->locations);
                if(in_array($location->id, $destinationList)){
                    if($booking->travel_type_id == 1)
                        $location->normal += 1;
                    elseif($booking->travel_type_id == 2)
                        $location->dolly += 1;
                }
            }
        }
        
        $data['locations'] = $Locations;
        return view("reports.weekly", $data);
    }
    
    public function travel()
    {
        if(Gate::denies('Informe de Paradas'))
            abort(401);

        $data['center_select'] = "";
        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");

        $data['centers'] = Center::all();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data["locations"] = Location::where('customer_id', 142)->where('location_type', 'DT')->orderBy('location')->get();
        
        //dd($data["locations"]);
        
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);

        $data['bookings'] = $data['bookings']->get();
        
        $locationList = $data["locations"];
        foreach($data['locations'] as $location){
            $counter = 0; $amount  = 0;
            foreach($data['bookings'] as $booking){
                
                $BookingLocationsCount = count(explode(',', $booking->locations));

                //Foreach Booking Location
                foreach(explode(',', $booking->locations) as $BL){
                    if($location->id == $BL)
                    {
                        $amount += $booking->rate / $BookingLocationsCount;
                        $counter++;
                    }
                }
            }
            
            $location['amount']  = $amount;
            $location['counter'] = $counter;
        }
        
        $data['locations'] = $data['locations']->where('amount', '>', '0');
        
        return view("reports.travel", $data);
    }
    
    public function travel_post(Request $request)
    {
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $data['center_select'] = $request->center_id;
        $data['customer_select'] = $request->customer_id;
        
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";

        $data['centers'] = Center::all();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);
        $data["locations"] = Location::where('customer_id', $request->customer_id)->where('location_type', 'DT')->orderBy('location')->get();

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
        
        if ($request->customer_id != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->customer_id);
        }
        if ($request->center_id != "") {
            $data['bookings'] = $data['bookings']->where("center_id", $request->center_id);
        }
        $data['bookings'] = $data['bookings']->get();
        
        //Locations
        $locationList = $data["locations"];
        foreach($data['locations'] as $location){
            $counter = 0; $amount  = 0;
            foreach($data['bookings'] as $booking){
                
                $BookingLocationsCount = count(explode(',', $booking->locations));

                //Foreach Booking Location
                foreach(explode(',', $booking->locations) as $BL){
                    if($location->id == $BL)
                    {
                        $amount += $booking->rate / $BookingLocationsCount;
                        $counter++;
                    }
                }
            }
            
            $location['amount']  = $amount;
            $location['counter'] = $counter;
        }
        
        $data['locations'] = $data['locations']->where('amount', '>', '0');
        
        return view("reports.travel", $data);
    }
    
    public function booking_confirmation()
    {
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");
        
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);

        $data['bookings'] = $data['bookings']->get();
        
        return view("reports.booking-confirmation", $data);
    }
    
    public function booking_post_confirmation(Request $request)
    {
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";
        
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
            
        $data['bookings'] = $data['bookings']->get();
        return view("reports.booking-confirmation", $data);
    }

    public function booking()
    {
        if(Gate::denies('Informe de Conduces'))
            abort(401);

        $data['center_select'] = "";
        $data['vehicle_select'] = "";
        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");
        $data['paid_status'] = '';

        $data['centers'] = Center::all();
        $data['vehicles'] = Vehicle::get();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);

        $data['bookings'] = $data['bookings']->get();
        
        //Locations
        $locationList = $this->locationList;
        foreach($data['bookings'] as $booking){
            $locationsName = array();
            //$destinationList = array();
            $locations = $booking->locations;
            
            if($locations != null){
                foreach(explode(",", $locations) as $location){
                    $location = $locationList->where('id', $location)->first();
                    array_push($locationsName, $location->location);
                }
            }
            $booking->locations = implode(",", $locationsName);
        }
        return view("reports.booking", $data);
    }
    
    public function rates_excel()
    {
        return Excel::download(new RatesExport, 'Tarifas HenríquezGO.xlsx');
    }
    
    function vehicles_excel()
    {
        return Excel::download(new VehiclesExport, 'Vehiculos HenríquezGO.xlsx');
    }
    
    public function inventories_excel()
    {
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '2048M');
        set_time_limit(300);
        return Excel::download(new InventoriesExport, 'Inventario HenríquezGO.xlsx');
    }
    
    public function booking_excel()
    {
        if(Gate::denies('Informe de Conduces'))
            abort(401);

        $data['center_select'] = "";
        $data['vehicle_select'] = "";
        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");

        $data['centers'] = Center::all();
        $data['vehicles'] = Vehicle::get();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));
        return view("reports.booking-excel", $data);
    }
    
    public function booking_excel_post(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date',
            'center_id' => 'nullable|integer|exists:centers,id',
            'vehicle_id' => 'nullable|integer|exists:vehicles,id',
            'customer_id' => 'nullable|integer|exists:users,id',
        ]);

        $export_name = 'bookings-by-date-'. $request->from . '-'. $request->to .'.xlsx';
        return Excel::download(new ReportBookingsExport(
            $request->from,
            $request->to,
            $request->center_id,
            $request->vehicle_id,
            $request->customer_id), 
        $export_name);
    }

    public function booking_post(Request $request)
    {
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $data['direct_export'] = $request->export;
        $data['paid_status'] = $request->paid_status;
        $data['center_select'] = $request->center_id;
        $data['vehicle_select'] = $request->vehicle_id;
        $data['customer_select'] = $request->customer_id;
        
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";

        $data['centers'] = Center::all();
        $data['vehicles'] = Vehicle::get();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
        
        if ($request->vehicle_id != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_id", $request->vehicle_id);
        }
        if ($request->customer_id != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->customer_id);
        }
        if ($request->center_id != "") {
            $data['bookings'] = $data['bookings']->where("center_id", $request->center_id);
        }
        
        switch ($request->paid_status) {
            case '0':
                $data['bookings'] = $data['bookings']->where("payed", '0');
                break;
            case '1':
                $data['bookings'] = $data['bookings']->where("payed", '1');
                break;
        }
        
        $data['bookings'] = $data['bookings']->get();
        
        //Locations
        $locationList = $this->locationList;
        foreach($data['bookings'] as $booking){
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
        
        if($data['direct_export'] == 'SI')
        {
            ini_set('max_execution_time', '300');
            ini_set('memory_limit', '2048M');
            set_time_limit(300);
            
            return Excel::download(new BookingsExport(
                $data['bookings'],
                $data['from'],
                $data['to']), 
            'Inventario HenríquezGO.xlsx');
        }
        else
            return view("reports.booking", $data);
    }

    public function consumptions()
    {
        if(Gate::denies('Informe de combustible'))
            abort(401);
        
        $data['to'] = date("Y-m-d");
        $data['from'] = date("Y-m-d");
        $data['vehicle_select'] = null;
        $data['supply_center_select'] = null;
        $data['vehicles'] = Vehicle::get();
        $data['supply_centers'] = SupplyCenter::all();
        $data['bookings'] = FuelConsumption::whereYear("created_date", date("Y"))->whereMonth("created_date", date("n"))->get();
        return view("reports.consumptions", $data);
    }

    public function consumptions_post(Request $request)
    {
        $data['from'] = $request->get("from");
        $data['to']   = $request->get("to");
        
        $data['vehicle_select'] = $request->vehicle_id;
        $data['supply_center_select'] = $request->supply_center_id;
        $from = $request->get("from") . " 00:00:00";
        $to   = $request->get("to")   . " 23:59:59";
        
        $data['vehicles'] = Vehicle::get();
        $data['supply_centers'] = SupplyCenter::all();
        $data['bookings'] = FuelConsumption::whereBetween('created_date', [$from, $to]);
        
        if ($request->vehicle_id != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_id", $request->vehicle_id);
        }
        if ($request->supply_center_id != "") {
            $data['bookings'] = $data['bookings']->where("supply_center_id", $request->supply_center_id);
        }
        
        $data['bookings'] = $data['bookings']->get();
        return view("reports.consumptions", $data);
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
                //validar que los adicionales no sean sumados a la cantidad de destinos
                $validation = Str::startsWith($location->location, 'Adicional');
                if($location->location_type == 'PD')
                    if(!$validation)
                        $destinations += intval($location->location);
            }
            return $destinations;
        }
        
        if($customer->calculation_type == 'ruta_mas_larga')
        {
            $destinations = 0;
            foreach(explode(",", $booking->locations) as $location)
            {
                $location = $locationList->where('id', $location)->first();
                //validar que los adicionales no sean sumados a la cantidad de destinos
                $validation = Str::startsWith($location->location, 'Adicional');
                $aditional = (intval($location->location) == 0) ? 1 : intval($location->location);
                
                if($location->location_type == 'DT' && $validation == false)
                    $destinations += $aditional;
            }
            return $destinations;
        }
    }
    
    public function inventories()
    {
        if(Gate::denies('Inventario'))
            abort(401);
        
        $data['report_type'] = null;
        $data['inventories'] = null;
        $data['to'] = date("Y-m-d");
        $data['from'] = date("Y-m-d");
        $data['inventory_type'] = null;
        $data['warehouse_id'] = null;
        $data['section_id'] = null;
        $data['warehouse_location_id'] = null;
        
        $data['sections'] = Section::all();
        $data['warehouses'] = Warehouse::all();
        $data['warehouse_locations'] = WarehouseLocation::all();
        
        //dd($data);
        
        return view("reports.inventories", $data);
    }
    
    public function inventories_post(Request $request)
    {
        if(Gate::denies('Inventario'))
            abort(401);
            
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";
        
        $data['warehouses'] = Warehouse::all();
        $data['section_id'] = $request->section_id;
        $data['warehouse_id'] = $request->warehouse_id;
        $data['warehouse_location_id'] = $request->warehouse_location_id;
        
        $data['sections'] = Section::all();
        $data['warehouses'] = Warehouse::all();
        $data['warehouse_locations'] = WarehouseLocation::all();
        
        $data['report_type'] = $request->report_type == 'DETAIL' ? 'DETAIL' : 'SUMMARY';
        $data['inventory_type'] = $request->inventory_type == 'GENERAL' ? 'GENERAL' : ($request->inventory_type == 'ENTRADA' ? 'ENTRADA' : 'SALIDA');
        
        $data['inventories'] = Inventory::with(['item_definition', 'warehouse_location'])->whereBetween('created_at', [$from, $to]);
        
        if($data['warehouse_id'] != null){
            $data['inventories'] = $data['inventories']->where('warehouse_id', $request->warehouse_id);
        }
        
        if($data['warehouse_location_id'] != null){
            $data['inventories'] = $data['inventories']->where('warehouse_location_id', $request->warehouse_location_id);
        }
        
        if($data['section_id'] != null){
            $data['inventories'] = $data['inventories']->where('section_id', $request->section_id);
        }
        
        if($data['inventory_type'] === 'GENERAL'){
            $data['inventories'] = $data['inventories']->groupBy('item_definition_id', 'warehouse_location_id')->get();
            $data['inventories'] = $data['inventories']->where('final_stock', '>', 0);
        }
        if($data['inventory_type'] === 'ENTRADA'){
            $data['inventories'] = $data['inventories']->where('inventory_type', 'IN')->get();
        }
        if($data['inventory_type'] === 'SALIDA'){
            $data['inventories'] = $data['inventories']->where('inventory_type', 'OUT')->get();
        }
        
        return view("reports.inventories", $data);
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
                            
                        $rate = $rate->rate ?? 0;
                        $higestRate += $rate;
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
    
    public function profit()
    {
        if(Gate::denies('Informe de Conduces'))
            abort(401);

        $data['vehicle_type_select'] = "";
        $data['vehicle_select'] = "";
        $data['customer_select'] = "";
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");

        $data['vehicles'] = Vehicle::get();
        $data['vehicle_types'] = $this->truck_types();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereDay("pickup", date("d"));

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);

        $data['bookings'] = $data['bookings']->get();
        
        //Locations
        $locationList = $this->locationList;
        foreach($data['bookings'] as $booking){
            $locationsName = array();
            //$destinationList = array();
            $locations = $booking->locations;
            
            if($locations != null){
                foreach(explode(",", $locations) as $location){
                    $location = $locationList->where('id', $location)->first();
                    array_push($locationsName, $location->location);
                }
            }
            $booking->locations = implode(",", $locationsName);
            $booking->percentage = (1 - (($booking->rate_outsource + $booking->additionals_outsource) / ($booking->rate + $booking->additionals))) * 100;
        }
        return view("reports.profit", $data);
    }

    public function profit_post(Request $request)
    {
        $data['to']   = $request->to;
        $data['from'] = $request->from;
        $data['vehicle_type_select'] = $request->vehicle_type_id;
        $data['vehicle_select'] = $request->vehicle_id;
        $data['customer_select'] = $request->customer_id;
        
        $from = $request->from . " 00:00:00";
        $to   = $request->to   . " 23:59:59";

        $data['vehicles'] = Vehicle::get();
        $data['vehicle_types'] = $this->truck_types();
        $data['customers'] = User::where('user_type', 'customer')->get();
        $data['bookings'] = Booking::whereBetween('pickup', [$from, $to]);

        /* Validar que solo se muestre la información según tenga configurado el usuario */
        if (Auth::user()->position->can_see_others_data != 'SI')
            $data['bookings'] = $data['bookings']->where('user_id', Auth::user()->id);
        
        if ($request->vehicle_id != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_id", $request->vehicle_id);
        }
        if ($request->customer_id != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->customer_id);
        }
        if ($request->vehicle_type_id != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_type_id", $request->vehicle_type_id);
        }
        $data['bookings'] = $data['bookings']->get();
        
        //Locations
        $locationList = $this->locationList;
        foreach($data['bookings'] as $booking){
            $locationsName = array();
            $locations = $booking->locations;
            
            if($locations != null){
                foreach(explode(",", $locations) as $location){
                    $location = $locationList->where('id', $location)->first();
                    array_push($locationsName, $location->location);
                }
            }
            $booking->locations = implode(",", $locationsName);
            $booking->percentage = (1 - (($booking->rate_outsource + $booking->additionals_outsource) / ($booking->rate + $booking->additionals))) * 100;
        }
        
        return view("reports.profit", $data);
    }
}