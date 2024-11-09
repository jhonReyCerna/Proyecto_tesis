<?php

namespace App\Http\Controllers;

use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
    // Mostrar todos los detalles de ventas
    public function index()
    {
        // Obtener los detalles de ventas paginados (10 por página, por ejemplo)
        $ventaDetalles = VentaDetalle::paginate(10);

        // Pasar la variable a la vista
        return view('ventadetalles.index', compact('ventaDetalles'));
    }

    // Mostrar el formulario para crear un nuevo detalle de venta
    public function create()
    {
        // Pasar la variable a la vista
        return view('ventadetalles.create', );
    }

    // Guardar un nuevo detalle de venta
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'igv' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'cambio' => 'nullable|numeric|min:0',
        ]);

        // Crear el nuevo detalle de venta
        VentaDetalle::create($validated);

        // Redirigir a la lista de detalles de ventas con un mensaje de éxito
        return redirect()->route('ventadetalles.index')->with('success', 'Detalle de venta creado con éxito.');
    }

    // Mostrar el detalle de una venta específica
    public function show($id)
    {
        // Buscar el detalle de venta por su id
        $ventaDetalle = VentaDetalle::findOrFail($id);

        // Pasar la variable a la vista
        return view('ventadetalles.show', compact('ventaDetalle'));
    }

    // Mostrar el formulario para editar un detalle de venta
    public function edit($id)
    {
        // Buscar el detalle de venta por su id
        $ventaDetalle = VentaDetalle::findOrFail($id);

        // Pasar la variable a la vista
        return view('ventadetalles.edit', compact('ventaDetalle'));
    }

    // Actualizar un detalle de venta
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'igv' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'cambio' => 'nullable|numeric|min:0',
        ]);

        // Buscar el detalle de venta por su id
        $ventaDetalle = VentaDetalle::findOrFail($id);

        // Actualizar el detalle de venta
        $ventaDetalle->update($validated);

        // Redirigir a la lista de detalles de ventas con un mensaje de éxito
        return redirect()->route('ventadetalles.index')->with('success', 'Detalle de venta actualizado con éxito.');
    }

    // Eliminar un detalle de venta
    public function destroy($id)
    {
        // Buscar el detalle de venta por su id
        $ventaDetalle = VentaDetalle::findOrFail($id);

        // Eliminar el detalle de venta
        $ventaDetalle->delete();

        // Redirigir a la lista de detalles de ventas con un mensaje de éxito
        return redirect()->route('ventadetalles.index')->with('success', 'Detalle de venta eliminado con éxito.');
    }
}
