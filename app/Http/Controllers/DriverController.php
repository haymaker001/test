<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class DriverController extends Controller
{
    public function index()
    {
        if(Gate::denies('Choferes'))
            abort(401);
        
        $drivers = User::where('user_type', 'driver')->orderBy('id', 'DESC')->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        if(Gate::denies('Choferes'))
            abort(401);
        
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'driver_type' => 'required|string|in:NORMAL,SUBCONTRATADO'
        ]);

        $driver = new User;
        $driver->fill($data);
        $driver->amount = 0;
        $driver->additional= 0;
        $driver->email = uniqid();
        $driver->password = uniqid();
        $driver->api_token = uniqid();
        $driver->user_type = 'driver';
        $driver->calculation_type = 'cantidad_destinos';
        $driver->save();
    }

    public function edit(User $driver)
    {
        if(Gate::denies('Choferes'))
            abort(401);
        
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, User $driver)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'driver_type' => 'required|string|in:NORMAL,SUBCONTRATADO'
        ]);

        $driver->fill($data);
        $driver->save();
    }

    function destroy(User $driver)
    {
        $driver->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $drivers = User::where('user_type', 'driver')
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('driver_type', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.drivers', compact('drivers'))->render();
        }
    }
}
