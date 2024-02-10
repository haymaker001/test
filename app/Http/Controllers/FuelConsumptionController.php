<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\SupplyCenter;
use App\Models\Vehicle;
use App\Models\FuelConsumption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFuelConsumptionRequest;
use App\Http\Requests\UpdateFuelConsumptionRequest;

use Illuminate\Support\Facades\Gate;

class FuelConsumptionController extends Controller
{
    public function index()
    {
        if(Gate::denies('Registro de Combustible.'))
            abort(401);
        
        $fuel_consumptions = FuelConsumption::with(['supply_center'])->orderBy('id', 'DESC')->paginate(10);
        return view('fuel-consumptions.index', compact('fuel_consumptions'));
    }

    public function create()
    {
        if(Gate::denies('Registro de Combustible.'))
            abort(401);
        
        $vehicles = Vehicle::get();
        $vehicle_types = $this->truck_types();
        $supply_centers = SupplyCenter::get();
        $clients = User::where('user_type', 'customer')->get();
        return view('fuel-consumptions.create', compact('supply_centers', 'vehicles', 'clients', 'vehicle_types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supply_center_id' => 'required|exists:supply_centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'initial_odometer' => 'nullable|numeric',
            'client_id' => 'nullable|exists:users,id',
        ]);
        
        $other = SupplyCenter::findOrFail($request->supply_center_id);
        $otherRule = $other->supply_center_type == 'PROVICIONAL' ? 'required|string|max:100' : 'nullable|string|max:100';
        
        $odometer = $this->odometer($request->vehicle_id);
        $limiter  = intval($odometer) + 4000;
        
        $data = $request->validate([
            'supply_center_id' => 'required|exists:supply_centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'initial_odometer' => 'nullable|numeric',
            'final_odometer' => 'required|numeric',
            //'final_odometer' => 'required|numeric|gte:initial_odometer|max:' . $limiter,
            'number_of_gallons' => 'required|numeric|min:1',
            'created_date' => 'required|date',
            'other' => $otherRule,
            'client_id' => 'nullable|exists:users,id',
            'vehicle_type_id' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $total_mileage = intval($request->final_odometer) - intval($request->initial_odometer) ?? 0;
        $overall_yield = $total_mileage / $request->number_of_gallons ?? 1;
        
        $fuel = new FuelConsumption;
        $fuel->fill($data);
        $fuel->user_id = Auth::user()->id;
        $fuel->initial_odometer = $this->getInitialOdometer($request->vehicle_id);
        $fuel->total_mileage = $total_mileage;
        $fuel->overall_yield = $overall_yield;
        $fuel->save();
    }

    public function edit(FuelConsumption $fuel_consumption)
    {
        if(Gate::denies('Registro de Combustible.'))
            abort(401);
        
        $vehicles = Vehicle::get();
        $vehicle_types = $this->truck_types();
        $supply_centers = SupplyCenter::get();
        $clients = User::where('user_type', 'customer')->get();
        return view('fuel-consumptions.edit', compact('fuel_consumption', 'supply_centers', 'vehicles', 'clients', 'vehicle_types'));
    }

    public function update(Request $request, FuelConsumption $fuel_consumption)
    {
        $data = $request->validate([
            'supply_center_id' => 'required|exists:supply_centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'initial_odometer' => 'nullable|numeric',
            'client_id' => 'nullable|exists:users,id',
        ]);
        
        $other = SupplyCenter::findOrFail($request->supply_center_id);
        $otherRule = $other->supply_center_type == 'PROVICIONAL' ? 'required|string|max:100' : 'nullable|string|max:100';
        
        $odometer = $this->odometer($request->vehicle_id);
        $limiter  = intval($odometer) + 4000;
        
        $data = $request->validate([
            'supply_center_id' => 'required|exists:supply_centers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'initial_odometer' => 'nullable|numeric',
            'final_odometer' => 'required|numeric',
            //'final_odometer' => 'required|numeric|gte:initial_odometer|max:' . $limiter,
            'number_of_gallons' => 'required|numeric',
            'created_date' => 'required|date',
            'other' => $otherRule,
            'client_id' => 'nullable|exists:users,id',
            'vehicle_type_id' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);
        
        $total_mileage = intval($request->final_odometer) - intval($request->initial_odometer) ?? 0;
        $overall_yield = $total_mileage / $request->number_of_gallons ?? 1;
        
        $fuel_consumption->fill($data);
        $fuel_consumption->total_mileage = $total_mileage;
        $fuel_consumption->overall_yield = $overall_yield;
        $fuel_consumption->save();
    }

    function destroy(FuelConsumption $fuel_consumption)
    {
        $fuel_consumption->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $sort_by = $request->get('sort_by');
            $sort_type = $request->get('sort_type');
            $filter = str_replace("%", " ", $filter);
            
            /*if(isset($sort_by) && isset($sort_type))
            {
                $data = $request->validate([
                    //list of columns to be filter in order to avoid sql injection
                    'sort_by' => 'nullable|string|in:created_date,center_id,vehicle_id',
                    'sort_type' => 'required|string|in:asc,desc',
                ]);
                
                $sort_by = $request->get('sort_by');
                $sort_type = $request->get('sort_type');
                
                $fuel_consumptions = FuelConsumption::with(['supply_center'])
                ->whereHas('vehicle', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                )->orderBy($sort_by, $sort_type)->paginate(10);
            }
            else
            {*/
                $fuel_consumptions = FuelConsumption::with(['supply_center'])
                ->whereHas('vehicle', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);
            //}

            return view('dynamics.fuel-consumptions', compact('fuel_consumptions'))->render();
        }
    }

    //return the odometer via ajax to the views
    function odometer($id)
    {
         return $this->getInitialOdometer($id);
    }

    function getInitialOdometer($id)
    {
        $id = intval($id);
        $odometer = FuelConsumption::where('vehicle_id', $id)->latest()->first();
        $odometer = $odometer->final_odometer ?? 0;    
        return $odometer;
    }
}
