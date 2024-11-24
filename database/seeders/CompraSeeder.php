<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
   
    public function run(): void
    {
        DB::table('compras')->insert([
            ['producto_id' => 1, 'proveedor_id' => 14, 'cantidad' => 10, 'fecha' => '2024-11-07', 'almacen_id' => 1, 'precio_unitario' => 250.50, 'total' => 2505.00, 'descripcion' => 'Reabastecimiento de teclados', 'estado' => 'pendiente'],
            ['producto_id' => 2, 'proveedor_id' => 9, 'cantidad' => 20, 'fecha' => '2024-10-30', 'almacen_id' => 2, 'precio_unitario' => 180.00, 'total' => 3600.00, 'descripcion' => 'Pedido de monitores LED', 'estado' => 'completado'],
            ['producto_id' => 3, 'proveedor_id' => 7, 'cantidad' => 15, 'fecha' => '2024-11-05', 'almacen_id' => 3, 'precio_unitario' => 75.25, 'total' => 1128.75, 'descripcion' => 'Mouse inalámbricos', 'estado' => 'pendiente'],
            ['producto_id' => 4, 'proveedor_id' => 6, 'cantidad' => 50, 'fecha' => '2024-11-01', 'almacen_id' => 1, 'precio_unitario' => 22.30, 'total' => 1115.00, 'descripcion' => 'Cable HDMI', 'estado' => 'completado'],
            ['producto_id' => 5, 'proveedor_id' => 11, 'cantidad' => 40, 'fecha' => '2024-10-25', 'almacen_id' => 2, 'precio_unitario' => 115.00, 'total' => 4600.00, 'descripcion' => 'Cámaras de seguridad', 'estado' => 'pendiente'],
            ['producto_id' => 6, 'proveedor_id' => 12, 'cantidad' => 100, 'fecha' => '2024-10-28', 'almacen_id' => 3, 'precio_unitario' => 8.50, 'total' => 850.00, 'descripcion' => 'USB de 16GB', 'estado' => 'completado'],
            ['producto_id' => 7, 'proveedor_id' => 8, 'cantidad' => 25, 'fecha' => '2024-11-02', 'almacen_id' => 2, 'precio_unitario' => 65.40, 'total' => 1635.00, 'descripcion' => 'Baterías externas', 'estado' => 'pendiente'],
            ['producto_id' => 8, 'proveedor_id' => 15, 'cantidad' => 5, 'fecha' => '2024-10-31', 'almacen_id' => 1, 'precio_unitario' => 320.00, 'total' => 1600.00, 'descripcion' => 'Discos duros SSD', 'estado' => 'completado'],
            ['producto_id' => 9, 'proveedor_id' => 10, 'cantidad' => 60, 'fecha' => '2024-11-03', 'almacen_id' => 3, 'precio_unitario' => 12.75, 'total' => 765.00, 'descripcion' => 'Cables USB tipo C', 'estado' => 'pendiente'],
            ['producto_id' => 10, 'proveedor_id' => 13, 'cantidad' => 30, 'fecha' => '2024-10-29', 'almacen_id' => 1, 'precio_unitario' => 120.00, 'total' => 3600.00, 'descripcion' => 'Routers Wi-Fi', 'estado' => 'completado'],
            ['producto_id' => 11, 'proveedor_id' => 5, 'cantidad' => 20, 'fecha' => '2024-11-04', 'almacen_id' => 2, 'precio_unitario' => 90.00, 'total' => 1800.00, 'descripcion' => 'Reguladores de voltaje', 'estado' => 'pendiente'],
            ['producto_id' => 12, 'proveedor_id' => 14, 'cantidad' => 10, 'fecha' => '2024-11-06', 'almacen_id' => 3, 'precio_unitario' => 350.00, 'total' => 3500.00, 'descripcion' => 'Impresoras multifuncionales', 'estado' => 'completado'],
            ['producto_id' => 13, 'proveedor_id' => 7, 'cantidad' => 50, 'fecha' => '2024-11-01', 'almacen_id' => 1, 'precio_unitario' => 15.75, 'total' => 787.50, 'descripcion' => 'Audífonos', 'estado' => 'pendiente'],
            ['producto_id' => 14, 'proveedor_id' => 9, 'cantidad' => 35, 'fecha' => '2024-11-02', 'almacen_id' => 2, 'precio_unitario' => 40.25, 'total' => 1408.75, 'descripcion' => 'Micrófonos', 'estado' => 'completado'],
            ['producto_id' => 15, 'proveedor_id' => 6, 'cantidad' => 45, 'fecha' => '2024-10-30', 'almacen_id' => 3, 'precio_unitario' => 22.90, 'total' => 1030.50, 'descripcion' => 'Soportes de monitor', 'estado' => 'pendiente'],
            ['producto_id' => 16, 'proveedor_id' => 11, 'cantidad' => 25, 'fecha' => '2024-10-28', 'almacen_id' => 1, 'precio_unitario' => 75.00, 'total' => 1875.00, 'descripcion' => 'Tablets', 'estado' => 'completado'],
            ['producto_id' => 17, 'proveedor_id' => 13, 'cantidad' => 18, 'fecha' => '2024-11-07', 'almacen_id' => 2, 'precio_unitario' => 310.00, 'total' => 5580.00, 'descripcion' => 'Portátiles', 'estado' => 'pendiente'],
            ['producto_id' => 18, 'proveedor_id' => 10, 'cantidad' => 70, 'fecha' => '2024-10-26', 'almacen_id' => 3, 'precio_unitario' => 5.00, 'total' => 350.00, 'descripcion' => 'Lápices ópticos', 'estado' => 'completado'],
            ['producto_id' => 19, 'proveedor_id' => 8, 'cantidad' => 28, 'fecha' => '2024-11-03', 'almacen_id' => 1, 'precio_unitario' => 105.00, 'total' => 2940.00, 'descripcion' => 'Altavoces Bluetooth', 'estado' => 'pendiente'],
            ['producto_id' => 20, 'proveedor_id' => 15, 'cantidad' => 40, 'fecha' => '2024-11-04', 'almacen_id' => 2, 'precio_unitario' => 12.25, 'total' => 490.00, 'descripcion' => 'Fundas para tablets', 'estado' => 'completado'],
            ['producto_id' => 21, 'proveedor_id' => 9, 'cantidad' => 15, 'fecha' => '2024-11-07', 'almacen_id' => 1, 'precio_unitario' => 58.50, 'total' => 877.50, 'descripcion' => 'Mochilas para laptops', 'estado' => 'pendiente'],
            ['producto_id' => 22, 'proveedor_id' => 14, 'cantidad' => 10, 'fecha' => '2024-10-29', 'almacen_id' => 2, 'precio_unitario' => 280.00, 'total' => 2800.00, 'descripcion' => 'Sillas ergonómicas', 'estado' => 'completado'],
            ['producto_id' => 23, 'proveedor_id' => 5, 'cantidad' => 35, 'fecha' => '2024-11-05', 'almacen_id' => 3, 'precio_unitario' => 12.75, 'total' => 446.25, 'descripcion' => 'Cables Ethernet', 'estado' => 'pendiente'],
            ['producto_id' => 24, 'proveedor_id' => 13, 'cantidad' => 22, 'fecha' => '2024-11-02', 'almacen_id' => 1, 'precio_unitario' => 95.00, 'total' => 2090.00, 'descripcion' => 'Teclados mecánicos', 'estado' => 'completado'],
            ['producto_id' => 25, 'proveedor_id' => 10, 'cantidad' => 60, 'fecha' => '2024-10-30', 'almacen_id' => 2, 'precio_unitario' => 4.75, 'total' => 285.00, 'descripcion' => 'Pilas AA', 'estado' => 'pendiente'],
            ['producto_id' => 26, 'proveedor_id' => 11, 'cantidad' => 100, 'fecha' => '2024-11-01', 'almacen_id' => 3, 'precio_unitario' => 2.50, 'total' => 250.00, 'descripcion' => 'Adaptadores USB', 'estado' => 'completado'],
            ['producto_id' => 27, 'proveedor_id' => 15, 'cantidad' => 5, 'fecha' => '2024-10-31', 'almacen_id' => 1, 'precio_unitario' => 500.00, 'total' => 2500.00, 'descripcion' => 'Proyectores portátiles', 'estado' => 'pendiente'],
            ['producto_id' => 28, 'proveedor_id' => 12, 'cantidad' => 20, 'fecha' => '2024-11-03', 'almacen_id' => 2, 'precio_unitario' => 55.00, 'total' => 1100.00, 'descripcion' => 'Soportes de pared para TV', 'estado' => 'completado'],
            ['producto_id' => 29, 'proveedor_id' => 7, 'cantidad' => 45, 'fecha' => '2024-11-06', 'almacen_id' => 3, 'precio_unitario' => 16.50, 'total' => 742.50, 'descripcion' => 'Mousepads grandes', 'estado' => 'pendiente'],
            ['producto_id' => 30, 'proveedor_id' => 9, 'cantidad' => 12, 'fecha' => '2024-10-28', 'almacen_id' => 1, 'precio_unitario' => 150.00, 'total' => 1800.00, 'descripcion' => 'Repetidores Wi-Fi', 'estado' => 'completado'],
            ['producto_id' => 31, 'proveedor_id' => 6, 'cantidad' => 8, 'fecha' => '2024-11-05', 'almacen_id' => 2, 'precio_unitario' => 200.00, 'total' => 1600.00, 'descripcion' => 'Cámaras web HD', 'estado' => 'pendiente'],
            ['producto_id' => 32, 'proveedor_id' => 13, 'cantidad' => 50, 'fecha' => '2024-11-01', 'almacen_id' => 3, 'precio_unitario' => 6.75, 'total' => 337.50, 'descripcion' => 'Lápices ópticos de repuesto', 'estado' => 'completado'],
            ['producto_id' => 33, 'proveedor_id' => 8, 'cantidad' => 30, 'fecha' => '2024-11-03', 'almacen_id' => 1, 'precio_unitario' => 12.50, 'total' => 375.00, 'descripcion' => 'Fundas para laptops', 'estado' => 'pendiente'],
            ['producto_id' => 34, 'proveedor_id' => 14, 'cantidad' => 20, 'fecha' => '2024-11-04', 'almacen_id' => 2, 'precio_unitario' => 72.50, 'total' => 1450.00, 'descripcion' => 'Bases para laptops', 'estado' => 'completado'],
            ['producto_id' => 35, 'proveedor_id' => 5, 'cantidad' => 35, 'fecha' => '2024-11-07', 'almacen_id' => 3, 'precio_unitario' => 48.00, 'total' => 1680.00, 'descripcion' => 'Estabilizadores', 'estado' => 'pendiente'],
            ['producto_id' => 36, 'proveedor_id' => 15, 'cantidad' => 55, 'fecha' => '2024-11-02', 'almacen_id' => 1, 'precio_unitario' => 19.00, 'total' => 1045.00, 'descripcion' => 'Protectores de pantalla', 'estado' => 'completado'],
            ['producto_id' => 37, 'proveedor_id' => 10, 'cantidad' => 25, 'fecha' => '2024-10-27', 'almacen_id' => 2, 'precio_unitario' => 85.00, 'total' => 2125.00, 'descripcion' => 'Memorias RAM', 'estado' => 'pendiente'],
            ['producto_id' => 38, 'proveedor_id' => 12, 'cantidad' => 40, 'fecha' => '2024-11-06', 'almacen_id' => 3, 'precio_unitario' => 45.00, 'total' => 1800.00, 'descripcion' => 'Hub USB', 'estado' => 'completado'],
            ['producto_id' => 39, 'proveedor_id' => 6, 'cantidad' => 10, 'fecha' => '2024-11-03', 'almacen_id' => 1, 'precio_unitario' => 250.00, 'total' => 2500.00, 'descripcion' => 'Discos duros externos', 'estado' => 'pendiente'],
            ['producto_id' => 40, 'proveedor_id' => 11, 'cantidad' => 30, 'fecha' => '2024-10-29', 'almacen_id' => 2, 'precio_unitario' => 10.50, 'total' => 315.00, 'descripcion' => 'Enfriadores de laptop', 'estado' => 'completado'],
            ['producto_id' => 41, 'proveedor_id' => 8, 'cantidad' => 15, 'fecha' => '2024-11-04', 'almacen_id' => 3, 'precio_unitario' => 30.00, 'total' => 450.00, 'descripcion' => 'Auriculares inalámbricos', 'estado' => 'pendiente'],
            ['producto_id' => 42, 'proveedor_id' => 14, 'cantidad' => 10, 'fecha' => '2024-11-06', 'almacen_id' => 1, 'precio_unitario' => 120.00, 'total' => 1200.00, 'descripcion' => 'Micrófonos de condensador', 'estado' => 'completado'],
            ['producto_id' => 43, 'proveedor_id' => 5, 'cantidad' => 20, 'fecha' => '2024-10-30', 'almacen_id' => 2, 'precio_unitario' => 15.00, 'total' => 300.00, 'descripcion' => 'Cables HDMI', 'estado' => 'pendiente'],
            ['producto_id' => 44, 'proveedor_id' => 11, 'cantidad' => 18, 'fecha' => '2024-11-01', 'almacen_id' => 3, 'precio_unitario' => 85.00, 'total' => 1530.00, 'descripcion' => 'Impresoras térmicas', 'estado' => 'completado'],
            ['producto_id' => 45, 'proveedor_id' => 10, 'cantidad' => 50, 'fecha' => '2024-11-05', 'almacen_id' => 1, 'precio_unitario' => 7.50, 'total' => 375.00, 'descripcion' => 'Cables de carga USB-C', 'estado' => 'pendiente'],
            ['producto_id' => 46, 'proveedor_id' => 13, 'cantidad' => 12, 'fecha' => '2024-10-28', 'almacen_id' => 2, 'precio_unitario' => 170.00, 'total' => 2040.00, 'descripcion' => 'SSD NVMe 1TB', 'estado' => 'completado'],
            ['producto_id' => 47, 'proveedor_id' => 7, 'cantidad' => 7, 'fecha' => '2024-11-03', 'almacen_id' => 3, 'precio_unitario' => 99.00, 'total' => 693.00, 'descripcion' => 'Altavoces Bluetooth', 'estado' => 'pendiente'],
            ['producto_id' => 48, 'proveedor_id' => 12, 'cantidad' => 40, 'fecha' => '2024-11-02', 'almacen_id' => 1, 'precio_unitario' => 8.25, 'total' => 330.00, 'descripcion' => 'Protectores de cable', 'estado' => 'completado'],
            ['producto_id' => 49, 'proveedor_id' => 15, 'cantidad' => 25, 'fecha' => '2024-10-31', 'almacen_id' => 2, 'precio_unitario' => 22.00, 'total' => 550.00, 'descripcion' => 'Soportes para CPU', 'estado' => 'pendiente'],
            ['producto_id' => 50, 'proveedor_id' => 9, 'cantidad' => 10, 'fecha' => '2024-11-07', 'almacen_id' => 3, 'precio_unitario' => 320.00, 'total' => 3200.00, 'descripcion' => 'Monitores de 27 pulgadas', 'estado' => 'completado'],
            ['producto_id' => 51, 'proveedor_id' => 6, 'cantidad' => 5, 'fecha' => '2024-11-05', 'almacen_id' => 1, 'precio_unitario' => 140.00, 'total' => 700.00, 'descripcion' => 'Conmutadores de red', 'estado' => 'pendiente'],
            ['producto_id' => 52, 'proveedor_id' => 14, 'cantidad' => 60, 'fecha' => '2024-10-29', 'almacen_id' => 2, 'precio_unitario' => 4.50, 'total' => 270.00, 'descripcion' => 'Cargadores de coche', 'estado' => 'completado'],
            ['producto_id' => 53, 'proveedor_id' => 8, 'cantidad' => 80, 'fecha' => '2024-11-04', 'almacen_id' => 3, 'precio_unitario' => 3.75, 'total' => 300.00, 'descripcion' => 'Limpiadores de pantalla', 'estado' => 'pendiente'],
            ['producto_id' => 54, 'proveedor_id' => 10, 'cantidad' => 15, 'fecha' => '2024-10-27', 'almacen_id' => 1, 'precio_unitario' => 60.00, 'total' => 900.00, 'descripcion' => 'Cámaras de seguridad', 'estado' => 'completado'],
            ['producto_id' => 55, 'proveedor_id' => 5, 'cantidad' => 70, 'fecha' => '2024-11-03', 'almacen_id' => 2, 'precio_unitario' => 2.80, 'total' => 196.00, 'descripcion' => 'Adaptadores de corriente', 'estado' => 'pendiente'],
            ['producto_id' => 56, 'proveedor_id' => 13, 'cantidad' => 12, 'fecha' => '2024-11-02', 'almacen_id' => 3, 'precio_unitario' => 98.50, 'total' => 1182.00, 'descripcion' => 'Discos SSD externos', 'estado' => 'completado'],
            ['producto_id' => 57, 'proveedor_id' => 7, 'cantidad' => 40, 'fecha' => '2024-11-01', 'almacen_id' => 1, 'precio_unitario' => 12.00, 'total' => 480.00, 'descripcion' => 'Estuches rígidos', 'estado' => 'pendiente'],
            ['producto_id' => 58, 'proveedor_id' => 15, 'cantidad' => 10, 'fecha' => '2024-10-30', 'almacen_id' => 2, 'precio_unitario' => 42.00, 'total' => 420.00, 'descripcion' => 'Cargadores portátiles', 'estado' => 'completado'],
            ['producto_id' => 59, 'proveedor_id' => 11, 'cantidad' => 45, 'fecha' => '2024-11-06', 'almacen_id' => 3, 'precio_unitario' => 5.50, 'total' => 247.50, 'descripcion' => 'Protectores de enchufe', 'estado' => 'pendiente'],
            ['producto_id' => 60, 'proveedor_id' => 12, 'cantidad' => 20, 'fecha' => '2024-11-07', 'almacen_id' => 1, 'precio_unitario' => 15.00, 'total' => 300.00, 'descripcion' => 'Luces LED USB', 'estado' => 'completado'],


        ]);

    }
}
