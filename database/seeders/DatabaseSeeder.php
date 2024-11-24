<?php

namespace Database\Seeders;

use App\Models\Venta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
           
            CategoriaSeeder::class,
            ProveedorSeeder::class,
            AlmacenSeeder::class,
            ProductoSeeder::class,
            ClienteSeeder::class,
            CompraSeeder::class,
            VentaSeeder::class,
            VentasDetallesSeeder::class,
        ]);
    }
}
