<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlmacenSeeder extends Seeder
{
   
    public function run(): void
    {
        DB::table('almacenes')->insert([
            ['nombre' => 'Almacén Central', 'ubicacion' => 'Av. Javier Prado Este 1234, San Isidro', 'capacidad' => 1000],
            ['nombre' => 'Almacén Surco', 'ubicacion' => 'Av. Los Ingenieros 567, Santiago de Surco', 'capacidad' => 800],
            ['nombre' => 'Almacén Callao', 'ubicacion' => 'Av. La Paz 789, Callao', 'capacidad' => 600],
            ['nombre' => 'Almacén Miraflores', 'ubicacion' => 'Calle José Larco 234, Miraflores', 'capacidad' => 400],
            ['nombre' => 'Almacén San Borja', 'ubicacion' => 'Av. San Luis 101, San Borja', 'capacidad' => 750],
            ['nombre' => 'Almacén San Miguel', 'ubicacion' => 'Av. La Marina 456, San Miguel', 'capacidad' => 500],
            ['nombre' => 'Almacén Ate', 'ubicacion' => 'Calle Santa Rosa 200, Ate', 'capacidad' => 900],
            ['nombre' => 'Almacén Chorrillos', 'ubicacion' => 'Av. Huaylas 345, Chorrillos', 'capacidad' => 550],
            ['nombre' => 'Almacén Villa El Salvador', 'ubicacion' => 'Av. 200 Millas 1111, Villa El Salvador', 'capacidad' => 650],
            ['nombre' => 'Almacén San Juan de Lurigancho', 'ubicacion' => 'Av. Próceres 1023, San Juan de Lurigancho', 'capacidad' => 800],
            ['nombre' => 'Almacén Los Olivos', 'ubicacion' => 'Av. Carlos Izaguirre 789, Los Olivos', 'capacidad' => 720],
            ['nombre' => 'Almacén Lince', 'ubicacion' => 'Av. Pardo 456, Lince', 'capacidad' => 480],
            ['nombre' => 'Almacén Jesús María', 'ubicacion' => 'Calle Mariscal Ramón Castilla 321, Jesús María', 'capacidad' => 500],
            ['nombre' => 'Almacén La Victoria', 'ubicacion' => 'Av. 28 de Julio 101, La Victoria', 'capacidad' => 600],
            ['nombre' => 'Almacén Surquillo', 'ubicacion' => 'Calle San Ignacio 123, Surquillo', 'capacidad' => 400],
            ['nombre' => 'Almacén Barranco', 'ubicacion' => 'Av. Bolognesi 456, Barranco', 'capacidad' => 300],
            ['nombre' => 'Almacén Rímac', 'ubicacion' => 'Av. Nicolás de Piérola 789, Rímac', 'capacidad' => 700],
            ['nombre' => 'Almacén San Isidro', 'ubicacion' => 'Calle Manuel González Prada 234, San Isidro', 'capacidad' => 850],
            ['nombre' => 'Almacén Breña', 'ubicacion' => 'Calle 28 de Julio 890, Breña', 'capacidad' => 650],
            ['nombre' => 'Almacén Pueblo Libre', 'ubicacion' => 'Av. Bolívar 123, Pueblo Libre', 'capacidad' => 600],
            ['nombre' => 'Almacén Magdalena', 'ubicacion' => 'Av. Brasil 1500, Magdalena del Mar', 'capacidad' => 450],
            ['nombre' => 'Almacén Carabayllo', 'ubicacion' => 'Av. Tupac Amaru 4567, Carabayllo', 'capacidad' => 500],
            ['nombre' => 'Almacén San Martín de Porres', 'ubicacion' => 'Av. Universitaria 7890, San Martín de Porres', 'capacidad' => 650],
            ['nombre' => 'Almacén Independencia', 'ubicacion' => 'Calle Los Pinos 234, Independencia', 'capacidad' => 700],
            ['nombre' => 'Almacén Comas', 'ubicacion' => 'Av. Guillermo Billinghurst 1234, Comas', 'capacidad' => 800],
            ['nombre' => 'Almacén Santa Anita', 'ubicacion' => 'Calle Los Álamos 567, Santa Anita', 'capacidad' => 900],
            ['nombre' => 'Almacén El Agustino', 'ubicacion' => 'Av. Riva Agüero 3456, El Agustino', 'capacidad' => 450],
            ['nombre' => 'Almacén Villa María del Triunfo', 'ubicacion' => 'Av. Salvador Allende 6789, Villa María del Triunfo', 'capacidad' => 600],
            ['nombre' => 'Almacén Cieneguilla', 'ubicacion' => 'Calle Los Eucaliptos 890, Cieneguilla', 'capacidad' => 300],
            ['nombre' => 'Almacén Punta Hermosa', 'ubicacion' => 'Av. Playa Norte 123, Punta Hermosa', 'capacidad' => 400],
            ['nombre' => 'Almacén San Bartolo', 'ubicacion' => 'Av. Malecón 234, San Bartolo', 'capacidad' => 350],
            ['nombre' => 'Almacén Santa Rosa', 'ubicacion' => 'Av. del Pacífico 456, Santa Rosa', 'capacidad' => 500],
            ['nombre' => 'Almacén Ancón', 'ubicacion' => 'Av. Costanera 789, Ancón', 'capacidad' => 550],
            ['nombre' => 'Almacén Pucusana', 'ubicacion' => 'Calle La Rivera 101, Pucusana', 'capacidad' => 600],
            ['nombre' => 'Almacén Lurigancho', 'ubicacion' => 'Calle Principal 102, Lurigancho', 'capacidad' => 700],
            ['nombre' => 'Almacén Pachacámac', 'ubicacion' => 'Av. La Quebrada 103, Pachacámac', 'capacidad' => 450],
            ['nombre' => 'Almacén Mala', 'ubicacion' => 'Av. El Sol 104, Mala', 'capacidad' => 400],
            ['nombre' => 'Almacén Chilca', 'ubicacion' => 'Av. Panamericana Sur 105, Chilca', 'capacidad' => 600],
            ['nombre' => 'Almacén San Luis', 'ubicacion' => 'Av. Circunvalación 106, San Luis', 'capacidad' => 750],
            ['nombre' => 'Almacén Chaclacayo', 'ubicacion' => 'Av. Los Jardines 107, Chaclacayo', 'capacidad' => 500],
        ]);
    }
}
