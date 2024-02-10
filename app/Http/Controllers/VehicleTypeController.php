<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateVehicleTypeRequest;

use Illuminate\Support\Facades\Gate;

class VehicleTypeController extends Controller
{
    public function index()
    {
        if(Gate::denies('Gestionar Tipo Equipos'))
            abort(401);
        
        $vehicle_types = VehicleType::orderBy('id', 'DESC')->paginate(10);
        return view('vehicle-types.index', compact('vehicle_types'));
    }

    public function create()
    {
        if(Gate::denies('Gestionar Tipo Equipos'))
            abort(401);
        
        return view('vehicle-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $vehicle_type = new VehicleType;
        $vehicle_type->fill($data);
        $vehicle_type->save();
    }

    public function edit(VehicleType $vehicle_type)
    {
        if(Gate::denies('Gestionar Tipo Equipos'))
            abort(401);
        
        return view('vehicle-types.edit', compact('vehicle_type'));
    }

    public function update(Request $request, VehicleType $vehicle_type)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $vehicle_type->fill($data);
        $vehicle_type->save();
    }

    function destroy(VehicleType $vehicle_type)
    {
        $vehicle_type->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $vehicle_types = VehicleType::where('name', 'like', '%' . $filter . '%')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.vehicle-types', compact('vehicle_types'))->render();
        }
    }
}
