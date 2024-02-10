<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ItemDefinition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'name',
        'reference',
    	'name',
    	'brand',
    	'initial_stock',
    	'warehouse_location_id',
    	'unitary_value'
    ];
    
    protected $append = ['warehouses'];
    protected $with = ['warehouse_location'];
    
    function getWarehousesAttribute() {
        
        $available_warehouses = [];
        $inventory_in = Inventory::where('item_definition_id', $this->id)->where('inventory_type', 'IN')->get();
        $inventory_out = Inventory::where('item_definition_id', $this->id)->where('inventory_type', 'OUT')->get();
        
        foreach ($inventory_in as $in) {
            $available_quantity = $in->quantity;
        
            foreach ($inventory_out as $out) {
                if ($in->warehouse_id == $out->warehouse_id) {
                    $available_quantity -= $out->quantity;
                }
            }
        
            if ($available_quantity > 0) {
                $available_warehouses[] = $in->warehouse_id;
            }
        }
        
        return $available_warehouses;
	}

    function warehouse_location() {
		return $this->hasOne(WarehouseLocation::class, "id", "warehouse_location_id")->withTrashed();
	}
	
	function getStockAttribute()
	{
	    $inventory_in =  Inventory::where('item_definition_id', $this->id)->where('inventory_type', 'IN')->get();
	    $inventory_out = Inventory::where('item_definition_id', $this->id)->where('inventory_type', 'OUT')->get();
	    
	    if($inventory_in->count() == 0){
	        return 0;
	    }
	    
	    if($inventory_out->count() == 0)
	    {
	        return $inventory_in->sum('pieces');
	    }
	    else
	    {
	        return $inventory_in->sum('pieces') - $inventory_out->sum('pieces');
	    }
	}
}