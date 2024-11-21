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

        Schema::create('ventas_detalles', function (Blueprint $table) {
            $table->id('id_detalle');


            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_producto');

            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('igv', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('cambio', 10, 2)->default(0);

            $table->timestamps();


            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('ventas_detalles');
    }
};
