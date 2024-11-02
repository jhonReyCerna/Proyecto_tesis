<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    public function index()
    {
        $ventas = Venta::paginate(10);
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

    $venta = new Venta();
    $venta->producto_id = $request->producto_id;
    $venta->cliente_id = $request->cliente_id;
    $venta->cantidad = $request->cantidad;
    $venta->fecha = $request->fecha;
    $venta->subtotal = $request->subtotal;
    $venta->impuesto = $request->impuesto;
    $venta->descuento = $request->descuento ?? 0;
    $venta->total = $request->total;
    $venta->metodo_pago = $request->metodo_pago;

    $venta->save();

    $producto = Producto::find($request->producto_id);


    if ($producto->stock >= $request->cantidad) {
        $producto->stock -= $request->cantidad;
        $producto->save();
    } else {
        return redirect()->back()->withErrors(['stock' => 'No hay suficiente stock para completar la venta.']);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta creada y stock actualizado.');
}
    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

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

    public function exportPdf()
    {
        $ventas = Venta::with('cliente', 'producto')->get();

        $pdf = Pdf::loadView('ventas.reporte', compact('ventas'));

        return $pdf->download('reporte_ventas.pdf');
    }
}
