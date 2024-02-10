<?php

namespace App\Http\Controllers;
use App\Models\ItemDefinition;
use App\Models\Inventory;
use App\Models\WarehouseLocation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

use Illuminate\Support\Facades\Gate;

class WarehouseController extends Controller
{
    public function index()
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $warehouses = WarehouseLocation::orderBy('id', 'DESC')->paginate(10);
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        if(Gate::denies('Inventario'))
            abort(401);
            
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $center = new WarehouseLocation;
        $center->fill($data);
        $center->save();
    }

    public function edit(WarehouseLocation $warehouse)
    {
        if(Gate::denies('Inventario'))
            abort(401);

        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, WarehouseLocation $warehouse)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $warehouse->fill($data);
        $warehouse->save();
    }

    function destroy(WarehouseLocation $warehouse)
    {
        $warehouse->delete();
    }
    
    function sections(Request $request)
    {
        $id = intval($request->id);
        $warehouse = WarehouseLocation::findOrFail($id);
        return $warehouse->sections()->select('id', 'name')->get();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $warehouses = WarehouseLocation::where('name', 'like', '%' . $filter . '%')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.warehouses', compact('warehouses'))->render();
        }
    }
    
    public function locations(ItemDefinition $item_definition)
    {
        $records = Inventory::where('item_definition_id', $item_definition->id)->where('inventory_type', 'IN')->distinct('warehouse_location_id')->get('warehouse_location_id');
        return $records;
    } 
}