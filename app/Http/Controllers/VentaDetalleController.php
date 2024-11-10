<?php

namespace App\Http\Controllers;

use App\Models\VentaDetalle;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
    // Constructor con middleware para proteger las rutas
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todos los detalles de ventas
    public function index()
    {
        try {
            // Cambia el nombre de la variable a $ventaDetalles si ese es el nombre esperado en la vista
            $ventaDetalles = VentaDetalle::with(['venta', 'producto'])->paginate(10);

            // Asegúrate de pasar la variable correctamente a la vista
            return view('ventadetalles.index', compact('ventaDetalles'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener los detalles de ventas: ' . $e->getMessage());
        }
    }


    // Método para mostrar el formulario de creación
    public function create()
    {
        // Suponiendo que quieres obtener el último `id_venta` y el cliente asociado
        $venta = Venta::latest()->first(); // Obtener la última venta registrada
        $cliente = $venta ? $venta->cliente : null; // Obtener el cliente asociado si existe

        return view('ventadetalles.create', [
            'id_venta' => $venta->id_venta ?? null,
            'cliente' => $cliente ?? null
        ]);
    }

    // Almacenar un nuevo detalle de venta
    public function store(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'igv' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'cambio' => 'nullable|numeric|min:0',
        ]);

        try {
            // Crear el nuevo detalle de venta
            $detalle = VentaDetalle::create([
                'id_venta' => $request->id_venta,
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $request->precio_unitario,
                'descuento' => $request->descuento ?? 0,
                'igv' => $request->igv ?? 0,
                'subtotal' => $request->subtotal,
                'cambio' => $request->cambio ?? 0,
            ]);

            return redirect()->route('ventadetalles.index')
                ->with('success', 'Detalle de venta creado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear detalle de venta: ' . $e->getMessage());
        }
    }

    // Mostrar los detalles de una venta específica
    public function show($id)
    {
        try {
            $detalle = VentaDetalle::with(['venta', 'producto'])->findOrFail($id);
            return response()->json($detalle, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Detalle de venta no encontrado', 'error' => $e->getMessage()], 404);
        }
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

        try {
            $detalle = VentaDetalle::findOrFail($id);

            $detalle->update($request->all());

            return redirect()->route('ventadetalles.index')
                ->with('success', 'Detalle de venta actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar detalle de venta: ' . $e->getMessage());
        }
    }

    // Eliminar un detalle de venta
    public function destroy($id)
    {
        try {
            $detalle = VentaDetalle::findOrFail($id);
            $detalle->delete();

            return redirect()->route('ventadetalles.index')
                ->with('success', 'Detalle de venta eliminado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar detalle de venta: ' . $e->getMessage());
        }
    }
}
