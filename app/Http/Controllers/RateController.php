<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Rate;
use App\Models\User;
use App\Models\Center;
use App\Models\VehicleType;
use App\Models\Location;
use App\Models\TravelType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRateRequest;
use App\Http\Requests\UpdateRateRequest;

use Illuminate\Support\Facades\Gate;

class RateController extends Controller
{
    public function index()
    {
        if(Gate::denies('Gestionar Tarífas'))
            abort(401);
        
        $rates = Rate::orderBy('id', 'DESC')->paginate(10);
        return view('rates.index', compact('rates'));
    }

    public function create()
    {
        if(Gate::denies('Nueva Tarífa'))
            abort(401);
        
        $centers = Center::get();
        $locations = Location::get();
        $travel_types = TravelType::get();
        $vehicle_types = $this->truck_types();
        $customers = User::where('user_type', 'customer')->get();
        return view('rates.create', compact('customers', 'centers', 'vehicle_types', 'locations', 'travel_types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'vehicle_type_id' => 'required|integer',
            'location_id' => 'required|integer|exists:locations,id',
            'rate' => 'required|numeric|min:0',
            'rate_outsource' => 'required|numeric|min:0',
            'travel_type_id' => 'required|integer|exists:travel_types,id',
        ]);

        $rate = new Rate;
        $rate->fill($data);
        $rate->user_id = Auth::user()->id;
        $rate->save();
    }

    public function edit(Rate $rate)
    {
        if(Gate::denies('Gestionar Tarífas'))
            abort(401);
        
        $centers = Center::get();
        $locations = Location::get();
        $travel_types = TravelType::get();
        $vehicle_types = $this->truck_types();
        $customers = User::where('user_type', 'customer')->get();
        return view('rates.edit', compact('rate', 'customers', 'centers', 'vehicle_types', 'locations', 'travel_types'));
    }

    public function update(Request $request, Rate $rate)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:users,id',
            'center_id' => 'required|integer|exists:centers,id',
            'vehicle_type_id' => 'required|integer',
            'location_id' => 'required|integer|exists:locations,id',
            'rate' => 'required|numeric|min:0',
            'rate_outsource' => 'required|numeric|min:0',
            'travel_type_id' => 'required|integer|exists:travel_types,id',
        ]);

        $rate->fill($data);
        $rate->save();
    }

    function destroy(Rate $rate)
    {
        $rate->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $rates = Rate::where('rate', 'like', '%' . $filter . '%')
                ->orwhereHas('customer', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('center', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('vehicle_type', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('location', function ($query) use ($filter) {
                    return $query->where('location', 'like', '%' . $filter . '%');
                })->orwhereHas('travel_type', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.rates', compact('rates'))->render();
        }
    }
}
