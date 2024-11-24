<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{

    
    public function run(): void
    {
        DB::table('productos')->insert([
            ['nombre' => 'Teclado Mecánico RGB', 'precio' => 250.50, 'stock' => 30, 'id_categoria' => 18, 'id_proveedor' => 14, 'id_almacen' => 1],
            ['nombre' => 'Refrigeradora Inverter', 'precio' => 1900.00, 'stock' => 15, 'id_categoria' => 9, 'id_proveedor' => 1, 'id_almacen' => 2],
            ['nombre' => 'Parlante Bluetooth Portátil', 'precio' => 120.99, 'stock' => 50, 'id_categoria' => 5, 'id_proveedor' => 8, 'id_almacen' => 3],
            ['nombre' => 'Afeitadora Eléctrica', 'precio' => 85.00, 'stock' => 25, 'id_categoria' => 13, 'id_proveedor' => 9, 'id_almacen' => 1],
            ['nombre' => 'Drone Profesional 4K', 'precio' => 1500.75, 'stock' => 10, 'id_categoria' => 6, 'id_proveedor' => 3, 'id_almacen' => 2],
            ['nombre' => 'Tablet 10 pulgadas', 'precio' => 750.60, 'stock' => 20, 'id_categoria' => 27, 'id_proveedor' => 14, 'id_almacen' => 1],
            ['nombre' => 'Monitor 24 pulgadas', 'precio' => 450.00, 'stock' => 35, 'id_categoria' => 2, 'id_proveedor' => 11, 'id_almacen' => 3],
            ['nombre' => 'Deshumidificador Portátil', 'precio' => 400.20, 'stock' => 18, 'id_categoria' => 8, 'id_proveedor' => 10, 'id_almacen' => 2],
            ['nombre' => 'Tostadora Eléctrica', 'precio' => 65.00, 'stock' => 40, 'id_categoria' => 7, 'id_proveedor' => 5, 'id_almacen' => 3],
            ['nombre' => 'Bicicleta Estática', 'precio' => 950.50, 'stock' => 12, 'id_categoria' => 20, 'id_proveedor' => 13, 'id_almacen' => 1],
            ['nombre' => 'Impresora Multifuncional', 'precio' => 300.00, 'stock' => 22, 'id_categoria' => 27, 'id_proveedor' => 12, 'id_almacen' => 2],
            ['nombre' => 'Microondas 800W', 'precio' => 180.20, 'stock' => 28, 'id_categoria' => 7, 'id_proveedor' => 2, 'id_almacen' => 1],
            ['nombre' => 'Cámara de Seguridad WiFi', 'precio' => 250.00, 'stock' => 35, 'id_categoria' => 17, 'id_proveedor' => 6, 'id_almacen' => 3],
            ['nombre' => 'Batidora de Mano', 'precio' => 70.00, 'stock' => 45, 'id_categoria' => 7, 'id_proveedor' => 15, 'id_almacen' => 2],
            ['nombre' => 'Audífonos Inalámbricos', 'precio' => 120.00, 'stock' => 50, 'id_categoria' => 5, 'id_proveedor' => 8, 'id_almacen' => 1],
            ['nombre' => 'Aspiradora Robot', 'precio' => 500.00, 'stock' => 18, 'id_categoria' => 11, 'id_proveedor' => 7, 'id_almacen' => 3],
            ['nombre' => 'Cafetera de Cápsulas', 'precio' => 150.00, 'stock' => 30, 'id_categoria' => 7, 'id_proveedor' => 4, 'id_almacen' => 2],
            ['nombre' => 'Taladro Inalámbrico', 'precio' => 230.00, 'stock' => 25, 'id_categoria' => 22, 'id_proveedor' => 10, 'id_almacen' => 1],
            ['nombre' => 'Mesa de Centro Moderna', 'precio' => 350.00, 'stock' => 20, 'id_categoria' => 14, 'id_proveedor' => 16, 'id_almacen' => 2],
            ['nombre' => 'Ventilador de Torre', 'precio' => 110.00, 'stock' => 40, 'id_categoria' => 8, 'id_proveedor' => 5, 'id_almacen' => 3],
            ['nombre' => 'Smartwatch Deportivo', 'precio' => 300.00, 'stock' => 40, 'id_categoria' => 19, 'id_proveedor' => 8, 'id_almacen' => 1],
            ['nombre' => 'Cámara Réflex 24MP', 'precio' => 2500.00, 'stock' => 15, 'id_categoria' => 16, 'id_proveedor' => 14, 'id_almacen' => 2],
            ['nombre' => 'Aire Acondicionado Portátil', 'precio' => 1200.99, 'stock' => 10, 'id_categoria' => 8, 'id_proveedor' => 4, 'id_almacen' => 3],
            ['nombre' => 'Proyector HD', 'precio' => 850.75, 'stock' => 20, 'id_categoria' => 3, 'id_proveedor' => 11, 'id_almacen' => 1],
            ['nombre' => 'Cocina de Inducción', 'precio' => 670.30, 'stock' => 25, 'id_categoria' => 7, 'id_proveedor' => 2, 'id_almacen' => 2],
            ['nombre' => 'Plancha a Vapor', 'precio' => 90.50, 'stock' => 35, 'id_categoria' => 11, 'id_proveedor' => 12, 'id_almacen' => 3],
            ['nombre' => 'Smart TV 55 pulgadas', 'precio' => 3000.00, 'stock' => 12, 'id_categoria' => 4, 'id_proveedor' => 10, 'id_almacen' => 1],
            ['nombre' => 'Freidora de Aire', 'precio' => 250.00, 'stock' => 28, 'id_categoria' => 7, 'id_proveedor' => 15, 'id_almacen' => 2],
            ['nombre' => 'Reloj Inteligente Niños', 'precio' => 150.75, 'stock' => 30, 'id_categoria' => 19, 'id_proveedor' => 5, 'id_almacen' => 3],
            ['nombre' => 'Juego de Ollas Antiadherentes', 'precio' => 320.00, 'stock' => 40, 'id_categoria' => 12, 'id_proveedor' => 6, 'id_almacen' => 2],
            ['nombre' => 'Laptop Ultrabook', 'precio' => 4200.00, 'stock' => 18, 'id_categoria' => 1, 'id_proveedor' => 13, 'id_almacen' => 1],
            ['nombre' => 'Cámara de Video HD', 'precio' => 550.00, 'stock' => 22, 'id_categoria' => 16, 'id_proveedor' => 14, 'id_almacen' => 3],
            ['nombre' => 'Colchón Ortopédico', 'precio' => 700.00, 'stock' => 15, 'id_categoria' => 15, 'id_proveedor' => 1, 'id_almacen' => 2],
            ['nombre' => 'Mouse Gaming RGB', 'precio' => 80.99, 'stock' => 45, 'id_categoria' => 18, 'id_proveedor' => 8, 'id_almacen' => 1],
            ['nombre' => 'Escritorio Ajustable', 'precio' => 500.00, 'stock' => 20, 'id_categoria' => 14, 'id_proveedor' => 7, 'id_almacen' => 3],
            ['nombre' => 'Kit de Destornilladores', 'precio' => 40.00, 'stock' => 50, 'id_categoria' => 22, 'id_proveedor' => 3, 'id_almacen' => 1],
            ['nombre' => 'Máquina de Coser Portátil', 'precio' => 350.00, 'stock' => 18, 'id_categoria' => 11, 'id_proveedor' => 5, 'id_almacen' => 2],
            ['nombre' => 'Auriculares Over-Ear', 'precio' => 250.00, 'stock' => 38, 'id_categoria' => 5, 'id_proveedor' => 9, 'id_almacen' => 3],
            ['nombre' => 'Calentador de Agua Eléctrico', 'precio' => 180.00, 'stock' => 32, 'id_categoria' => 11, 'id_proveedor' => 16, 'id_almacen' => 1],
            ['nombre' => 'Ventilador de Pared', 'precio' => 120.50, 'stock' => 40, 'id_categoria' => 8, 'id_proveedor' => 4, 'id_almacen' => 2],
            ['nombre' => 'Cafetería Expresso', 'precio' => 80.00, 'stock' => 25, 'id_categoria' => 10, 'id_proveedor' => 17, 'id_almacen' => 3],
            ['nombre' => 'Cafetería Cappuccino', 'precio' => 90.00, 'stock' => 30, 'id_categoria' => 10, 'id_proveedor' => 17, 'id_almacen' => 1],
            ['nombre' => 'Licuadora Portátil', 'precio' => 120.30, 'stock' => 32, 'id_categoria' => 7, 'id_proveedor' => 3, 'id_almacen' => 2],
            ['nombre' => 'Calefactor Cerámico', 'precio' => 250.75, 'stock' => 28, 'id_categoria' => 8, 'id_proveedor' => 12, 'id_almacen' => 1],
            ['nombre' => 'Cámara Instantánea', 'precio' => 300.99, 'stock' => 25, 'id_categoria' => 16, 'id_proveedor' => 14, 'id_almacen' => 3],
            ['nombre' => 'Humidificador Ultrasónico', 'precio' => 70.20, 'stock' => 40, 'id_categoria' => 8, 'id_proveedor' => 9, 'id_almacen' => 2],
            ['nombre' => 'Audífonos de Diadema', 'precio' => 130.50, 'stock' => 30, 'id_categoria' => 5, 'id_proveedor' => 4, 'id_almacen' => 1],
            ['nombre' => 'Cargador Solar Portátil', 'precio' => 50.00, 'stock' => 45, 'id_categoria' => 3, 'id_proveedor' => 10, 'id_almacen' => 3],
            ['nombre' => 'Tijeras Eléctricas', 'precio' => 95.99, 'stock' => 20, 'id_categoria' => 22, 'id_proveedor' => 8, 'id_almacen' => 1],
            ['nombre' => 'Smartphone 5G', 'precio' => 2700.00, 'stock' => 18, 'id_categoria' => 1, 'id_proveedor' => 7, 'id_almacen' => 2],
            ['nombre' => 'Impresora 3D', 'precio' => 1200.50, 'stock' => 10, 'id_categoria' => 27, 'id_proveedor' => 15, 'id_almacen' => 3],
            ['nombre' => 'Lámpara LED Recargable', 'precio' => 45.20, 'stock' => 50, 'id_categoria' => 13, 'id_proveedor' => 6, 'id_almacen' => 1],
            ['nombre' => 'Smart Lock WiFi', 'precio' => 350.00, 'stock' => 25, 'id_categoria' => 17, 'id_proveedor' => 5, 'id_almacen' => 2],
            ['nombre' => 'Auriculares con Cancelación de Ruido', 'precio' => 270.00, 'stock' => 30, 'id_categoria' => 5, 'id_proveedor' => 11, 'id_almacen' => 1],
            ['nombre' => 'Router WiFi 6', 'precio' => 300.00, 'stock' => 35, 'id_categoria' => 3, 'id_proveedor' => 4, 'id_almacen' => 2],
            ['nombre' => 'Sierra Eléctrica', 'precio' => 450.00, 'stock' => 20, 'id_categoria' => 22, 'id_proveedor' => 2, 'id_almacen' => 3],
            ['nombre' => 'Cámara de Vigilancia Solar', 'precio' => 600.00, 'stock' => 15, 'id_categoria' => 17, 'id_proveedor' => 14, 'id_almacen' => 1],
            ['nombre' => 'Patineta Eléctrica', 'precio' => 1800.00, 'stock' => 10, 'id_categoria' => 20, 'id_proveedor' => 13, 'id_almacen' => 3],
            ['nombre' => 'Calentador de Terma Solar', 'precio' => 850.00, 'stock' => 8, 'id_categoria' => 11, 'id_proveedor' => 1, 'id_almacen' => 2],
            ['nombre' => 'Teclado Ergonómico Inalámbrico', 'precio' => 140.99, 'stock' => 45, 'id_categoria' => 18, 'id_proveedor' => 3, 'id_almacen' => 1],
            ['nombre' => 'Cámara de Acción 4K', 'precio' => 950.00, 'stock' => 22, 'id_categoria' => 16, 'id_proveedor' => 10, 'id_almacen' => 2],
            ['nombre' => 'Despertador Inteligente', 'precio' => 60.00, 'stock' => 50, 'id_categoria' => 10, 'id_proveedor' => 7, 'id_almacen' => 3],
        ]);

    }
}
