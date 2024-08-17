<?php

use Illuminate\Database\Migrations\Migration; // Importa la clase Migration para las migraciones
use Illuminate\Database\Schema\Blueprint; // Importa la clase Blueprint para definir la estructura de la tabla
use Illuminate\Support\Facades\Schema; // Importa la clase Schema para manipular las tablas

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Método para ejecutar la migración y crear la tabla 'prestamos'
    public function up()
    {
        // Crea la tabla 'prestamos' usando el esquema Blueprint
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' de tipo BIGINT auto-incremental, que será la clave primaria
            $table->string('Nombre_alumno', 255); // Crea una columna 'Nombre_alumno' de tipo STRING con una longitud máxima de 255 caracteres
            $table->string('Carrera', 50); // Crea una columna 'Carrera' de tipo STRING con una longitud máxima de 50 caracteres
            $table->string('Grupo', 50); // Crea una columna 'Grupo' de tipo STRING con una longitud máxima de 50 caracteres
            $table->dateTime('Fecha_hora'); // Crea una columna 'Fecha_hora' de tipo DATE TIME para registrar fecha y hora
            $table->integer('Cantidad'); // Crea una columna 'Cantidad' de tipo INTEGER para registrar la cantidad
            $table->text('Descripcion'); // Crea una columna 'Descripcion' de tipo TEXT para almacenar una descripción
            $table->string('Estado', 50); // Crea una columna 'Estado' de tipo STRING con una longitud máxima de 50 caracteres
            $table->string('Fecha_devolucion', 20)->nullable(); // Crea una columna 'Fecha_devolucion' de tipo STRING con longitud máxima de 20 caracteres, permitiendo valores nulos
            $table->string('Material_Folio'); // Crea una columna 'Material_Folio' de tipo STRING para registrar el folio del material
            $table->string('Detalle', 50)->nullable(); // Crea una columna 'Detalle' de tipo STRING con una longitud máxima de 50 caracteres, permitiendo valores nulos
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para gestionar los tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración y eliminar la tabla 'prestamos'
    public function down()
    {
        // Elimina la tabla 'prestamos' si existe
        Schema::dropIfExists('prestamos');
    }
};
