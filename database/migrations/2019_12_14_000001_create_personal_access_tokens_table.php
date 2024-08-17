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
    // Método para ejecutar la migración y crear la tabla 'personal_access_tokens'
    public function up()
    {
        // Crea la tabla 'personal_access_tokens' usando el esquema Blueprint
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' auto-incrementable que será la clave primaria
            $table->morphs('tokenable'); // Crea las columnas 'tokenable_id' y 'tokenable_type' para soporte de relaciones polimórficas
            $table->string('name'); // Crea una columna 'name' para almacenar el nombre del token
            $table->string('token', 64)->unique(); // Crea una columna 'token' para almacenar el token de acceso, asegurando que sea único
            $table->text('abilities')->nullable(); // Crea una columna 'abilities' para almacenar las habilidades asociadas con el token, puede ser nula
            $table->timestamp('last_used_at')->nullable(); // Crea una columna 'last_used_at' para almacenar la última vez que se usó el token, puede ser nula
            $table->timestamp('expires_at')->nullable(); // Crea una columna 'expires_at' para almacenar la fecha de expiración del token, puede ser nula
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at' para gestionar los tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración y eliminar la tabla 'personal_access_tokens'
    public function down()
    {
        // Elimina la tabla 'personal_access_tokens' si existe
        Schema::dropIfExists('personal_access_tokens');
    }
};
