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
        Schema::create('_gestionar_ventas', function (Blueprint $table) {
            $table->id('id_venta'); // Primary Key (Auto-Incremental)
            $table->unsignedBigInteger('id_cliente'); // Foreign Key
            $table->decimal('totalPagar', 10, 2); // Ej: 99999999.99
            $table->date('fecha'); // Fecha de la venta
            $table->string('estado', 20); // Estado de la venta (Ej: 'Pendiente', 'Pagado')
            $table->timestamps(); // created_at y updated_at

            // Corregir la clave foránea para referirse a 'id_cliente' en la tabla 'clientes'
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_gestionar_ventas');
    }
};
