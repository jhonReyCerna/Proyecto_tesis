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
        // Paginación y carga de relaciones para optimizar consultas
        $ventas = Venta::with('cliente')->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Mostrar el formulario para crear una nueva venta.
     */
    public function create()
    {
        // Obtener todos los clientes y productos para el formulario
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    /**
     * Almacenar una nueva venta en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
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
            $detalle_venta->descuento = 0;
            $detalle_venta->igv = $subtotal * 0.18;
            $detalle_venta->cambio = 0;
            $detalle_venta->save();

            // Acumulando el total de la venta
            $totalPagar += $subtotal + $detalle_venta->igv;
        }

        // Actualizar el total de la venta
        $venta->totalPagar = $totalPagar;
        $venta->save();

        // Redirigir al índice de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta realizada con éxito!');
    }
        /**
         * Mostrar los detalles de una venta específica.
         */
        public function show($id)
        {
            $venta = Venta::with('detalles.producto', 'cliente')->findOrFail($id);
            return view('ventas.show', compact('venta'));
        }

    /**
     * Mostrar el formulario para editar una venta.
     */
    public function edit($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);
        $clientes = Cliente::all();
        return view('ventas.edit', compact('venta', 'clientes'));
    }

    /**
     * Actualizar una venta en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        $venta = Venta::findOrFail($id);

        // Actualizar la venta
        $venta->update([
            'id_cliente' => $request->id_cliente,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito');
    }

    /**
     * Eliminar una venta de la base de datos.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito');
    }
}
