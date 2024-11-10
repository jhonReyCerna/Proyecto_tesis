<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
{
    // Cambiar 'get()' por 'paginate()' para paginar las ventas con sus clientes
    $ventas = Venta::with('cliente')->paginate(10); // 10 es el número de registros por página
    return view('ventas.index', compact('ventas'));
}

    // Crear una nueva venta
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    // Guardar una nueva venta
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
        $subtotal = $productoData['cantidad'] * $productoData['precio_unitario'];
        $descuento = $productoData['descuento'];
        $igv = $productoData['igv'];
        $totalProducto = $subtotal - $descuento + $igv;

        // Guardar el detalle de la venta
        $ventaDetalle = new VentaDetalle();
        $ventaDetalle->id_venta = $venta->id_venta;
        $ventaDetalle->id_producto = $productoData['id_producto'];
        $ventaDetalle->id_cliente = $venta->id_cliente;
        $ventaDetalle->cantidad = $productoData['cantidad'];
        $ventaDetalle->precio_unitario = $productoData['precio_unitario'];
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
    return redirect()->route('ventas.index')->with('success', 'Venta y productos guardados correctamente.');
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
}
