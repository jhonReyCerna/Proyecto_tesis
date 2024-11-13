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
