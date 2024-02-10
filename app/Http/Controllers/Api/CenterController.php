<?php

namespace App\Http\Controllers\Api;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::orderBy('id', 'DESC')->get();
        return $centers;
    }

    public function store(Request $request)
    {

        dd($request);
        $center = new Center;
        $center->name = $request->center["name"];
        $center->customer_id = $request->center["customer_id"];
        $center->save();
        return $center;
    }

    public function update(UpdateCenterRequest $request, $id)
    {
        $id = intval($id);
        $center = Center::where('id', $id)->first();

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
        $center = Center::where('id', $id)->first();

        if ($center) {
            $center->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
