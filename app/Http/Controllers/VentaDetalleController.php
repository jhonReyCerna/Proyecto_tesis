<?php

namespace App\Http\Controllers;

use App\Models\VentaDetalle;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
    // Constructor con middleware para proteger las rutas si es necesario (ejemplo autenticación)
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todos los detalles de las ventas
    public function index()
    {
        $detalles = VentaDetalle::with('venta', 'producto')->get(); // Traer detalles con las relaciones
        return response()->json($detalles);
    }

    // Mostrar los detalles de una venta específica
    public function show($id)
    {
        $detalle = VentaDetalle::with('venta', 'producto')->findOrFail($id);
        return response()->json($detalle);
    }

    // Almacenar un nuevo detalle de venta
    public function store(Request $request)
    {
        $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'igv' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'cambio' => 'nullable|numeric',
        ]);

        $detalle = new VentaDetalle([
            'id_venta' => $request->id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'descuento' => $request->descuento,
            'igv' => $request->igv,
            'subtotal' => $request->subtotal,
            'cambio' => $request->cambio,
        ]);

        $detalle->save();

        return response()->json([
            'message' => 'Detalle de venta creado exitosamente',
            'detalle' => $detalle
        ], 201);
    }

    // Actualizar un detalle de venta existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'igv' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'cambio' => 'nullable|numeric',
        ]);

        $detalle = VentaDetalle::findOrFail($id);
        $detalle->update([
            'id_venta' => $request->id_venta,
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'descuento' => $request->descuento,
            'igv' => $request->igv,
            'subtotal' => $request->subtotal,
            'cambio' => $request->cambio,
        ]);

        return response()->json([
            'message' => 'Detalle de venta actualizado exitosamente',
            'detalle' => $detalle
        ]);
    }

    // Eliminar un detalle de venta
    public function destroy($id)
    {
        $detalle = VentaDetalle::findOrFail($id);
        $detalle->delete();

        return response()->json(['message' => 'Detalle de venta eliminado exitosamente']);
    }
}
