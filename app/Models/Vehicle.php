<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    	'number',
    	'model',
    	'type_id',
    	'vehicle_type_id',
        'vehicle_group_id',
    	'year',
    	'lic_exp_date',
    	'reg_exp_date',
    	'engine_type',
    	'horse_power',
    	'color',
    	'vin',
    	'license_plate',
    	'mileage',
    	'in_service',
    	'user_id',
    	'width',
    	'height',
    	'outsource',
    	'is_reportable',
    ];

    protected $with = ['vehicle_type'];

    function type() {
		return $this->hasOne(Type::class, "id", "customer_id")->withTrashed();
	}

	function vehicle_type() {
		return $this->hasOne(VehicleType::class, "id", "vehicle_type_id")->withTrashed();
	}

    function vehicle_group() {
        return $this->hasOne(VehicleGroup::class, "id", "vehicle_group_id")->withTrashed();
    }

	function user() {
		return $this->hasOne(User::class, "id", "user_id")->withTrashed();
	}
}
