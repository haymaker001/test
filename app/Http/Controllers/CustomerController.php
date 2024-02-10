<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index()
    {
        if(Gate::denies('Clientes'))
            abort(401);
        
        $customers = User::where('user_type', 'customer')->orderBy('id', 'DESC')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        if(Gate::denies('Clientes'))
            abort(401);
        
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'amount' => 'nullable|numeric|min:0',
            'additional' => 'nullable|integer|min:0',
            'amount_outsource' => 'nullable|numeric|min:0',
            'additional_outsource' => 'nullable|numeric|min:0',
            'calculation_type' => 'required|string|in:cantidad_destinos,ruta_mas_larga'
        ]);

        $customer = new User;
        $customer->fill($data);
        $customer->email = uniqid();
        $customer->password = uniqid();
        $customer->api_token = uniqid();
        $customer->user_type = 'customer';
        $customer->calculation_type = 'cantidad_destinos';
        $customer->save();
    }

    public function edit(User $customer)
    {
        if(Gate::denies('Clientes'))
            abort(401);
        
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'amount' => 'nullable|numeric|min:0',
            'additional' => 'nullable|integer|min:0',
            'amount_outsource' => 'nullable|numeric|min:0',
            'additional_outsource' => 'nullable|numeric|min:0',
            'calculation_type' => 'required|string|in:cantidad_destinos,ruta_mas_larga'
        ]);

        $customer->fill($data);
        $customer->save();
    }

    function destroy(User $customer)
    {
        $customer->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $customers = User::where('user_type', 'customer')
                ->where('name', 'like', '%' . $filter . '%')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.customers', compact('customers'))->render();
        }
    }

    function centers(User $customer)
    {
        return $customer->centers;
    }

    function locations(User $customer)
    {
        return $customer->locations;
    }
}
