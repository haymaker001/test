<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'customer_id',
    	'name',
    	'description',
    	'is_active'
    ];

    function customer() {
		return $this->hasOne(User::class, "id", "customer_id")->withTrashed();
	}
}
