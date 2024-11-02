<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{

    public function index(Request $request)
{

    $query = Proveedor::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('ruc', 'LIKE', "%{$search}%");
    }

    $proveedores = $query->paginate(10);

    return view('proveedores.index', compact('proveedores'));
}

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {

       $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email|unique:proveedores,email',
        'ruc' => 'required|string|size:11|unique:proveedores,ruc',
    ]);

    Proveedor::create($request->all());

    return redirect()->route('proveedores.index')->with('success', 'Proveedor agregado exitosamente.');
    }

    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'ruc' => 'required|string|max:11',
        ]);

        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado exitosamente.');
    }
}
