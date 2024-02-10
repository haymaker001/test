<?php

namespace App\Exports;

use Auth;
use App\Models\Rate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RatesExport implements FromView, ShouldAutoSize
{
    function view(): View
    {
        return view('exports.rates', [
            'rates' => Rate::all()
        ]);
    }
}
