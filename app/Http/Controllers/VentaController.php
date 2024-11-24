<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\VentaDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->paginate(10); // 10 es el número de registros por página
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        // Validar la información de la venta
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:Pendiente,Pagado',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
            'productos.*.descuento' => 'nullable|numeric|min:0', // Hacer que el descuento sea opcional
        ]);

        // Crear la venta
        $venta = new Venta();
        $venta->id_cliente = $request->id_cliente;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->estado = $request->estado;
        $venta->totalPagar = 0; // Inicialmente es 0, se actualizará con los detalles
        $venta->save();

        // Crear los detalles de la venta
        $totalPagar = 0;
        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);
            $precioUnitario = $producto->precio; // Obtener el precio del producto
            $cantidad = $productoData['cantidad'];
            $descuento = $productoData['descuento'] ?? 0; // Usar 0 si no se proporciona descuento
            $subtotal = $cantidad * $precioUnitario;
            $igv = $subtotal * 0.18; // Calcular el IGV (18%)
            $totalProducto = $subtotal - $descuento + $igv;

            // Guardar el detalle de la venta
            $ventaDetalle = new VentaDetalle();
            $ventaDetalle->id_venta = $venta->id_venta;
            $ventaDetalle->id_producto = $productoData['id_producto'];
            $ventaDetalle->cantidad = $cantidad;
            $ventaDetalle->precio_unitario = $precioUnitario;
            $ventaDetalle->descuento = $descuento;
            $ventaDetalle->igv = $igv;
            $ventaDetalle->subtotal = $subtotal;
            $ventaDetalle->cambio = 0; // Puedes agregar lógica para calcular el cambio si es necesario
            $ventaDetalle->save();

            // Acumulamos el total
            $totalPagar += $totalProducto;
        }

        // Actualizar el totalPagar de la venta
        $venta->totalPagar = $totalPagar;
        $venta->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    // Ver los detalles de una venta
    public function show($id)
    {
        // Cargar la venta con sus detalles y productos asociados
        $venta = Venta::with('detalles.producto', 'cliente')->findOrFail($id);

        return view('ventas.show', compact('venta'));
    }

    // Editar una venta (si es necesario)
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    // Eliminar una venta
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index');
    }

    public function buscarClientePorDni($dni)
    {
        // Buscar el cliente por DNI
        $cliente = Cliente::where('dni', $dni)->first();

        if ($cliente) {
            // Retornar la información del cliente si se encuentra
            return response()->json([
                'success' => true,
                'cliente' => $cliente
            ]);
        } else {
            // Si no se encuentra el cliente
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado.'
            ]);
        }
    }

    public function facturaPDF($id)
    {
        // Obtener la venta con todos sus detalles
        $venta = Venta::with('cliente', 'detalles.producto')->findOrFail($id);

        // Generar el PDF con la vista 'factura'
        $pdf = Pdf::loadView('ventas.factura', compact('venta'));

        // Descargar el PDF
        return $pdf->download('factura_venta_'.$venta->id_venta.'.pdf');
    }

    public function update(Request $request, $id)
    {
        // Validar la información de la venta
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:Pendiente,Pagado',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Actualizar la venta
        $venta = Venta::findOrFail($id);
        $venta->id_cliente = $request->id_cliente;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->estado = $request->estado;
        $venta->totalPagar = 0; // Inicialmente es 0, se actualizará con los detalles
        $venta->save();

        // Eliminar los detalles existentes
        VentaDetalle::where('id_venta', $venta->id_venta)->delete();

        // Crear los nuevos detalles de la venta
        $totalPagar = 0;
        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);
            $precioUnitario = $producto->precio; // Obtener el precio del producto
            $cantidad = $productoData['cantidad'];
            $descuento = $productoData['descuento'];
            $subtotal = $cantidad * $precioUnitario;
            $igv = $subtotal * 0.18; // Calcular el IGV (18%)
            $totalProducto = $subtotal - $descuento + $igv;

            // Guardar el detalle de la venta
            $ventaDetalle = new VentaDetalle();
            $ventaDetalle->id_venta = $venta->id_venta;
            $ventaDetalle->id_producto = $productoData['id_producto'];
            $ventaDetalle->cantidad = $cantidad;
            $ventaDetalle->precio_unitario = $precioUnitario;
            $ventaDetalle->descuento = $descuento;
            $ventaDetalle->igv = $igv;
            $ventaDetalle->subtotal = $subtotal;
            $ventaDetalle->cambio = 0; // Puedes agregar lógica para calcular el cambio si es necesario
            $ventaDetalle->save();

            // Acumulamos el total
            $totalPagar += $totalProducto;
        }

        // Actualizar el totalPagar de la venta
        $venta->totalPagar = $totalPagar;
        $venta->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function reporte()
{
    // Get all ventas with cliente relationship
    $ventas = Venta::with('cliente')->get();

    // Generate PDF
    $pdf = PDF::loadView('ventas.reporte', compact('ventas'));

    // Download with filename
    return $pdf->download('reporte-ventas.pdf');
}
}
