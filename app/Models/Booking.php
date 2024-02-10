<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'customer_id',
    	'center_id',
    	'user_id',
    	'vehicle_id',
    	'driver_id',
    	'pickup',
    	'dropoff',
    	'note',
    	'travellers',
    	'helper',
    	'container',
    	'dolly',
    	'locations',
    	'rate',
    	'rate_outsource',
    	'vehicle_type_id',
    	'travel_type_id',
    	'attachment',
    	'diet',
        'package',
        'payed',
        'pay_date',
        'license_plate',
        'work_order_id',
        'subcontractor_id'
    ];

    protected $appends = ['vehicle_type_name'];
    protected $with = ['center', 'vehicle', 'customer', 'driver', 'travel_type'];

    function customer() {
		return $this->hasOne(User::class, "id", "customer_id")->withTrashed();
	}

	function center() {
		return $this->hasOne(Center::class, "id", "center_id")->withTrashed();
	}

	function user() {
		return $this->hasOne(User::class, "id", "user_id")->withTrashed();
	}

	function vehicle() {
		return $this->hasOne(Vehicle::class, "id", "vehicle_id")->withTrashed();
	}

	function driver() {
		return $this->hasOne(User::class, "id", "driver_id")->withTrashed();
	}

	function vehicle_type() {
		return $this->hasOne(VehicleType::class, "id", "vehicle_type_id")->withTrashed();
	}

	function travel_type() {
		return $this->hasOne(TravelType::class, "id", "travel_type_id")->withTrashed();
	}
	
	function getProfitAttribute()
	{
	    return ($this->rate + $this->additionals) - ($this->rate_outsource + $this->additionals_outsource);
	}
	
	function work_order() {
		return $this->hasOne(WorkOrder::class, "id", "work_order_id");
	}

    function getVehicleTypeNameAttribute()
    {
        $name = null;
        $type = $this->vehicle_type_id;
        if($type == 1)
            $name = 'Grande Seco';
        if($type == 2)
            $name = 'Pequeño Seco';
        if($type == 3)
            $name = 'Contenedor Seco';
        if($type == 4)
            $name = 'Contenedor Refrigerado';
        if($type == 5)
            $name = 'Plana';
        if($type == 6)
            $name = 'Grande Refrigerado';
        if($type == 7)
            $name = 'Pequeño Refrigerado';
        return $name;
    }
}
