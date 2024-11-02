<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::all();
        $almacenes = Almacen::paginate(10);
        return view('almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        return view('almacenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer',
        ]);

        Almacen::create($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén creado exitosamente.');
    }

    public function show(Almacen $almacen)
    {
        return view('almacenes.show', compact('almacen'));
    }

    public function edit(Almacen $almacen)
    {
        return view('almacenes.edit', compact('almacen'));
    }

    public function update(Request $request, Almacen $almacen)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer',
        ]);

        $almacen->update($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado exitosamente.');
    }

    public function destroy(Almacen $almacen)
    {
        $almacen->delete();
        return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado exitosamente.');
    }
}
