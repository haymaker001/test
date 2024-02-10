<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    public function index()
    {
        if(Gate::denies('Inventario'))
            abort(401);
        
        $inventories = Inventory::groupBy('item_definition_id', 'warehouse_location_id')->get();
        $inventories = $inventories->where('final_stock', '>', 0);
        
        return view('inventories.index', compact('inventories'));
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $inventories = Inventory::with(['warehouse_location'])
                ->whereHas('item_definition', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->orwhereHas('item_definition', function ($query) use ($filter) {
                    return $query->where('reference', 'like', '%' . $filter . '%');
                })->orwhereHas('warehouse_location', function ($query) use ($filter) {
                    return $query->where('name', 'like', '%' . $filter . '%');
                })->groupBy('item_definition_id', 'warehouse_location_id')->get();
            $inventories = $inventories->where('final_stock', '>', 0);

            return view('dynamics.inventories', compact('inventories'))->render();
        }
    }
}