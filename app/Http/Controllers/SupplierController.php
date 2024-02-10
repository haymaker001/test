<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index()
    {

        if(Gate::denies('Inventario'))
            abort(401);
        
        $suppliers = Supplier::orderBy('id', 'DESC')->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {

        if(Gate::denies('Inventario'))
            abort(401);
        
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $supplier = new Supplier;
        $supplier->fill($data);
        $supplier->save();
    }

    public function edit(Supplier $supplier)
    {

        if(Gate::denies('Inventario'))
            abort(401);
        
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $supplier->fill($data);
        $supplier->save();
    }

    function destroy(Supplier $supplier)
    {
        $supplier->delete();
    }

    function search(Request $request)
    {
        if($request->ajax())
        {
            $filter = $request->get('query');
            $filter = str_replace("%", " ", $filter);

            $suppliers = Supplier::where('name', 'like', '%' . $filter . '%')
                ->orderBy('id', 'desc')->paginate(10);

            return view('dynamics.suppliers', compact('suppliers'))->render();
        }
    }
}