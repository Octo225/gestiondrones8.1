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
    // Método para ejecutar la migración
    public function up()
    {
        // Crea la tabla 'users' usando el esquema Blueprint
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' auto-incrementable que será la clave primaria
            $table->string('name'); // Crea una columna 'name' para almacenar el nombre del usuario
            $table->string('email')->unique(); // Crea una columna 'email' para almacenar el correo electrónico, que debe ser único
            $table->timestamp('email_verified_at')->nullable(); // Crea una columna 'email_verified_at' para almacenar la fecha de verificación del correo electrónico, puede ser nula
            $table->string('password'); // Crea una columna 'password' para almacenar la contraseña del usuario
            $table->rememberToken(); // Crea una columna 'remember_token' para almacenar el token de recuerdo para la autenticación
            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at' para manejar las fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración
    public function down()
    {
        // Elimina la tabla 'users' si existe
        Schema::dropIfExists('users');
    }
};
