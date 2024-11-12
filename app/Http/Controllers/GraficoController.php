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
        // Obtener datos
        $proveedoresCount = Proveedor::count();
        $categoriasCount = Categoria::count();
        $clientesCount = Cliente::count();
        $productosCount = Producto::count();

        // Compras diarias y mensuales
        $comprasDiarias = Compra::whereDate('created_at', Carbon::today())->count();
        $comprasMensuales = Compra::whereMonth('created_at', Carbon::now()->month)->count();

        // Ventas diarias y mensuales
        $ventasDiarias = Venta::whereDate('created_at', Carbon::today())->count();
        $ventasMensuales = Venta::whereMonth('created_at', Carbon::now()->month)->count();

        return view('graficos.index', compact(
            'proveedoresCount', 'categoriasCount', 'clientesCount', 'productosCount',
            'comprasDiarias', 'comprasMensuales', 'ventasDiarias', 'ventasMensuales'
        ));
    }
}
