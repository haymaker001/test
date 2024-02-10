<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function truck_types()
    {
    	$truck_types = array(
    		1 => 'Grande Seco',
    		2 => 'Pequeño Seco',
    		3 => 'Contenedor Seco',
    		4 => 'Contenedor Refrigerado',
    		5 => 'Plana',
    		6 => 'Grande Refrigerado',
    		7 => 'Pequeño Refrigerado',
    		8 => 'Jenset',
    		9 => 'Montacarga',
    		10 => 'Mula',
    		11 => 'Rescate'
    	);
    	return $truck_types;
    }
}
