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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('dni', 8)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();
            $table->boolean('activo')->default(true);
            $table->string('tipo_cliente')->default('regular');
            $table->timestamps();
        });
    }

     
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
