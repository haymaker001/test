<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'position',
        'is_editable',
    ];

    protected $appends = ['children'];

    //protected $with = ['center', 'vehicle', 'customer', 'driver', 'travel_type'];

    function getChildrenAttribute(){
        return Permission::whereNull('parent_id')->where('menu_id', $this->id)
            ->get(['id', 'menu_id', 'parent_id', 'name']);

    }
}
