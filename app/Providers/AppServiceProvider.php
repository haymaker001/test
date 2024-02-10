<?php

namespace App\Providers;

use Auth;
use App\Models\Permission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        view()-> composer('layouts.app', function($view){
            $menus = array();
            $permissions = Auth::user()->position->permissions ?? array();

            foreach($permissions as $permission)
            {
                if(!in_array($permission->permission->menu_id, $menus))
                array_push($menus, $permission->permission->menu_id);
            }
            $view->with('menus', $menus);
        });
    }
}
