<?php


namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Cliente;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
{
  
    // Cargar ventas con relaciones y aplicar paginación
    $ventas = Venta::with('cliente', 'detalles.producto')->paginate(10); // 10 ventas por página
    return view('ventas.index', compact('ventas'));
}

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    // Guardar una nueva venta
    public function store(Request $request)
{
    // Validar los datos recibidos
    $validated = $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'totalPagar' => 'required|numeric',
        'fecha_venta' => 'required|date',
        'estado' => 'required|string',
        'descuento' => 'nullable|numeric|min:0|max:100', // Validación del descuento
        'detalles' => 'required|array',
        'detalles.*.id_producto' => 'required|exists:productos,id_producto',
        'detalles.*.cantidad' => 'required|numeric|min:1',
        'detalles.*.precio_unitario' => 'required|numeric|min:0',
    ]);

    // Obtener los datos del formulario
    $descuento = $request->input('descuento', 0); // Valor por defecto 0 si no se proporciona

    // Calcular el total con descuento
    $totalPagar = $request->input('totalPagar');
    $totalConDescuento = $totalPagar - ($totalPagar * $descuento / 100);

    // Crear la venta
    $venta = Venta::create([
        'id_cliente' => $request->input('id_cliente'),
        'totalPagar' => $totalPagar,
        'totalConDescuento' => $totalConDescuento, // Guardar el total con descuento
        'fecha_venta' => Carbon::parse($request->input('fecha_venta'))->format('Y-m-d'), // Asegúrate de formatear correctamente la fecha
        'estado' => $request->input('estado'),
    ]);

    // Registrar los detalles de la venta
    foreach ($request->input('detalles') as $detalle) {
        // Si hay descuento en cada detalle, lo calculamos
        $descuentoDetalle = $detalle['descuento'] ?? 0;
        $subtotal = ($detalle['cantidad'] * $detalle['precio_unitario']) -
                    ($detalle['cantidad'] * $detalle['precio_unitario'] * $descuentoDetalle / 100);

        VentaDetalle::create([
            'id_venta' => $venta->id_venta,
            'id_producto' => $detalle['id_producto'],
            'id_cliente' => $request->input('id_cliente'),
            'cantidad' => $detalle['cantidad'],
            'precio_unitario' => $detalle['precio_unitario'],
            'descuento' => $descuentoDetalle, // Descuento por producto
            'igv' => $detalle['igv'] ?? 0,
            'subtotal' => $subtotal, // Subtotal con el descuento aplicado
            'cambio' => $detalle['cambio'] ?? 0,
        ]);
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
}


    // Mostrar los detalles de una venta
    public function show($id)
    {
        $venta = Venta::with('cliente', 'detalles.producto')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    // Formulario para editar una venta
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    // Actualizar una venta
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'totalPagar' => 'required|numeric',
            'fecha_venta' => 'required|date',
            'estado' => 'required|string',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update([
            'id_cliente' => $request->id_cliente,
            'totalPagar' => $request->totalPagar,
            'fecha_venta' => $request->fecha_venta,
            'estado' => $request->estado,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    // Eliminar una venta
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
