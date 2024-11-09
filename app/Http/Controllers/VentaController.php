<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

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
        // Validar los datos del formulario
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fecha' => 'required|date', // Cambiar 'fecha_venta' por 'fecha'
            'productos' => 'required|array|min:1',  // Debe haber al menos un producto
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear la venta
        $venta = new Venta();
        $venta->id_cliente = $request->id_cliente;
        $venta->fecha = $request->fecha;  // Cambiar 'fecha_venta' por 'fecha'
        $venta->totalPagar = $this->calcularTotal($request->productos);
        $venta->estado = 'Pendiente';  // Estado inicial
        $venta->save();

        // Guardar los productos de la venta
        foreach ($request->productos as $producto) {
            $productoDetalles = Producto::find($producto['id_producto']);
            $venta->productos()->attach($producto['id_producto'], [
                'cantidad' => $producto['cantidad'],
                'precio' => $productoDetalles->precio
            ]);
        }

        // Redirigir al detalle de la venta recién creada
        return redirect()->route('ventas.show', ['venta' => $venta->id])->with('success', 'Venta realizada con éxito');
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

        // Redirigir al detalle de la venta actualizada
        return redirect()->route('ventas.show', ['venta' => $venta->id])->with('success', 'Venta actualizada con éxito');
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

    /**
     * Función para calcular el total de la venta con base en los productos.
     */
    private function calcularTotal($productos)
    {
        $total = 0;
        foreach ($productos as $producto) {
            $productoDetalles = Producto::find($producto['id_producto']);
            $total += $productoDetalles->precio * $producto['cantidad'];
        }
        return $total;
    }
}
