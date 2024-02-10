<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

use Illuminate\Support\Facades\Gate;

class EventTypeController extends Controller
{
    public function index()
    {
        $event_types = EventType::paginate(10);
        return view('event-types.index', compact('event_types'));
    }

    public function create()
    {
        return view('event-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $event_type = new EventType;
        $event_type->fill($data);
        $event_type->save();
    }

    public function edit(EventType $event_type)
    {
        return view('event-types.edit', compact('event_type'));
    }

    public function update(Request $request, EventType $event_type)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $event_type->fill($data);
        $event_type->save();
    }

    function destroy(EventType $event_type)
    {
        $event_type->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $event_types = EventType::where('name', 'like', '%' . $filter . '%')->paginate(10);
            return view('dynamics.event-types', compact('event_types'))->render();
        }
    }
}
