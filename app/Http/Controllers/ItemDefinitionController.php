<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Inventory;
use App\Models\ItemDefinition;
use App\Models\WarehouseLocation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

use Illuminate\Support\Facades\Gate;

class ItemDefinitionController extends Controller
{
    public function index()
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $item_definitions = ItemDefinition::with(['warehouse_location'])->orderBy('id', 'DESC')->paginate(10);
        return view('item-definitions.index', compact('item_definitions'));
    }

    public function create()
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $warehouses = WarehouseLocation::all();
        return view('item-definitions.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reference' => 'nullable|string',
            'name' => 'required|string',
            'brand' => 'required|string',
            'initial_stock' => 'required|numeric',
            //'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'unitary_value' => 'required|numeric',
        ]);

        $item_definition = new ItemDefinition;
        $item_definition->fill($data);
        $item_definition->save();
    }

    public function edit(ItemDefinition $item_definition)
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $warehouses = WarehouseLocation::all();
        return view('item-definitions.edit', compact('item_definition', 'warehouses'));
    }

    public function update(Request $request, ItemDefinition $item_definition)
    {
        $data = $request->validate([
            'reference' => 'nullable|string',
            'name' => 'required|string',
            'brand' => 'required|string',
            'initial_stock' => 'required|numeric',
            //'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'unitary_value' => 'required|numeric',
        ]);

        $item_definition->fill($data);
        $item_definition->save();
    }

    function destroy(ItemDefinition $item_definition)
    {
        $item_definition->delete();
    }
    
    function warehouses(Request $request)
    {
        $id = intval($request->id);
        $warehouse_ids = Inventory::where('item_definition_id', $id)
            ->distinct()
            ->pluck('warehouse_id');
            
        $warehouses = Warehouse::whereIn('id', $warehouse_ids)->get();
        return $warehouses;
    }
    
    public function locations(ItemDefinition $item_definition)
    {
        if(Gate::denies('Inventario'))
            abort(401);
            
        return WarehouseLocation::where('item_definition_id', $item_definition->id)->get();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $item_definitions = ItemDefinition::with(['warehouse_location'])
                ->where('name', 'like', '%' . $filter . '%')
                ->orwhere('reference', 'like', '%' . $filter . '%')
                ->orwhere('unitary_value', 'like', '%' . $filter . '%')
                ->orwhereHas('warehouse_location', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.item-definitions', compact('item_definitions'))->render();
        }
    }
}