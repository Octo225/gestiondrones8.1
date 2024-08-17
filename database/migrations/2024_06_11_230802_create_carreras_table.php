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
        // Crea la tabla 'carreras'
        Schema::create('carreras', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' de tipo BIGINT auto-incremental y la establece como clave primaria
            $table->string('Carrera', 50); // Crea una columna 'Carrera' de tipo STRING con una longitud máxima de 50 caracteres
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
        // Elimina la tabla 'carreras' si existe
        Schema::dropIfExists('carreras');
    }
};
