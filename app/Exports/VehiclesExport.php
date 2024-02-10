<?php

namespace App\Exports;

use Auth;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VehiclesExport implements FromView, ShouldAutoSize
{
    function view(): View
    {
        return view('exports.vehicles', [
            'vehicles' => Vehicle::all()
        ]);
    }
}
