<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class SubcontractorController extends Controller
{
    public function index()
    {
        //if(Gate::denies('Centro de Abastecimiento'))
        //    abort(401);

        $subcontractors = Subcontractor::orderBy('id', 'DESC')->paginate(10);
        return view('subcontractors.index', compact('subcontractors'));
    }

    public function create()
    {
        //if(Gate::denies('Centro de Abastecimiento'))
        //    abort(401);

        return view('subcontractors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $subcontractor = new Subcontractor;
        $subcontractor->fill($data);
        $subcontractor->save();
    }

    public function edit(Subcontractor $subcontractor)
    {
        //if(Gate::denies('Centro de Abastecimiento'))
            //abort(401);
        
        return view('subcontractors.edit', compact('subcontractor'));
    }

    public function update(Request $request, Subcontractor $subcontractor)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $subcontractor->fill($data);
        $subcontractor->save();
    }

    function destroy(Subcontractor $subcontractor)
    {
        $subcontractor->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $subcontractors = Subcontractor::where('name', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.subcontractors', compact('subcontractors'))->render();
        }
    }
}
