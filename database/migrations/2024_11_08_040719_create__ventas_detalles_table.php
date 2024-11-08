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
        Schema::create('_ventas_detalles', function (Blueprint $table) {
            $table->id('id_detalle'); // Primary Key (Auto-Incremental)

            // Foreign Keys
            $table->unsignedBigInteger('id_venta'); // Foreign Key to '_gestionar_ventas'
            $table->unsignedBigInteger('id_producto'); // Foreign Key to 'productos'

            // Campos de detalles de venta
            $table->integer('cantidad'); // Cantidad de productos vendidos
            $table->decimal('precio_unitario', 10, 2); // Precio por unidad del producto
            $table->decimal('descuento', 10, 2)->default(0); // Descuento aplicado por unidad (si aplica)
            $table->decimal('igv', 10, 2)->default(0); // Impuesto del 18% aplicado al subtotal
            $table->decimal('subtotal', 10, 2); // Cantidad * (Precio Unitario - Descuento) + IGV

            // Campos adicionales
            $table->decimal('cambio', 10, 2)->default(0); // Cambio devuelto al cliente (si aplica)

            $table->timestamps(); // created_at y updated_at

            // Foreign Key Constraints
            $table->foreign('id_venta')->references('id_venta')->on('_gestionar_ventas')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_ventas_detalles');
    }
};
