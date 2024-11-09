<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\VentaDetalle;
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
        $clientes = Cliente::all(); // Obtener todos los clientes
        $productos = Producto::all(); // Obtener todos los productos
        return view('ventas.create', compact('clientes', 'productos'));
    }

    /**
     * Almacenar una nueva venta.
     */
    public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'productos' => 'required|array',
        'productos.*.id_producto' => 'required|exists:productos,id_producto',
        'productos.*.cantidad' => 'required|integer|min:1', // Asegurar que la cantidad sea válida
    ]);

    // Crear la venta
    $venta = new Venta();
    $venta->id_cliente = $request->id_cliente;
    $venta->fecha = now();
    $venta->estado = 'Completada';
    $venta->totalPagar = 0; // Inicialmente 0, se actualizará después
    $venta->save();

    $totalPagar = 0;

    // Guardar los detalles de la venta
    foreach ($request->productos as $productoData) {
        $producto = Producto::find($productoData['id_producto']);
        $cantidad = $productoData['cantidad'];
        $precio_unitario = $producto->precio;
        $subtotal = $cantidad * $precio_unitario;

        $detalle_venta = new VentaDetalle();
        $detalle_venta->id_venta = $venta->id_venta;
        $detalle_venta->id_producto = $producto->id_producto;
        $detalle_venta->id_cliente = $venta->id_cliente;
        $detalle_venta->cantidad = $cantidad;
        $detalle_venta->precio_unitario = $precio_unitario;
        $detalle_venta->subtotal = $subtotal;
        $detalle_venta->descuento = 0; // Si hay descuento, se debe agregar aquí
        $detalle_venta->igv = $subtotal * 0.18; // 18% de IGV
        $detalle_venta->cambio = 0; // Cambio por el pago
        $detalle_venta->save();

        // Acumulando el total de la venta
        $totalPagar += $subtotal + $detalle_venta->igv;
    }

    // Actualizar el total de la venta
    $venta->totalPagar = $totalPagar;
    $venta->save();

    // Redirigir a la vista de confirmación
    return redirect()->route('ventas.show', $venta->id_venta)->with('success', 'Venta realizada con éxito!');
}

    /**
     * Mostrar los detalles de una venta específica.
     */
    public function show($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);
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
