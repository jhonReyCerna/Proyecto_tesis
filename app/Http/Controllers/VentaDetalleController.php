<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
    public function index(Request $request)
{
    $clientes = Cliente::all();  // o el query adecuado
    $productos = Producto::all();
    // Recupera las ventas desde la base de datos
    $ventas = VentaDetalle::with('cliente')->paginate(10);  // O usa el filtro que desees

    // Pasa la variable 'ventas' a la vista 'ventadetalles.index'
    return view('ventadetalles.index', compact('clientes', 'ventas', 'productos'));
}

    public function create()
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {

    }


}
