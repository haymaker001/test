<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SecurityNotification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

use Illuminate\Support\Facades\Gate;

class MailController extends Controller
{
    public function index($id)
    {
        $id = intval($id);
        $notification = SecurityNotification::findOrFail($id);
        return view('emails.security-notification', compact('notification'));
    }

    public function create()
    {
        $customers = User::where('user_type', 'customer')->get();
        return view('locations.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'location' => 'required|string',
            'description' => 'nullable|string',
            'destinations' => 'required|integer|min:1',
            'location_type' => 'required|string|in:DT,PD',
            'customer_id' => 'required|exists:users,id',
        ]);

        $location = new Location;
        $location->fill($data);
        $location->save();
    }

    public function edit(Location $location)
    {
        $customers = User::where('user_type', 'customer')->get();
        return view('locations.edit', compact('location', 'customers'));
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'location' => 'required|string',
            'description' => 'nullable|string',
            'destinations' => 'required|integer|min:1',
            'location_type' => 'required|string|in:DT,PD',
            'customer_id' => 'required|exists:users,id',
        ]);

        $location->fill($data);
        $location->save();
    }

    function destroy(Location $location)
    {
        $location->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $locations = Location::with(['customer'])
                ->where('location', 'like', '%' . $filter . '%')
                ->orwhereHas('customer', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.locations', compact('locations'))->render();
        }
    }
}
