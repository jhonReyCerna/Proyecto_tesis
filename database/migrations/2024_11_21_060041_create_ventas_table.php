<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->unsignedBigInteger('id_cliente');
            $table->decimal('totalPagar', 10, 2);
            $table->date('fecha_venta');
            $table->string('estado', 20);
            $table->timestamps();


            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('ventas');
    }
};
