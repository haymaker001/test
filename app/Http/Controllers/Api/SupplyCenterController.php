<?php

namespace App\Http\Controllers\Api;

use App\Models\SupplyCenter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplyCenterRequest;
use App\Http\Requests\UpdateSupplyCenterRequest;

class SupplyCenterController extends Controller
{
    public function index()
    {
        $centers = SupplyCenter::orderBy('id', 'DESC')->get();
        return $centers;
    }

    public function store(Request $request)
    {
        $center = new SupplyCenter;
        $center->name = $request->center["name"];
        $center->customer_id = $request->center["customer_id"];
        $center->save();
        return $center;
    }

    public function update(UpdateCenterRequest $request, $id)
    {
        $id = intval($id);
        $center = SupplyCenter::where('id', $id)->first();

        if ($center) {
            $center->name = $request->center["name"];
            $center->customer_id = $request->center["customer_id"];
            $center->save();
            return $center;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $center = SupplyCenter::where('id', $id)->first();

        if ($center) {
            $center->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
