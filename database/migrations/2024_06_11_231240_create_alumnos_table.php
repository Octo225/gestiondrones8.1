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
        // Crea la tabla 'alumnos'
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' de tipo BIGINT auto-incremental y la establece como clave primaria
            $table->string('Nombre', 255); // Crea una columna 'Nombre' de tipo STRING con una longitud máxima de 255 caracteres
            $table->string('Carrera', 50); // Crea una columna 'Carrera' de tipo STRING con una longitud máxima de 50 caracteres
            $table->integer('Grupo'); // Crea una columna 'Grupo' de tipo INTEGER para almacenar el número del grupo
            $table->string('Semestre', 50); // Crea una columna 'Semestre' de tipo STRING con una longitud máxima de 50 caracteres
            $table->string('Curp', 100); // Crea una columna 'Curp' de tipo STRING con una longitud máxima de 100 caracteres
            $table->date('Fecha_nac'); // Crea una columna 'Fecha_nac' de tipo DATE para almacenar la fecha de nacimiento
            $table->integer('Edad'); // Crea una columna 'Edad' de tipo INTEGER para almacenar la edad

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
        // Elimina la tabla 'alumnos' si existe
        Schema::dropIfExists('alumnos');
    }
};
