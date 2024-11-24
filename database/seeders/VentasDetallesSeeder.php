<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentasDetallesSeeder extends Seeder
{
    public function run()
    {

        $ventas = DB::table('ventas')->pluck('id_venta');
        $productos = DB::table('productos')->pluck('id_producto');

        foreach ($ventas as $venta_id) {

            $numDetalles = rand(1, 5);
            $totalVenta = 0;

            for ($i = 0; $i < $numDetalles; $i++) {
                $cantidad = rand(1, 10);
                $precio = rand(10, 1000) + (rand(0, 99) / 100);
                $descuento = rand(0, 50) + (rand(0, 99) / 100);
                $subtotal = ($cantidad * $precio) - $descuento;
                $igv = $subtotal * 0.18;
                $totalVenta += $subtotal + $igv;

                DB::table('ventas_detalles')->insert([
                    'id_venta' => $venta_id,
                    'id_producto' => $productos->random(),
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'descuento' => $descuento,
                    'igv' => $igv,
                    'subtotal' => $subtotal,
                    'cambio' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::table('ventas')
                ->where('id_venta', $venta_id)
                ->update(['totalPagar' => $totalVenta]);
        }
    }
}
