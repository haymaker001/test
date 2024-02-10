<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
    	'customer_id',
    	'center_id',
    	'vehicle_type_id',
    	'location_id',
    	'rate',
    	'travel_type_id',
    	'diet',
    	'rate_outsource',
    ];

    protected $appends = ['vehicle_type_name'];

    protected $with = ['center', 'vehicle_type', 'location', 'customer', 'travel_type'];

    function customer() {
		return $this->hasOne(User::class, "id", "customer_id")->withTrashed();
	}

	function center() {
		return $this->hasOne(Center::class, "id", "center_id")->withTrashed();
	}

	function vehicle_type() {
		return $this->hasOne(VehicleType::class, "id", "vehicle_type_id")->withTrashed();
	}

	function location() {
		return $this->hasOne(Location::class, "id", "location_id")->withTrashed();
	}

	function travel_type() {
		return $this->hasOne(TravelType::class, "id", "travel_type_id")->withTrashed();
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
