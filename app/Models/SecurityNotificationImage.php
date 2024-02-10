<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SecurityNotificationImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'security_notification_id',
        'image',
    ];

    function security_notification() {
		return $this->hasOne(SecurityNotification::class, "id", "security_notification_id")->withTrashed();
	}
}
