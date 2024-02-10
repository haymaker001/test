<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\VehicleGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

use Illuminate\Support\Facades\Gate;

class VehicleController extends Controller
{
    public function index()
    {
        if(Gate::denies('Gestionar Equipos'))
            abort(401);
        
        $vehicles = Vehicle::orderBy('id', 'DESC')->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        if(Gate::denies('Gestionar Equipos'))
            abort(401);
        
        $vehicle_types = VehicleType::get();
        $vehicle_groups = VehicleGroup::get();
        return view('vehicles.create', compact('vehicle_groups', 'vehicle_types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string',
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'year' => 'required|integer|min:1800',
            'vehicle_group_id' => 'required|integer|exists:vehicle_groups,id',
            'engine_type' => 'required|string',
            'horse_power' => 'required|string',
            'color' => 'required|string',
            'vin' => 'nullable|string',
            'license_plate' => 'nullable|string',
            //'thermoking' => 'nullable|string',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
            'outsource' => 'required|integer',
            'is_reportable' => 'required|integer',
        ]);

        $vehicle = new Vehicle;
        $vehicle->fill($data);
        $vehicle->type_id = $request->vehicle_type_id;
        $vehicle->save();
    }

    public function edit(Vehicle $vehicle)
    {
        if(Gate::denies('Gestionar Equipos'))
            abort(401);
        
        $vehicle_types = VehicleType::get();
        $vehicle_groups = VehicleGroup::get();
        return view('vehicles.edit', compact('vehicle', 'vehicle_groups', 'vehicle_types'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'model' => 'required|string',
            'vehicle_type_id' => 'required|integer|exists:vehicle_types,id',
            'year' => 'required|integer|min:1800',
            'vehicle_group_id' => 'required|integer|exists:vehicle_groups,id',
            'engine_type' => 'required|string',
            'horse_power' => 'required|string',
            'color' => 'required|string',
            'vin' => 'nullable|string',
            'license_plate' => 'nullable|string',
            //'thermoking' => 'nullable|string',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
            'outsource' => 'required|integer',
            'is_reportable' => 'required|integer',
        ]);

        $vehicle->fill($data);
        $vehicle->type_id = $request->vehicle_type_id;
        $vehicle->save();
    }

    function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $vehicles = Vehicle::where('name', 'like', '%' . $filter . '%')
                ->orWhere('model', 'like', '%' . $filter . '%')
                ->orWhere('color', 'like', '%' . $filter . '%')
                ->orWhere('license_plate', 'like', '%' . $filter . '%')
                ->orwhereHas('vehicle_type', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.vehicles', compact('vehicles'))->render();
        }
    }
    
    
}
