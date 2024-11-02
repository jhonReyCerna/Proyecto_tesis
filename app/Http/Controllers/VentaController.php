<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar lista de ventas
    public function index()
    {
        $ventas = Venta::paginate(10); 
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    // Almacenar una nueva venta en la base de datos
    public function store(Request $request)
{
    // Validar los datos de la solicitud
    $request->validate([
        'producto_id' => 'required|exists:productos,id_producto',
        'cliente_id' => 'required|exists:clientes,id_cliente',
        'cantidad' => 'required|integer|min:1',
        'fecha' => 'required|date',
        'subtotal' => 'required|numeric',
        'impuesto' => 'required|numeric',
        'descuento' => 'nullable|numeric|min:0',
        'total' => 'required|numeric',
        'metodo_pago' => 'required|string',
    ]);

    // Crear la venta
    $venta = new Venta();
    $venta->producto_id = $request->producto_id;
    $venta->cliente_id = $request->cliente_id;
    $venta->cantidad = $request->cantidad;
    $venta->fecha = $request->fecha;
    $venta->subtotal = $request->subtotal;
    $venta->impuesto = $request->impuesto;
    $venta->descuento = $request->descuento ?? 0; // Si no hay descuento, asignar 0
    $venta->total = $request->total;
    $venta->metodo_pago = $request->metodo_pago;
    
    // Guardar la venta
    $venta->save();

    // Actualizar el stock del producto
    $producto = Producto::find($request->producto_id);
    
    // Verificar que haya suficiente stock
    if ($producto->stock >= $request->cantidad) {
        $producto->stock -= $request->cantidad; // Reducir el stock por la cantidad vendida
        $producto->save();
    } else {
        return redirect()->back()->withErrors(['stock' => 'No hay suficiente stock para completar la venta.']);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta creada y stock actualizado.');
}
    // Mostrar los detalles de una venta específica
    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    // Mostrar el formulario para editar una venta existente
    public function edit(Venta $venta)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    // Actualizar una venta en la base de datos
    public function update(Request $request, Venta $venta)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id_producto',
        'cliente_id' => 'required|exists:clientes,id_cliente',
        'cantidad' => 'required|integer|min:1',
        'subtotal' => 'required|numeric|min:0',
        'impuesto' => 'required|numeric|min:0',
        'descuento' => 'nullable|numeric|min:0',
        'total' => 'required|numeric|min:0',
        'metodo_pago' => 'required|string',
        'fecha' => 'required|date',
    ]);

    $producto = Producto::findOrFail($request->producto_id);

    $diferenciaCantidad = $request->cantidad - $venta->cantidad;

    $producto->stock -= $diferenciaCantidad;

    if ($producto->stock < 0) {
        return redirect()->back()->withErrors(['cantidad' => 'La cantidad solicitada excede el stock disponible.']);
    }

    $producto->save();

    $venta->update([
        'producto_id' => $request->producto_id,
        'cliente_id' => $request->cliente_id,
        'cantidad' => $request->cantidad,
        'subtotal' => $request->subtotal,
        'impuesto' => $request->impuesto,
        'descuento' => $request->descuento ?? 0,
        'total' => $request->total,
        'metodo_pago' => $request->metodo_pago,
        'fecha' => $request->fecha,
    ]);

    return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
}

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
