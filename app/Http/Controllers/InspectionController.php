<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

use Illuminate\Support\Facades\Gate;

class InspectionController extends Controller
{
    public function index()
    {

        if(Gate::denies('Posiciones'))
            abort(401);
        
        $positions = Position::orderBy('id', 'DESC')->paginate(10);
        return view('inspections.index', compact('positions'));
    }

    public function create()
    {

        if(Gate::denies('Posiciones'))
            abort(401);
        
        return view('inspections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'dashboard' => 'required|string|in:SI,NO',
            'can_see_others_data' => 'required|string|in:SI,NO',
            'can_see_rates_on_reports' => 'required|string|in:SI,NO',
        ]);

        $position = new Position;
        $position->fill($data);
        $position->save();
    }

    public function edit(Position $position)
    {

        if(Gate::denies('Posiciones'))
            abort(401);
        
        return view('inspections.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'dashboard' => 'required|string|in:SI,NO',
            'can_see_others_data' => 'required|string|in:SI,NO',
            'can_see_rates_on_reports' => 'required|string|in:SI,NO',
        ]);

        $position->fill($data);
        $position->save();
    }

    function destroy(Position $position)
    {
        $position->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $positions = Position::where('name', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.inspections', compact('positions'))->render();
        }
    }
}
