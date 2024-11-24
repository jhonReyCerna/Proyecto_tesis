<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Electrodomésticos', 'descripcion' => 'Productos eléctricos para el hogar como refrigeradoras, cocinas, lavadoras, etc.'],
            ['nombre' => 'Televisores', 'descripcion' => 'Pantallas de alta definición, televisores inteligentes y monitores.'],
            ['nombre' => 'Computadoras y Laptops', 'descripcion' => 'Dispositivos portátiles y de escritorio para uso personal y profesional.'],
            ['nombre' => 'Celulares y Smartphones', 'descripcion' => 'Teléfonos móviles de última generación y sus accesorios.'],
            ['nombre' => 'Audio y Video', 'descripcion' => 'Sistemas de sonido, parlantes, audífonos, barras de sonido y más.'],
            ['nombre' => 'Cámaras y Fotografía', 'descripcion' => 'Cámaras digitales, cámaras profesionales, drones y accesorios.'],
            ['nombre' => 'Electrodomésticos de Cocina', 'descripcion' => 'Licuadoras, microondas, hornos eléctricos, procesadores de alimentos, etc.'],
            ['nombre' => 'Aire Acondicionado y Climatización', 'descripcion' => 'Aires acondicionados, ventiladores, deshumificadores, y sistemas de climatización.'],
            ['nombre' => 'Lavado y Secado', 'descripcion' => 'Lavadoras, secadoras y centros de lavado para el hogar.'],
            ['nombre' => 'Refrigeración', 'descripcion' => 'Refrigeradoras, congeladoras y enfriadores de vinos.'],
            ['nombre' => 'Pequeños Electrodomésticos', 'descripcion' => 'Aspiradoras, planchas, cafeteras, batidoras y otros productos pequeños para el hogar.'],
            ['nombre' => 'Videojuegos y Consolas', 'descripcion' => 'Consolas de videojuegos, accesorios y videojuegos de diversas plataformas.'],
            ['nombre' => 'Cuidado Personal', 'descripcion' => 'Productos como secadoras de cabello, planchas para el cabello, afeitadoras y productos de higiene.'],
            ['nombre' => 'Muebles para Hogar', 'descripcion' => 'Sofás, camas, estanterías, mesas y otros muebles para el hogar.'],
            ['nombre' => 'Iluminación', 'descripcion' => 'Lámparas, focos LED y soluciones de iluminación inteligente.'],
            ['nombre' => 'Herramientas', 'descripcion' => 'Herramientas eléctricas y manuales para bricolaje, construcción y reparaciones.'],
            ['nombre' => 'Seguridad y Vigilancia', 'descripcion' => 'Cámaras de seguridad, alarmas, sistemas de vigilancia para el hogar o empresa.'],
            ['nombre' => 'Accesorios para Computadoras', 'descripcion' => 'Teclados, mouses, discos duros, monitores adicionales y otros accesorios de computación.'],
            ['nombre' => 'Accesorios para Celulares', 'descripcion' => 'Cargadores, fundas, protectores de pantalla, audífonos y otros accesorios para móviles.'],
            ['nombre' => 'Fitness y Ejercicio', 'descripcion' => 'Bicicletas estáticas, caminadoras, pesas, bandas elásticas y otros equipos de ejercicio.'],
            ['nombre' => 'Ropa y Calzado', 'descripcion' => 'Prendas de vestir, zapatos y accesorios de moda.'],
            ['nombre' => 'Herramientas Eléctricas', 'descripcion' => 'Herramientas eléctricas para uso profesional y doméstico.'],
            ['nombre' => 'Cocina y Comedor', 'descripcion' => 'Vajillas, cubiertos, utensilios y equipos para la cocina.'],
            ['nombre' => 'Juguetes y Juegos', 'descripcion' => 'Juguetes para niños de todas las edades, además de juegos educativos.'],
            ['nombre' => 'Bebés y Maternidad', 'descripcion' => 'Artículos para bebés, desde ropa hasta equipos de cuidado y seguridad.'],
            ['nombre' => 'Hogar y Decoración', 'descripcion' => 'Artículos de decoración, cortinas, alfombras y productos para el hogar.'],
            ['nombre' => 'Deportes y Outdoor', 'descripcion' => 'Equipo y accesorios para deportes al aire libre, camping y actividades de aventura.'],
            ['nombre' => 'Salud y Bienestar', 'descripcion' => 'Productos relacionados con la salud, bienestar personal y artículos para el cuidado físico.'],
            ['nombre' => 'Electrónica', 'descripcion' => 'Equipos electrónicos como cámaras, computadoras, tablets, etc.'],
            ['nombre' => 'Automotriz', 'descripcion' => 'Accesorios y repuestos para automóviles, motocicletas y otros vehículos.'],
            ['nombre' => 'Alimentos y Bebidas', 'descripcion' => 'Productos alimenticios y bebidas de diversas categorías.'],
            ['nombre' => 'Libros y Papelería', 'descripcion' => 'Libros de diversas temáticas, además de artículos de papelería y oficina.'],
            ['nombre' => 'Música e Instrumentos', 'descripcion' => 'Instrumentos musicales y accesorios relacionados con la música.'],
            ['nombre' => 'Tecnología', 'descripcion' => 'Productos de tecnología avanzada como drones, gadgets, y dispositivos inteligentes.'],
            ['nombre' => 'Cuidado del Hogar', 'descripcion' => 'Productos de limpieza, desinfección y mantenimiento del hogar.'],
            ['nombre' => 'Mascotas', 'descripcion' => 'Artículos y alimentos para el cuidado de mascotas como perros, gatos, peces, etc.'],
            ['nombre' => 'Vinos y Licores', 'descripcion' => 'Vinos, cervezas, licores y productos relacionados con bebidas alcohólicas.'],
            ['nombre' => 'Arte y Manualidades', 'descripcion' => 'Materiales y herramientas para actividades artísticas y manualidades.'],
            ['nombre' => 'Jardinería', 'descripcion' => 'Herramientas, plantas y productos para el cuidado de jardines y espacios exteriores.'],
            ['nombre' => 'Instrumentos de Medición', 'descripcion' => 'Herramientas de medición como termómetros, multímetros, medidores de distancia, etc.'],
            ['nombre' => 'Cámaras de Seguridad', 'descripcion' => 'Sistemas de cámaras y vigilancia para hogares y empresas.'],
            ['nombre' => 'Aire Libre y Camping', 'descripcion' => 'Artículos para disfrutar del aire libre, camping y senderismo.'],
            ['nombre' => 'Tienda Online', 'descripcion' => 'Productos disponibles exclusivamente para compras online.'],
            ['nombre' => 'Artículos de Oficina', 'descripcion' => 'Equipos y mobiliario para oficina, papelería y suministros de trabajo.'],
            ['nombre' => 'Tecnología en el Hogar', 'descripcion' => 'Dispositivos y accesorios tecnológicos para mejorar la vida en el hogar.'],
            ['nombre' => 'Cultura y Entretenimiento', 'descripcion' => 'Productos relacionados con la cultura, cine, música y entretenimiento en general.'],
            ['nombre' => 'Moda y Accesorios', 'descripcion' => 'Prendas de vestir y accesorios de moda para todas las edades y estilos.'],
        ]);
    }
}
