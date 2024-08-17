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
    // Método para ejecutar la migración y crear la tabla 'password_resets'
    public function up()
    {
        // Crea la tabla 'password_resets' usando el esquema Blueprint
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index(); // Crea una columna 'email' para almacenar el correo electrónico y añade un índice para mejorar la búsqueda
            $table->string('token'); // Crea una columna 'token' para almacenar el token de restablecimiento de la contraseña
            $table->timestamp('created_at')->nullable(); // Crea una columna 'created_at' para almacenar la fecha de creación del restablecimiento del token, puede ser nula
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración y eliminar la tabla 'password_resets'
    public function down()
    {
        Schema::dropIfExists('password_resets'); // Elimina la tabla 'password_resets' si existe
    }
};
