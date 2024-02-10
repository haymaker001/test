<?php

namespace App\Http\Controllers;

use App\Models\SupplyCenter;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplyCenterRequest;
use App\Http\Requests\UpdateSupplyCenterRequest;

use Illuminate\Support\Facades\Gate;

class SupplyCenterController extends Controller
{
    public function index()
    {
        if(Gate::denies('Centro de Abastecimiento'))
            abort(401);

        $supply_centers = SupplyCenter::orderBy('id', 'DESC')->paginate(10);
        return view('supply-centers.index', compact('supply_centers'));
    }

    public function create()
    {
        if(Gate::denies('Centro de Abastecimiento'))
            abort(401);

        return view('supply-centers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'supply_center_type' => 'required|in:NORMAL,PROVICIONAL'
        ]);

        $supply_center = new SupplyCenter;
        $supply_center->fill($data);
        $supply_center->save();
    }

    public function edit(SupplyCenter $supply_center)
    {
        if(Gate::denies('Centro de Abastecimiento'))
            abort(401);
        
        return view('supply-centers.edit', compact('supply_center'));
    }

    public function update(Request $request, SupplyCenter $supply_center)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'supply_center_type' => 'required|in:NORMAL,PROVICIONAL'
        ]);

        $supply_center->fill($data);
        $supply_center->save();
    }

    function destroy(SupplyCenter $supply_center)
    {
        $supply_center->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $supply_centers = SupplyCenter::where('name', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.supply-centers', compact('supply_centers'))->render();
        }
    }
}
