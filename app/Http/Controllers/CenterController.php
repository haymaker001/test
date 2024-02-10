<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

use Illuminate\Support\Facades\Gate;

class CenterController extends Controller
{
    public function index()
    {
        if(Gate::denies('Centros'))
            abort(401);

        $centers = Center::with(['customer'])->orderBy('id', 'DESC')->paginate(10);
        return view('centers.index', compact('centers'));
    }

    public function create()
    {
        if(Gate::denies('Centros'))
            abort(401);

        $customers = User::where('user_type', 'customer')->get();
        return view('centers.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'customer_id' => 'required|exists:users,id',
        ]);

        $center = new Center;
        $center->fill($data);
        $center->save();
    }

    public function edit(Center $center)
    {
        if(Gate::denies('Centros'))
            abort(401);

        $customers = User::where('user_type', 'customer')->get();
        return view('centers.edit', compact('center', 'customers'));
    }

    public function update(Request $request, Center $center)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'customer_id' => 'required|exists:users,id',
        ]);

        $center->fill($data);
        $center->save();
    }

    function destroy(Center $center)
    {
        $center->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $centers = Center::with(['customer'])
                ->where('name', 'like', '%' . $filter . '%')
                ->orwhereHas('customer', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.centers', compact('centers'))->render();
        }
    }
}
