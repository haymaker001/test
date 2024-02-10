<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'booking_id',
    	'customer_id',
    	'center_id',
    	'user_id',
    	'vehicle_id',
    	'driver_id',
    	'locations',
    	'status',
    	'pickup',
        'dropoff'
    ];

    protected $with = ['center', 'vehicle', 'customer', 'driver', 'travel_type'];
    
    function booking() {
		return $this->hasOne(Booking::class, "id", "booking_id")->withTrashed();
	}

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
