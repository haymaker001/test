<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'item_definition_id',
        'price',
        'pieces',
        'warehouse_id',
        'warehouse_location_id',
        'section_id',
        'created_date',
        'notes',
        'vehicle_id',
        'technician_id',
        'technical',
        'supplier_id',
    ];
    
    protected $appends = ['entrance_price'];

    protected $with = ['warehouse_location', 'item_definition', 'vehicle'];
    
    public function getEntrancePriceAttribute()
    {
        $item = Inventory::where([
            ['item_definition_id', $this->item_definition_id]   
        ])->where('inventory_type', 'IN')->latest('created_at')->first();
        return $item->price ?? '0.00';
    }
    
    public function getLatestEntranceAttribute()
    {
        $latest_entrance = Inventory::where([
            ['item_definition_id', $this->item_definition_id]   
        ])->where('inventory_type', 'IN')->latest('created_at')->first();
        return $latest_entrance->created_date ?? 'N/A';
    }
    
    public function getLatestPriceAttribute()
    {
        $last_price = Inventory::where([
            ['item_definition_id', $this->item_definition_id]   
        ])->where('inventory_type', 'IN')->latest('created_at')->first();
        return $last_price->price ?? '0.00';
    }
    
    function user() {
		return $this->hasOne(User::class, "id", "user_id")->withTrashed();
	}
    
    function warehouse() {
		return $this->hasOne(Warehouse::class, "id", "warehouse_id")->withTrashed();
	}

    function vehicle() {
		return $this->hasOne(Vehicle::class, "id", "vehicle_id")->withTrashed();
	}
	
	function section() {
		return $this->hasOne(Section::class, "id", "section_id")->withTrashed();
	}
	
	function supplier() {
		return $this->hasOne(Vehicle::class, "id", "supplier_id")->withTrashed();
	}
	
	function item_definition() {
		return $this->hasOne(ItemDefinition::class, "id", "item_definition_id")->withTrashed();
	}
	
	function technician(){
	    return $this->hasOne(Technician::class, "id", "technician_id")->withTrashed();
	}
	
	function warehouse_location() {
		return $this->hasOne(WarehouseLocation::class, "id", "warehouse_location_id")->withTrashed();
	}
	
	public function getInitialStockAttribute()
    {
        $initialStock = Inventory::where([
            ['item_definition_id', $this->item_definition_id],
            ['warehouse_location_id', $this->warehouse_location_id]    
        ])->where('inventory_type', 'IN')->first();
        return $initialStock->pieces ?? 0;
    }
    
    public function getInStockAttribute()
    {
        $stock = 0;
        $items = Inventory::where([
            ['inventory_type', 'IN'],
            ['item_definition_id', $this->item_definition_id],
            ['warehouse_location_id', $this->warehouse_location_id]    
        ])->get();
        
        foreach($items as $item)
            $stock += $item->pieces;
        
        return $stock;
    }
    
    public function getOutStockAttribute()
    {
        $stock = 0;
        $items = Inventory::where([
            ['inventory_type', 'OUT'],
            ['item_definition_id', $this->item_definition_id],
            ['warehouse_location_id', $this->warehouse_location_id]    
        ])->get();
        
        foreach($items as $item)
            $stock += $item->pieces;
        
        return $stock;
    }
    
    public function getFinalStockAttribute()
    {
        return $this->getInStockAttribute() - $this->getOutStockAttribute();
    }
    
    public function getHasAssignPiecesAttribute()
    {
        $assignPieces = Inventory::where([
            ['inventory_type', 'OUT'],
            ['item_definition_id', $this->item_definition_id],
            ['warehouse_location_id', $this->warehouse_location_id]    
        ])->first();
        
        return $assignPieces == null ? false : true;
    }
}