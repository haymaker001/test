<?php

namespace App\Http\Controllers;
use PDF;
use Auth;
use App\Models\Technician;
use App\Models\Vehicle;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Models\ItemDefinition;
use App\Models\WarehouseLocation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class InventoryOutController extends Controller
{
    
    
    public function index()
    {
        if(Gate::denies('Inventario'))
            abort(401);
        
        $inventories = Inventory::with(['item_definition', 'warehouse_location'])->where('inventory_type', 'OUT')->orderBy('id', 'desc')->paginate(10);
        return view('inventories.out.index', compact('inventories'));
    }

    public function create()
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $vehicles = Vehicle::all();
        $items = ItemDefinition::all();
        $whs = Warehouse::all();
        $technicians = Technician::all();
        $warehouses = WarehouseLocation::all();
        return view('inventories.out.create', compact('whs', 'warehouses', 'items', 'vehicles', 'technicians'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_definition_id' => 'required|exists:item_definitions,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'section_id' => 'required|exists:sections,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'price' => 'nullable|numeric',
            'pieces' => 'required|integer',
            'notes' => 'nullable|string|max:190',
            'technician_id' => 'nullable|exists:technicians,id',
            'technical' => 'nullable|string|max:190',
        ]);
        
        $inventary = Inventory::where([
            ['item_definition_id', $request->item_definition_id],
            ['warehouse_location_id', $request->warehouse_location_id]    
        ])->where('inventory_type', 'IN')->first();
        
        if($inventary == null)
            abort(response()->json(['message' => 'No hay existencia de este producto en inventario'], 401));
        
        if($request->pieces > $inventary->in_stock)
            abort(response()->json(['message' => 'La cantidad de productos a retirar no puede ser mayor a la disponible en inventario que es: ' . $inventary->in_stock ], 401));

        $center = new Inventory;
        $center->fill($data);
        $center->created_date = date('Y-m-d');
        $center->user_id = Auth::user()->id;
        $center->inventory_type = 'OUT';
        $center->save();
    }

    public function edit(Inventory $inventories_out)
    {
        if(Gate::denies('Inventario'))
            abort(401);

        $whs = Warehouse::all();
        $vehicles = Vehicle::all();
        $inventory = $inventories_out;
        $items = ItemDefinition::all();
        $technicians = Technician::all();
        $warehouses = WarehouseLocation::all();
        return view('inventories.out.edit', compact('whs', 'inventory', 'warehouses', 'items', 'vehicles', 'technicians'));
    }

    public function update(Request $request, Inventory $inventories_out)
    {
        $data = $request->validate([
            'item_definition_id' => 'required|exists:item_definitions,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'warehouse_location_id' => 'required|exists:warehouse_locations,id',
            'section_id' => 'required|exists:sections,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'price' => 'nullable|numeric',
            'pieces' => 'required|integer',
            'notes' => 'nullable|string|max:190',
            'technical' => 'nullable|string|max:190',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);
        
        DB::transaction(function () use ($data, $request, $inventories_out){
            
            //if pieces is the same as old values, update the changes otherwise,
            //remove pieces and validate if there is enough to assign.
            if($inventories_out->pieces == $request->pieces){
                $inventories_out->fill($data);
                $inventories_out->save();
            } else {
                $inventories_out->pieces = 0;
                $inventories_out->save();
            
                if($request->pieces > $inventories_out->in_stock)
                    abort(response()->json(['message' => 'La cantidad de productos a retirar no puede ser mayor a la disponible en inventario que es: ' . $inventories_out->in_stock ], 401));
                    
                $inventories_out->fill($data);
                $inventories_out->save();
            }
        });
    }

    function destroy(Inventory $inventories_out)
    {
        $inventories_out->delete();
    }
    
    function pdf(Inventory $inventories_out)
    {
        $booking = $inventories_out;
        $pdf = PDF::loadView('inventories.out.pdf', compact('booking'));
        return $pdf->setPaper('letter')->stream('inventory-out.pdf');
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);
            
            $inventories = Inventory::with(['item_definition'])->where(function ($query) use ($filter) {
                $query->whereHas('item_definition', function ($q) use ($filter) {
                    return $q->where('name', 'like', '%' . $filter . '%');
                })->orWhereHas('item_definition', function ($q) use ($filter) {
                    return $q->where('reference', 'like', '%' . $filter . '%');
                });
            })->where('inventory_type', 'OUT')->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.inventories-out', compact('inventories'))->render();
        }
    }
    
    
    public function get_inventory_items()
    {
        $in_count = 0;
        $out_count = 0;
        $items = collect();
        $ItemList = ItemDefinition::all();
        foreach($ItemList as $item)
        {
            $IN = Inventory::where('item_definition_id', $item->id)->where('inventory_type', 'IN')->get();
            
            if($IN->count() == 0)
                return;
                
            foreach($IN as $item_in)
                $in_count += $item_in->pieces;
            
            $OUT = Inventory::where('item_definition_id', $item->id)->where('inventory_type', 'OUT')->get();
            
            if($OUT->count() > 0)
                foreach($OUT as $item_out)
                    $out_count =+ $item_out->pieces;
                    
            $in_stock = $in_count - $out_count;
            
            //dd($in_stock);
            
            if($in_stock > 0)
                $items->push($item);   
        }
        //dd($items);
    }
}