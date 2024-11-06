<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desactiva las comprobaciones de claves foráneas

        Schema::create('almacenes', function (Blueprint $table) {
            $table->id('id_almacen');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->integer('capacidad');
            $table->timestamps();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('almacenes');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); 
    }
};
