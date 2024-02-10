<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PositionPermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'position_id',
        'permission_id',
    ];

    protected $with = ['permission'];

    public function position()
    {
        return $this->belongsTo(Position::class)->withTrashed();
    }

    function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
