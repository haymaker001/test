<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\App;
use App\Models\PositionPermission;

class AuthGate
{
    private $current_user;
    private $user_permissions;

    function __construct()
    {
        $this->current_user = \Auth::user();
        $permissions = array();
        foreach($this->current_user->position->permissions ?? array() as $permission)
            array_push($permissions, $permission->permission->name);

        $this->user_permissions = $permissions;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $this->current_user;
        if( !is_null($user) ){
            $permissions = $user->position->permissions;

            foreach($permissions as $permission)
            {
                $name = $permission->permission->name;
                Gate::define($name, function() use ($name){
                    return in_array($name, $this->user_permissions);
                });
            }
        }
        return $next($request);
    }
}
