<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $clientes = Cliente::paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }


    public function store(Request $request)
{

    $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|email|unique:clientes,email',
        'dni' => 'required|string|size:8|unique:clientes,dni',
        'fecha_nacimiento' => 'nullable|date',
        'genero' => 'nullable|in:masculino,femenino,otro',
        'tipo_cliente' => 'nullable|string|max:255',
    ]);


    $cliente = Cliente::create($request->all());


    return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
}


    public function show(string $id)
{

    $cliente = Cliente::find($id);


    if (!$cliente) {
        return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
    }


    return view('clientes.show', compact('cliente'));
}

    /**
     * Show the form for editing the specified cliente.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
{

    $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|email',
        'dni' => 'required|string|max:8',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string',
        'tipo_cliente' => 'required|string',
    ]);

    $cliente->update($request->all());

    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
}

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json(null, 204);
    }

    public function buscarPorDni($dni)
    {
        
        $cliente = Cliente::where('dni', $dni)->first();

        if ($cliente) {
            return response()->json([
                'status' => 'success',
                'cliente' => $cliente
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ]);
        }
    }

}
