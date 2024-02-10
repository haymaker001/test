<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'warehouse_location_id',
    	'name',
    ];

    function warehouse_location() {
		return $this->hasOne(WarehouseLocation::class, "id", "warehouse_location_id")->withTrashed();
	}
}