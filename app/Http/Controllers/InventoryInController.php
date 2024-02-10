<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Models\ItemDefinition;
use App\Models\WarehouseLocation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class InventoryInController extends Controller
{
    public function index()
    {
        if(Gate::denies('Inventario'))
            abort(401);
        
        $inventories = Inventory::with(['item_definition', 'warehouse_location'])->where('inventory_type', 'IN')->orderBy('id', 'desc')->paginate(10);
        return view('inventories.in.index', compact('inventories'));
    }

    public function create()
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $suppliers = Supplier::all();
        $items = ItemDefinition::all();
        $whs = Warehouse::all();
        $warehouses = WarehouseLocation::all();
        return view('inventories.in.create', compact('whs', 'warehouses', 'items', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_definition_id' => 'required|exists:item_definitions,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric',
            'pieces' => 'required|integer',
            'warehouse_id' => 'required|exists:warehouses,id',
            'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'section_id' => 'required|exists:sections,id',
            'notes' => 'nullable|string|max:190',
        ]);

        $center = new Inventory;
        $center->fill($data);
        $center->created_date = date('Y-m-d');
        $center->user_id = Auth::user()->id;
        $center->inventory_type = 'IN';
        $center->save();
    }

    public function edit(Inventory $inventories_in)
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $suppliers = Supplier::all();
        $whs = Warehouse::all();
        $inventory = $inventories_in;
        $items = ItemDefinition::all();
        $warehouses = WarehouseLocation::all();
        return view('inventories.in.edit', compact('whs', 'inventory', 'warehouses', 'items', 'suppliers'));
    }

    public function update(Request $request, Inventory $inventories_in)
    {
        $data = $request->validate([
            'item_definition_id' => 'required|exists:item_definitions,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric',
            'pieces' => 'required|integer',
            'warehouse_id' => 'required|exists:warehouses,id',
            'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'section_id' => 'required|exists:sections,id',
            'notes' => 'nullable|string|max:190',
        ]);
        
        if($inventories_in->has_assign_pieces)
            abort(response()->json(['message' => 'No se puede modificar una entrada que ya ha tenido salidas, favor eliminar las salidas antes de proceder.'], 401));
        
        $inventories_in->fill($data);
        $inventories_in->save();
    }

    function destroy(Inventory $inventories_in)
    {
        if($inventories_in->has_assign_pieces)
            abort(response()->json(['message' => 'No se puede eliminar una entrada que ya ha tenido salidas, favor eliminar las salidas antes de proceder.'], 401));
        
        $inventories_in->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $inventories = Inventory::with(['item_definition'])
                ->where('inventory_type', 'IN')
                ->whereHas('item_definition', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('item_definition', function ($query) use ($filter) {
                    return $query->where('reference', 'like', '%' . $filter . '%');
                })->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.inventories-in', compact('inventories'))->render();
        }
    }
}