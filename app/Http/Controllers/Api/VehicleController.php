<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'DESC')->get();
        return $vehicles;
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = new Vehicle;
        $vehicle->name = $request->vehicle["name"];
        $vehicle->customer_id = $request->vehicle["customer_id"];
        $vehicle->save();
        return $vehicle;
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
        $id = intval($id);
        $vehicle = Vehicle::where('id', $id)->first();

        if ($vehicle) {
            $vehicle->name = $request->vehicle["name"];
            $vehicle->customer_id = $request->vehicle["customer_id"];
            $vehicle->save();
            return $vehicle;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $vehicle = Vehicle::where('id', $id)->first();

        if ($vehicle) {
            $vehicle->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
