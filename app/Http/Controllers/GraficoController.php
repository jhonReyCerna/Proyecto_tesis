<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Venta;
use Carbon\Carbon;

class GraficoController extends Controller
{
    public function index()
    {
        // Obtener todos los datos
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        $productos = Producto::all();

        // Compras mensuales
        $comprasMensuales = Compra::selectRaw('MONTH(created_at) as mes, COUNT(*) as cantidad')
            ->groupBy('mes')
            ->get();

        // Ventas mensuales
        $ventasMensuales = Venta::selectRaw('MONTH(created_at) as mes, COUNT(*) as cantidad')
            ->groupBy('mes')
            ->get();

        return view('graficos.index', compact(
            'proveedores', 'categorias', 'clientes', 'productos',
            'comprasMensuales', 'ventasMensuales'
        ));
    }
}
