<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' de tipo BIGINT auto-incremental y la establece como clave primaria
            $table->integer('Nombre'); // Crea una columna 'Nombre' de tipo INTEGER. Normalmente se usaría STRING para nombres
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para gestionar los tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos'); // Elimina la tabla 'grupos' si existe
    }
};
