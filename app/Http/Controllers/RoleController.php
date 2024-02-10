<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Position;
use App\Models\PositionPermission;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    function index()
    {
        if(Gate::denies('Roles'))
            abort(401);
        
        $menus = Menu::all();
        $positions = Position::all();
        return view('roles.index', compact('menus', 'positions'));
    }

    function positions_store(Request $request, Position $position)
    {
        if(request()->ajax())
        {
            $request->validate([
                'permissions' => 'required|string',
                'position_id' => 'required|exists:positions,id',
            ]);
            
            $position = Position::findOrFail($request->position_id);
            
            DB::transaction(function() use ($position, $request){
                //delete old values
                PositionPermission::where('position_id', $position->id)->forceDelete();
                //insert new values
                $permissions = explode(',', $request->permissions);
    
                foreach($permissions as $permission){
                    if(is_numeric($permission))
                    {
                        $position_permission = new PositionPermission([
                            'permission_id' => $permission,
                            'position_id' => $position->id
                        ]);
                        $position_permission->save();
                    }
                }
                return $position->id;
            });
        }
        return redirect()->back();
    }

    function permissions(Position $position)
    {
        $permissions = PositionPermission::where('position_id', $position->id)->get('permission_id')->pluck('permission_id');
        return $permissions->toArray();
    }

    function menu()
    {
        $menus = Menu::all();
        return $menus;
    }
}
