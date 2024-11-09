<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Mostrar una lista de todas las ventas con los clientes relacionados.
     */
    public function index()
    {
        // Cargar todas las ventas con sus clientes relacionados, paginados
        $ventas = Venta::with('cliente')->paginate(10);

        return view('ventas.index', compact('ventas'));
    }

    /**
     * Mostrar el formulario para crear una nueva venta.
     */
    public function create()
    {
        // Obtener todos los clientes disponibles para el formulario
        $clientes = Cliente::all();

        return view('ventas.create', compact('clientes'));
    }

    /**
     * Almacenar una nueva venta.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id_cliente',
            'totalPagar' => 'required|numeric',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'id_cliente' => $request->cliente_id,
            'totalPagar' => $request->totalPagar,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);

        // Redirigir al listado de ventas con mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito');
    }

    /**
     * Mostrar los detalles de una venta específica.
     */
    public function show($id)
    {
        // Buscar la venta con el cliente relacionado
        $venta = Venta::with('cliente')->find($id);

        if (!$venta) {
            return redirect()->route('ventas.index')->with('error', 'Venta no encontrada');
        }

        return view('ventas.show', compact('venta'));
    }

    /**
     * Mostrar el formulario para editar una venta.
     */
    public function edit($id)
    {
        // Obtener la venta a editar
        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->route('ventas.index')->with('error', 'Venta no encontrada');
        }

        // Obtener todos los clientes disponibles para el formulario
        $clientes = Cliente::all();

        return view('ventas.edit', compact('venta', 'clientes'));
    }

    /**
     * Actualizar los detalles de una venta existente.
     */
    public function update(Request $request, $id)
    {
        // Buscar la venta
        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->route('ventas.index')->with('error', 'Venta no encontrada');
        }

        // Validación de los datos
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id_cliente',
            'totalPagar' => 'required|numeric',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        // Actualizar la venta
        $venta->update([
            'id_cliente' => $request->cliente_id,
            'totalPagar' => $request->totalPagar,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito');
    }

    /**
     * Eliminar una venta.
     */
    public function destroy($id)
    {
        // Buscar la venta
        $venta = Venta::find($id);

        if (!$venta) {
            return redirect()->route('ventas.index')->with('error', 'Venta no encontrada');
        }

        // Eliminar la venta
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito');
    }
}
