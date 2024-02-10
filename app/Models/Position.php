<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'name',
    	'description',
    	'dashboard',
        'can_see_others_data',
        'can_see_rates_on_reports',
    ];

    function users()
    {
    	return $this->hasMany(User::class);
    }

    function permissions()
    {
        return $this->hasMany(PositionPermission::class);
    }
}
