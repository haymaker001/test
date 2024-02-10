<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::orderBy('id', 'DESC')->get();
        return $customers;
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = new User;
        $customer->identification = $request->customer["identification"];
        $customer->name = mb_strtoupper($request->customer["name"]);
        $customer->position_id = $request->customer["position_id"];
        $customer->additional = $request->customer["additional"];
        $customer->amount = $request->customer["amount"];
        $customer->email = $request->customer["email"];
        $customer->user_type = 'client';
        $customer->api_token = uniqid();
        $customer->password = uniqid();
        $customer->save();
        return $customer;
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $id = intval($id);
        $customer = User::where([ ['id', $id], ['user_type','client'] ])->first();

        if ($customer) {
            $customer->identification = $request->customer["identification"];
            $customer->name = mb_strtoupper($request->customer["name"]);
            $customer->position_id = $request->customer["position_id"];
            $customer->additional = $request->customer["additional"];
            $customer->amount = $request->customer["amount"];
            $customer->email = $request->customer["email"];
            $customer->save();
            return $customer;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $customer = User::where('id', $id)->first();

        if ($customer) {
            $customer->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado."; 
    }
}
