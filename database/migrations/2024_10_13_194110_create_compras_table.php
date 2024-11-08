<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->unsignedBigInteger('almacen_id');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('descripcion')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();


            $table->foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
            $table->foreign('almacen_id')->references('id_almacen')->on('almacenes')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('_compras');
    }
};
