<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Desactivamos las comprobaciones de claves foráneas para evitar problemas durante la migración
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('ruc', 11)->unique();
            $table->timestamps();
        });

        // Volvemos a habilitar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Desactivamos las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Eliminar registros de las tablas dependientes antes de eliminar la tabla proveedores
        // Asegúrate de ajustar las tablas y las columnas que dependan de proveedores
        DB::table('productos')->whereNotNull('id_proveedor')->delete(); // Elimina productos que refieren a proveedores
        DB::table('ventas')->whereNotNull('id_proveedor')->delete(); // Elimina ventas que refieren a proveedores

        // Eliminar la tabla proveedores
        Schema::dropIfExists('proveedores');

        // Volver a habilitar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
