<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\SupplyCenter;
use App\Models\Position;
use App\Models\User;

use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::denies('Usuarios'))
            abort(401);

        $users = User::where('user_type', 'users')->orderBy('id', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if(Gate::denies('Usuarios'))
            abort(401);

        $positions = Position::all();
        $customers = User::where('user_type', 'customer')->get();
        $supply_centers = SupplyCenter::where('supply_center_type', 'NORMAL')->get();
        return view('users.create', compact('positions', 'customers', 'supply_centers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'position_id' => 'required|integer|exists:positions,id',
            'customer_id' => 'nullable|integer|exists:users,id',
            'supply_center_id' => 'nullable|integer|exists:supply_centers,id',
        ]);

        $user = new User;
        $user->fill($data);
        $user->amount = 0;
        $user->additional= 0;
        $user->api_token = uniqid();
        $user->user_type = 'users';
        $user->password = Hash::make($request->password);
        $user->calculation_type = 'cantidad_destinos';
        $user->save();
    }

    public function edit(User $user)
    {
        if(Gate::denies('Usuarios'))
            abort(401);

        $positions = Position::all();
        $customers = User::where('user_type', 'customer')->get();
        $supply_centers = SupplyCenter::where('supply_center_type', 'NORMAL')->get();
        return view('users.edit', compact('user', 'positions', 'customers', 'supply_centers'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'rnc' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'position_id' => 'required|integer|exists:positions,id',
            'customer_id' => 'nullable|integer|exists:users,id',
            'supply_center_id' => 'nullable|integer|exists:supply_centers,id',
        ]);

        $user->fill($data);
        if(isset($request->password))
            $user->password = Hash::make($request->password);
        
        $user->save();
    }

    function destroy(User $user)
    {
        $user->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $users = User::where('user_type', 'users')
                ->where('name', 'like', '%' . $filter . '%')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.users', compact('users'))->render();
        }
    }
}
