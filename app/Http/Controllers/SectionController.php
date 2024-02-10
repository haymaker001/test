<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\WarehouseLocation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class SectionController extends Controller
{
    public function create()
    {
        $warehouses = WarehouseLocation::all();
        return view('sections.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'warehouse_location_id' => 'required|integer|exists:warehouse_locations,id',
            'name' => 'required|string',
        ]);

        $section = new Section;
        $section->fill($data);
        $section->save();
    }

    public function edit(Section $section)
    {
        $warehouses = WarehouseLocation::all();
        return view('sections.edit', compact('section', 'warehouses'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'warehouse_location_id' => 'required|integer|exists:warehouse_locations,id',
            'name' => 'required|string',
        ]);

        $section->fill($data);
        $section->save();
    }

    function destroy(Section $section)
    {
        $section->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $sections = Section::where('name', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.sections', compact('sections'))->render();
        }
    }
}