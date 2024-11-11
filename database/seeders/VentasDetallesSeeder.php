<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentasDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ventas_detalles')->insert([
            ['id_venta' => 1, 'id_producto' => 10, 'id_cliente' => 1, 'cantidad' => 2, 'precio_unitario' => 60.00, 'descuento' => 5.00, 'igv' => 10.80, 'subtotal' => 115.80, 'cambio' => 0],
            ['id_venta' => 1, 'id_producto' => 5, 'id_cliente' => 1, 'cantidad' => 1, 'precio_unitario' => 100.00, 'descuento' => 0, 'igv' => 18.00, 'subtotal' => 118.00, 'cambio' => 0],
            ['id_venta' => 2, 'id_producto' => 12, 'id_cliente' => 2, 'cantidad' => 3, 'precio_unitario' => 50.00, 'descuento' => 0, 'igv' => 9.00, 'subtotal' => 159.00, 'cambio' => 0],
            ['id_venta' => 2, 'id_producto' => 7, 'id_cliente' => 2, 'cantidad' => 1, 'precio_unitario' => 150.00, 'descuento' => 10.00, 'igv' => 27.00, 'subtotal' => 167.00, 'cambio' => 0],
            ['id_venta' => 3, 'id_producto' => 3, 'id_cliente' => 3, 'cantidad' => 4, 'precio_unitario' => 25.00, 'descuento' => 0, 'igv' => 3.60, 'subtotal' => 106.40, 'cambio' => 0],
            ['id_venta' => 3, 'id_producto' => 8, 'id_cliente' => 3, 'cantidad' => 2, 'precio_unitario' => 80.00, 'descuento' => 0, 'igv' => 14.40, 'subtotal' => 174.40, 'cambio' => 0],
            ['id_venta' => 4, 'id_producto' => 1, 'id_cliente' => 4, 'cantidad' => 5, 'precio_unitario' => 20.00, 'descuento' => 0, 'igv' => 3.60, 'subtotal' => 116.00, 'cambio' => 0],
            ['id_venta' => 4, 'id_producto' => 11, 'id_cliente' => 4, 'cantidad' => 1, 'precio_unitario' => 180.00, 'descuento' => 0, 'igv' => 32.40, 'subtotal' => 212.40, 'cambio' => 0],
            ['id_venta' => 5, 'id_producto' => 9, 'id_cliente' => 5, 'cantidad' => 2, 'precio_unitario' => 45.00, 'descuento' => 5.00, 'igv' => 7.80, 'subtotal' => 82.80, 'cambio' => 0],
            ['id_venta' => 5, 'id_producto' => 4, 'id_cliente' => 5, 'cantidad' => 1, 'precio_unitario' => 200.00, 'descuento' => 20.00, 'igv' => 36.00, 'subtotal' => 216.00, 'cambio' => 0],
            ['id_venta' => 6, 'id_producto' => 6, 'id_cliente' => 6, 'cantidad' => 1, 'precio_unitario' => 75.00, 'descuento' => 10.00, 'igv' => 13.50, 'subtotal' => 78.50, 'cambio' => 0],
            ['id_venta' => 6, 'id_producto' => 2, 'id_cliente' => 6, 'cantidad' => 3, 'precio_unitario' => 60.00, 'descuento' => 0, 'igv' => 10.80, 'subtotal' => 174.80, 'cambio' => 0],
            ['id_venta' => 7, 'id_producto' => 13, 'id_cliente' => 7, 'cantidad' => 2, 'precio_unitario' => 90.00, 'descuento' => 0, 'igv' => 16.20, 'subtotal' => 183.20, 'cambio' => 0],
            ['id_venta' => 7, 'id_producto' => 14, 'id_cliente' => 7, 'cantidad' => 4, 'precio_unitario' => 30.00, 'descuento' => 5.00, 'igv' => 5.40, 'subtotal' => 118.40, 'cambio' => 0],
            ['id_venta' => 8, 'id_producto' => 7, 'id_cliente' => 8, 'cantidad' => 3, 'precio_unitario' => 120.00, 'descuento' => 10.00, 'igv' => 21.60, 'subtotal' => 353.60, 'cambio' => 0],
            ['id_venta' => 8, 'id_producto' => 5, 'id_cliente' => 8, 'cantidad' => 2, 'precio_unitario' => 50.00, 'descuento' => 0, 'igv' => 9.00, 'subtotal' => 109.00, 'cambio' => 0],
            ['id_venta' => 9, 'id_producto' => 12, 'id_cliente' => 9, 'cantidad' => 1, 'precio_unitario' => 100.00, 'descuento' => 10.00, 'igv' => 18.00, 'subtotal' => 108.00, 'cambio' => 0],
            ['id_venta' => 9, 'id_producto' => 3, 'id_cliente' => 9, 'cantidad' => 3, 'precio_unitario' => 40.00, 'descuento' => 0, 'igv' => 7.20, 'subtotal' => 125.20, 'cambio' => 0],
            ['id_venta' => 10, 'id_producto' => 8, 'id_cliente' => 10, 'cantidad' => 1, 'precio_unitario' => 180.00, 'descuento' => 20.00, 'igv' => 28.80, 'subtotal' => 188.80, 'cambio' => 0],
            ['id_venta' => 10, 'id_producto' => 9, 'id_cliente' => 10, 'cantidad' => 5, 'precio_unitario' => 40.00, 'descuento' => 0, 'igv' => 7.20, 'subtotal' => 219.20, 'cambio' => 0],
            ['id_venta' => 11, 'id_producto' => 11, 'id_cliente' => 11, 'cantidad' => 3, 'precio_unitario' => 75.00, 'descuento' => 0, 'igv' => 13.50, 'subtotal' => 232.50, 'cambio' => 0],
            ['id_venta' => 11, 'id_producto' => 6, 'id_cliente' => 11, 'cantidad' => 2, 'precio_unitario' => 60.00, 'descuento' => 5.00, 'igv' => 11.10, 'subtotal' => 124.10, 'cambio' => 0],
            ['id_venta' => 12, 'id_producto' => 13, 'id_cliente' => 12, 'cantidad' => 4, 'precio_unitario' => 35.00, 'descuento' => 0, 'igv' => 6.30, 'subtotal' => 144.30, 'cambio' => 0],
            ['id_venta' => 12, 'id_producto' => 2, 'id_cliente' => 12, 'cantidad' => 2, 'precio_unitario' => 90.00, 'descuento' => 10.00, 'igv' => 16.20, 'subtotal' => 169.20, 'cambio' => 0],
            ['id_venta' => 13, 'id_producto' => 4, 'id_cliente' => 13, 'cantidad' => 3, 'precio_unitario' => 150.00, 'descuento' => 0, 'igv' => 27.00, 'subtotal' => 453.00, 'cambio' => 0],
            ['id_venta' => 13, 'id_producto' => 7, 'id_cliente' => 13, 'cantidad' => 1, 'precio_unitario' => 100.00, 'descuento' => 0, 'igv' => 18.00, 'subtotal' => 118.00, 'cambio' => 0],
            ['id_venta' => 14, 'id_producto' => 5, 'id_cliente' => 14, 'cantidad' => 2, 'precio_unitario' => 80.00, 'descuento' => 0, 'igv' => 14.40, 'subtotal' => 174.40, 'cambio' => 0],
            ['id_venta' => 14, 'id_producto' => 8, 'id_cliente' => 14, 'cantidad' => 3, 'precio_unitario' => 120.00, 'descuento' => 5.00, 'igv' => 21.60, 'subtotal' => 345.60, 'cambio' => 0],
        ]);
    }
}
