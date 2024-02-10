<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarehouseLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'name',
    ];
    
    public function sections()
    {
        return $this->hasMany(Section::class, 'warehouse_location_id')->withTrashed();
    }
}