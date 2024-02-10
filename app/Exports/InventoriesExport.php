<?php

namespace App\Exports;

use Auth;
use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InventoriesExport implements FromView, ShouldAutoSize
{
    function view(): View
    {
        return view('exports.inventories', [
            'inventories' => Inventory::all()
        ]);
    }
}