<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('id', 'DESC')->get();
        return $locations;
    }

    public function store(StoreLocationRequest $request)
    {
        $location = new Location;
        $location->is_active = 1;
        $location->customer_id = $request->location["customer_id"];
        $location->location = $request->location["name"];
        $location->description = $request->location["description"];
        $location->location_type = $request->location["location_type"];
        $location->save();
        return $location;
    }

    public function update(UpdateLocationRequest $request, $id)
    {
        $id = intval($id);
        $location = Location::where('id', $id)->first();

        if ($location) {
            $location->customer_id = $request->location["customer_id"];
            $location->location = $request->location["name"];
            $location->description = $request->location["description"];
            $location->location_type = $request->location["location_type"];
            $location->save();
            return $location;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $location = Location::where('id', $id)->first();

        if ($location) {
            $location->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado.";
    }
}
