<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactiva las comprobaciones de claves foráneas

        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->decimal('precio', 8, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_almacen');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
            $table->foreign('id_almacen')->references('id_almacen')->on('almacenes')->onDelete('cascade');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Vuelve a activar las comprobaciones de claves foráneas
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactiva las comprobaciones de claves foráneas

        Schema::dropIfExists('productos');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Vuelve a activar las comprobaciones de claves foráneas
    }
}
