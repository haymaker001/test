<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FuelConsumption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'supply_center_id',
    	'vehicle_id',
    	'vehicle_type_id',
    	'initial_odometer',
    	'final_odometer',
    	'number_of_gallons',
    	'created_date',
    	'total_mileage',
    	'overall_yield',
    	'client_id',
    	'other',
    	'erp_number',
    	'notes'
    ];

    protected $with = ['vehicle', 'supply_center', 'user'];

    function user() {
		return $this->hasOne(User::class, "id", "user_id")->withTrashed();
	}

	function supply_center() {
		return $this->hasOne(SupplyCenter::class, "id", "supply_center_id")->withTrashed();
	}
	
	function vehicle_type() {
		return $this->hasOne(VehicleType::class, "id", "vehicle_type_id")->withTrashed();
	}

	function vehicle() {
		return $this->hasOne(Vehicle::class, "id", "vehicle_id")->withTrashed();
	}
}