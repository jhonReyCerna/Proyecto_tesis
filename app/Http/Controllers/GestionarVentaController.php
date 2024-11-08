<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\GestionarVenta;
use Illuminate\Http\Request;

class GestionarVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = GestionarVenta::with('cliente')->paginate(10); // O cualquier otra lógica de paginación que necesites

        // Pasar las ventas a la vista
        return view('gestionarventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all(); // Trae todos los clientes
        return view('gestionarventas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'totalPagar' => 'required|numeric|min:0',
        'fecha' => 'required|date',
        'estado' => 'required|in:pendiente,pagado',
    ]);

    // Crear la venta
    $venta = new GestionarVenta();
    $venta->id_cliente = $request->id_cliente;
    $venta->totalPagar = $request->totalPagar;
    $venta->fecha = $request->fecha;
    $venta->estado = $request->estado;
    $venta->save();

    return redirect()->route('gestionarventas.index')->with('success', 'Venta registrada con éxito.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
