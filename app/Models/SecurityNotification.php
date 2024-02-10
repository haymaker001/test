<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SecurityNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'name',
        'phone',
        'created_date',
        'event_type_id',
        'place',
        'location',
        'center_id',
        'vehicle_id',
        'notes'
    ];

    function event_type() {
		return $this->hasOne(EventType::class, "id", "event_type_id")->withTrashed();
	}
	
	function vehicle() {
		return $this->hasOne(Vehicle::class, "id", "vehicle_id")->withTrashed();
	}
	
	function center() {
		return $this->hasOne(Center::class, "id", "center_id")->withTrashed();
	}

    function details()
    {
        return $this->hasMany(SecurityNotificationImage::class);
    }
}
