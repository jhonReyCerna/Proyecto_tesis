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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('cantidad');
            $table->date('fecha');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuesto', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'transferencia', 'otros'])->default('efectivo');
            $table->enum('estado', ['pendiente', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamps();


            $table->foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade');


            $table->foreign('cliente_id')->references('id_cliente')->on('clientes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
