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
    // Método para ejecutar la migración y crear la tabla 'materials'
    public function up()
    {
        // Crea la tabla 'materials' usando el esquema Blueprint
        Schema::create('materials', function (Blueprint $table) {
            $table->char('id', 50)->primary(); // Crea una columna 'id' de tipo CHAR con una longitud de 50 caracteres, estableciéndola como clave primaria
            $table->string('nombre', 50); // Crea una columna 'nombre' de tipo STRING con una longitud máxima de 50 caracteres
            $table->string('descripcion', 255); // Crea una columna 'descripcion' de tipo STRING con una longitud máxima de 255 caracteres
            $table->string('Folio_Conalep', 20); // Crea una columna 'Folio_Conalep' de tipo STRING con una longitud máxima de 20 caracteres
            $table->longText('imagen')->nullable(); // Crea una columna 'imagen' de tipo STRING, permitiendo valores nulos (opcional)
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para gestionar los tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración y eliminar la tabla 'materials'
    public function down()
    {
        // Elimina la tabla 'materials' si existe
        Schema::dropIfExists('materials');
    }
};
