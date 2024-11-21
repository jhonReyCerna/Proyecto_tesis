<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class GraficoController extends Controller
{
    public function index()
{
    // Get base counts
    $proveedores = Proveedor::count();
    $categorias = Categoria::count();
    $clientes = Cliente::count();
    $productos = Producto::count();

    // Get product stock metrics
    $stockBajo = Producto::where('stock', '<', 10)->count();
    $stockNormal = Producto::whereBetween('stock', [10, 50])->count();
    $stockAlto = Producto::where('stock', '>', 50)->count();

    // Get monthly sales for current year
    $ventasPorMes = Venta::selectRaw('MONTH(fecha_venta) as mes, COUNT(*) as total')
        ->whereYear('fecha_venta', date('Y'))
        ->where('estado', 'completado')
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes')
        ->toArray();

    // Fill missing months with 0
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $ventasData = array_fill(1, 12, 0);
    foreach ($ventasPorMes as $mes => $total) {
        $ventasData[$mes] = $total;
    }

    $data = [
        'proveedores' => $proveedores,
        'categorias' => $categorias,
        'clientes' => $clientes,
        'productos' => $productos,
        'stockBajo' => $stockBajo,
        'stockNormal' => $stockNormal,
        'stockAlto' => $stockAlto,
        'meses' => $meses,
        'ventasPorMes' => array_values($ventasData)
    ];

    return view('graficos.index', compact('data'));
}

    public function generatePDF()
    {
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        $productos = Producto::all();

        $data = [
            'proveedores' => $proveedores->count(),
            'categorias' => $categorias->count(),
            'clientes' => $clientes->count(),
            'productos' => $productos->count()
        ];

        $pdf = Pdf::loadView('graficos.pdf', compact('data'));

        return $pdf->download('estadisticas.pdf');
    }
}
