<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('proveedores')->insert([
            ['nombre' => 'Samsung Electronics Perú', 'direccion' => 'Av. Javier Prado Este 9990, Lima', 'telefono' => '012345678', 'email' => 'contacto@samsung.com', 'ruc' => '20394567301'],
            ['nombre' => 'LG Electronics Perú', 'direccion' => 'Av. República de Panamá 3531, Lima', 'telefono' => '012345679', 'email' => 'ventas@lgperu.com', 'ruc' => '20456789012'],
            ['nombre' => 'Sony Perú S.A.', 'direccion' => 'Av. Camino Real 1325, San Isidro', 'telefono' => '012345680', 'email' => 'info@sonyperu.com', 'ruc' => '20456789123'],
            ['nombre' => 'Panasonic Perú S.A.', 'direccion' => 'Calle Los Negocios 144, Surquillo', 'telefono' => '012345681', 'email' => 'ventas@panasonic.com.pe', 'ruc' => '20456789234'],
            ['nombre' => 'Electrolux Perú', 'direccion' => 'Av. La Marina 2332, San Miguel', 'telefono' => '012345682', 'email' => 'servicio@electrolux.com.pe', 'ruc' => '20567890123'],
            ['nombre' => 'Mabe Perú', 'direccion' => 'Av. Canadá 1002, La Victoria', 'telefono' => '012345683', 'email' => 'contacto@mabeperu.com', 'ruc' => '20567890234'],
            ['nombre' => 'Whirlpool Perú', 'direccion' => 'Av. Javier Prado Oeste 2030, San Isidro', 'telefono' => '012345684', 'email' => 'servicios@whirlpool.com', 'ruc' => '20678901234'],
            ['nombre' => 'Philips Perú', 'direccion' => 'Jr. Los Ingenieros 235, San Borja', 'telefono' => '012345685', 'email' => 'ventas@philipsperu.com', 'ruc' => '20678901345'],
            ['nombre' => 'Indurama Perú', 'direccion' => 'Av. Universitaria 655, Los Olivos', 'telefono' => '012345686', 'email' => 'contacto@indurama.com', 'ruc' => '20789012345'],
            ['nombre' => 'Bosh Perú', 'direccion' => 'Av. Brasil 2515, Pueblo Libre', 'telefono' => '012345687', 'email' => 'ventas@bosch.com.pe', 'ruc' => '20890123456'],
            ['nombre' => 'Samsung Latinoamérica', 'direccion' => 'Calle 50, Bella Vista, Panamá', 'telefono' => '012345688', 'email' => 'contacto@samsungla.com', 'ruc' => '20901234567'],
            ['nombre' => 'Hewlett-Packard Perú', 'direccion' => 'Calle Alcanfores 1420, Miraflores', 'telefono' => '012345689', 'email' => 'soporte@hpperu.com', 'ruc' => '21012345678'],
            ['nombre' => 'Apple Perú', 'direccion' => 'Av. Larco 812, Miraflores', 'telefono' => '012345690', 'email' => 'ventas@appleperu.com', 'ruc' => '21023456789'],
            ['nombre' => 'Acer Perú', 'direccion' => 'Av. Pardo y Aliaga 640, San Isidro', 'telefono' => '012345691', 'email' => 'servicios@acerperu.com', 'ruc' => '21034567890'],
            ['nombre' => 'Lenovo Perú', 'direccion' => 'Av. Primavera 455, Santiago de Surco', 'telefono' => '012345692', 'email' => 'info@lenovoperu.com', 'ruc' => '21045678901'],
            ['nombre' => 'Microsoft Perú', 'direccion' => 'Calle Las Begonias 545, San Isidro', 'telefono' => '012345693', 'email' => 'soporte@microsoftperu.com', 'ruc' => '21056789012'],
            ['nombre' => 'Dell Perú', 'direccion' => 'Av. Los Conquistadores 325, San Isidro', 'telefono' => '012345694', 'email' => 'ventas@dellperu.com', 'ruc' => '21067890123'],
            ['nombre' => 'Toshiba Perú', 'direccion' => 'Av. Angamos Oeste 1020, Miraflores', 'telefono' => '012345695', 'email' => 'info@toshibaperu.com', 'ruc' => '21078901234'],
            ['nombre' => 'Huawei Perú', 'direccion' => 'Av. República de Panamá 2581, San Isidro', 'telefono' => '012345696', 'email' => 'ventas@huawei.com.pe', 'ruc' => '21089012345'],
            ['nombre' => 'Xiaomi Perú', 'direccion' => 'Av. Benavides 1234, Miraflores', 'telefono' => '012345697', 'email' => 'info@xiaomi.com.pe', 'ruc' => '21090123456'],
            ['nombre' => 'Asus Perú', 'direccion' => 'Av. Pardo y Aliaga 789, San Isidro', 'telefono' => '012345698', 'email' => 'contacto@asusperu.com', 'ruc' => '21123456789'],
            ['nombre' => 'Huawei Latinoamérica', 'direccion' => 'Av. Costa Rica 920, La Molina', 'telefono' => '012345699', 'email' => 'soporte@huawei.com', 'ruc' => '21134567890'],
            ['nombre' => 'Canon Perú', 'direccion' => 'Av. El Sol 876, San Isidro', 'telefono' => '012345700', 'email' => 'ventas@canonperu.com', 'ruc' => '21145678901'],
            ['nombre' => 'ZTE Perú', 'direccion' => 'Av. Del Ejército 556, San Borja', 'telefono' => '012345701', 'email' => 'contacto@zteperu.com', 'ruc' => '21156789012'],
            ['nombre' => 'Kodak Perú', 'direccion' => 'Calle Los Alamos 634, San Isidro', 'telefono' => '012345702', 'email' => 'info@kodakperu.com', 'ruc' => '21167890123'],
            ['nombre' => 'JBL Perú', 'direccion' => 'Calle Bolívar 123, Lima', 'telefono' => '012345703', 'email' => 'soporte@jblperu.com', 'ruc' => '21178901234'],
            ['nombre' => 'Harman Kardon Perú', 'direccion' => 'Av. Pardo 1298, San Isidro', 'telefono' => '012345704', 'email' => 'ventas@harmankardon.com', 'ruc' => '21189012345'],
            ['nombre' => 'Benq Perú', 'direccion' => 'Av. 28 de Julio 748, Miraflores', 'telefono' => '012345705', 'email' => 'soporte@benqperu.com', 'ruc' => '21190123456'],
            ['nombre' => 'Vizio Perú', 'direccion' => 'Av. Javier Prado Este 2345, San Isidro', 'telefono' => '012345706', 'email' => 'ventas@vizioperu.com', 'ruc' => '21201234567'],
            ['nombre' => 'Sharp Perú', 'direccion' => 'Calle Los Tilos 756, San Borja', 'telefono' => '012345707', 'email' => 'contacto@sharpperu.com', 'ruc' => '21212345678'],
            ['nombre' => 'TCL Perú', 'direccion' => 'Av. Brasil 1156, Pueblo Libre', 'telefono' => '012345708', 'email' => 'soporte@tclperu.com', 'ruc' => '21223456789'],
            ['nombre' => 'RCA Perú', 'direccion' => 'Av. Angamos Este 1250, Surquillo', 'telefono' => '012345709', 'email' => 'ventas@rcaperu.com', 'ruc' => '21234567890'],
            ['nombre' => 'Sennheiser Perú', 'direccion' => 'Av. Tomas Marsano 850, San Borja', 'telefono' => '012345710', 'email' => 'soporte@sennheiserperu.com', 'ruc' => '21245678901'],
            ['nombre' => 'Fujitsu Perú', 'direccion' => 'Calle Centenario 742, San Isidro', 'telefono' => '012345711', 'email' => 'contacto@fujitsuperu.com', 'ruc' => '21256789012'],
            ['nombre' => 'Mitsubishi Electric Perú', 'direccion' => 'Av. Nicolás Ayllón 1885, San Juan de Lurigancho', 'telefono' => '012345712', 'email' => 'soporte@mitsuiperu.com', 'ruc' => '21267890123'],
            ['nombre' => 'Siemens Perú', 'direccion' => 'Av. La Marina 3501, San Miguel', 'telefono' => '012345713', 'email' => 'ventas@siemensperu.com', 'ruc' => '21278901234'],
            ['nombre' => 'Epson Perú', 'direccion' => 'Calle Los Álamos 456, San Borja', 'telefono' => '012345714', 'email' => 'contacto@epsonperu.com', 'ruc' => '21289012345'],
            ['nombre' => 'Ricoh Perú', 'direccion' => 'Calle Los Nogales 654, San Isidro', 'telefono' => '012345715', 'email' => 'soporte@ricohperu.com', 'ruc' => '21290123456'],
            ['nombre' => 'Lexmark Perú', 'direccion' => 'Av. 28 de Julio 1243, Miraflores', 'telefono' => '012345716', 'email' => 'ventas@lexmarkperu.com', 'ruc' => '21301234567'],
            ['nombre' => 'Bose Perú', 'direccion' => 'Av. Comandante Espinar 400, San Isidro', 'telefono' => '012345717', 'email' => 'soporte@boseperu.com', 'ruc' => '21312345678'],
            ['nombre' => 'Smeg Perú', 'direccion' => 'Av. Javier Prado Este 1921, San Borja', 'telefono' => '012345718', 'email' => 'info@smegperu.com', 'ruc' => '21323456789'],
        ]);


    }
}
