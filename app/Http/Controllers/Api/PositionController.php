<?php

namespace App\Http\Controllers\Api;

use App\Models\Position;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('id', 'DESC')->get();
        return $positions;
    }

    public function store(StorePositionRequest $request)
    {
        $position = new Position;
        $position->name = $request->position["name"];
        $position->description = $request->position["description"];
        $position->dashboard = $request->position["dashboard"];
        $position->save();
        return $position;
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        $id = intval($id);
        $position = Position::where('id', $id)->first();

        if ($position) {
            $position->name = $request->position["name"];
            $position->description = $request->position["description"];
            $position->dashboard = $request->position["dashboard"];
            $position->save();
            return $position;
        }
        return "Registro no encontrado.";
    }

    public function destroy($id)
    {
        $id = intval($id);
        $position = Position::where('id', $id)->first();

        if ($position) {
            $position->delete();
            return "Registro eliminado exitosamente.";
        }
        return "Registro no encontrado.";
    }
}
