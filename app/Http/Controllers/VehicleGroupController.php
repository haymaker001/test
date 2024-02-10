<?php

namespace App\Http\Controllers;

use App\Models\VehicleGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleGroupRequest;
use App\Http\Requests\UpdateVehicleGroupRequest;

use Illuminate\Support\Facades\Gate;

class VehicleGroupController extends Controller
{
    public function index()
    {
        if(Gate::denies('Gestionar Grupo de Equipos'))
            abort(401);

        $vehicle_groups = VehicleGroup::orderBy('id', 'DESC')->paginate(10);
        return view('vehicle-groups.index', compact('vehicle_groups'));
    }

    public function create()
    {
        if(Gate::denies('Gestionar Grupo de Equipos'))
            abort(401);

        return view('vehicle-groups.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $vehicle_group = new VehicleGroup;
        $vehicle_group->fill($data);
        $vehicle_group->save();
    }

    public function edit(VehicleGroup $vehicle_group)
    {
        if(Gate::denies('Gestionar Grupo de Equipos'))
            abort(401);

        return view('vehicle-groups.edit', compact('vehicle_group'));
    }

    public function update(Request $request, VehicleGroup $vehicle_group)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $vehicle_group->fill($data);
        $vehicle_group->save();
    }

    function destroy(VehicleGroup $vehicle_group)
    {
        $vehicle_group->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $vehicle_groups = VehicleGroup::where('name', 'like', '%' . $filter . '%')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.vehicle-groups', compact('vehicle_groups'))->render();
        }
    }
}
