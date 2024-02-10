<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'rnc',
        'name',
        'email',
        'password',
        'user_type',
        'additional',
        'amount',
        'calculation_type',
        'position_id',
        'customer_id',
        'driver_type',
        'supply_center_id',
        'additional_outsource',
        'amount_outsource',
    ];

    protected $with = ['position'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function position() {
        return $this->hasOne(Position::class, "id", "position_id")->withTrashed();
    }

    function centers(){
        return $this->hasMany(Center::class, "customer_id", "id");
    }

    function locations(){
        return $this->hasMany(Location::class, "customer_id", "id");
    }
    
    function bookings(){
        return $this->hasMany(Booking::class, "customer_id", "id");
    }
    
    function customer() {
        return $this->hasOne(User::class, "id", "customer_id")->withTrashed();
    }
    
    function supply_center() {
        return $this->hasOne(SupplyCenter::class, "id", "supply_center_id")->withTrashed();
    }
}
