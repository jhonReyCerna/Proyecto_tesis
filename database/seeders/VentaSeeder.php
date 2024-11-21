<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentaSeeder extends Seeder
{
    public function run()
    {
        // First ensure we have clients
        $clientes = DB::table('clientes')->pluck('id_cliente');

        if ($clientes->isEmpty()) {
            // Create at least one client if none exist
            DB::table('clientes')->insert([
                'id_cliente' => 1,
                'nombre' => 'Cliente Default',
                'dni' => '00000000',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $clientes = collect([1]);
        }

        // Create 20 ventas
        for ($i = 1; $i <= 1000; $i++) {
            $fecha = Carbon::now()->subDays(rand(0, 30));

            DB::table('ventas')->insert([
                'id_cliente' => $clientes->random(),
                'totalPagar' => 0, // Inicializar en 0
                'fecha_venta' => $fecha->format('Y-m-d'),
                'estado' => 'completado', // Fixed estado to 'completado'
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]);
        }
    }
}
