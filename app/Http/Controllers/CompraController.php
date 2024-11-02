<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $compras = Compra::with(['producto', 'proveedor', 'almacen'])
        ->when($search, function($query) use ($search) {
            return $query->where(function($q) use ($search) {
                $q->whereHas('producto', function($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })
                ->orWhereHas('proveedor', function($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })
                ->orWhereHas('almacen', function($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                });
            });
        })
        ->paginate(10);

    return view('compras.index', compact('compras'));
}

    public function create()
{
    $productos = Producto::all();
    $proveedores = Proveedor::all();
    $almacenes = Almacen::all();

    return view('compras.create', compact('productos', 'proveedores', 'almacenes'));
}

public function store(Request $request)
{
    // Validar la solicitud
    $request->validate([
        'producto_id' => 'required|exists:productos,id_producto',
        'proveedor_id' => 'required|exists:proveedores,id_proveedor',
        'cantidad' => 'required|integer|min:1',
        'precio_unitario' => 'required|numeric|min:0',
        'fecha' => 'required|date',
        'almacen_id' => 'required|exists:almacenes,id_almacen',
        'descripcion' => 'nullable|string|max:255',
    ]);


    $total = $request->cantidad * $request->precio_unitario;

    $compra = Compra::create(array_merge($request->all(), ['total' => $total]));

    $producto = Producto::find($request->producto_id);

    $producto->stock += $request->cantidad;

    if ($request->precio_unitario > $producto->precio) {
        $producto->precio = $request->precio_unitario;
    }

    $producto->save();

    return redirect()->route('compras.index')->with('success', 'Compra registrada con éxito.');
}

    public function show($id)
{
    $compra = Compra::findOrFail($id);
    return view('compras.show', compact('compra'));
}

    public function edit($id)
{
    $compra = Compra::findOrFail($id);
    $productos = Producto::all();
    $proveedores = Proveedor::all();
    $almacenes = Almacen::all();

    return view('compras.edit', compact('compra', 'productos', 'proveedores', 'almacenes'));
}

public function update(Request $request, Compra $compra)
{
    $validatedData = $request->validate([
        'producto_id' => 'required',
        'proveedor_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio_unitario' => 'required|numeric',
        'fecha' => 'required|date',
        'almacen_id' => 'required',
        'descripcion' => 'nullable|string',
    ]);

    $total = $validatedData['cantidad'] * $validatedData['precio_unitario'];

    $compra->update(array_merge($validatedData, ['total' => $total]));

    return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
}


    public function destroy(Compra $compra)
    {
        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra eliminada exitosamente.');
    }

    public function generarReportePDF()
{
    $compras = Compra::with(['producto', 'proveedor', 'almacen'])->get();

    $pdf = Pdf::loadView('compras.reporte', compact('compras'));
    return $pdf->download('reporte_compras.pdf');
}
}
