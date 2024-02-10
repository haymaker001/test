<?php

namespace App\Http\Controllers\Api;

use App\Models\Rate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRateRequest;
use App\Http\Requests\UpdateRateRequest;

class RateController extends Controller
{
    public function index()
    {
        $rates = Rate::orderBy('id', 'DESC')->get();
        return $rates;
    }

    public function store(StoreRateRequest $request)
    {
        $rate = new Rate;
        $rate->name = $request->rate["name"];
        $rate->customer_id = $request->rate["customer_id"];
        $rate->customer_id = $request->rate["customer_id"];
        $rate->customer_id = $request->rate["customer_id"];
        $rate->customer_id = $request->rate["customer_id"];
        $rate->customer_id = $request->rate["customer_id"];
        $rate->save();
        return $rate;
    }

    public function update(UpdateRateRequest $request, $id)
    {
        $id = intval($id);
        $rate = Rate::where('id', $id)->first();

        if ($rate) {
            $rate->name = $request->rate["name"];
            $rate->customer_id = $request->rate["customer_id"];
            $rate->customer_id = $request->rate["customer_id"];
            $rate->customer_id = $request->rate["customer_id"];
            $rate->customer_id = $request->rate["customer_id"];
            $rate->customer_id = $request->rate["customer_id"];
            $rate->save();
            return $rate;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $rate = Rate::where('id', $id)->first();

        if ($rate) {
            $rate->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
