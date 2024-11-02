<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
