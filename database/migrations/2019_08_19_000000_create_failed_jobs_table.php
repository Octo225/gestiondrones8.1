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
    // Método para ejecutar la migración y crear la tabla 'failed_jobs'
    public function up()
    {
        // Crea la tabla 'failed_jobs' usando el esquema Blueprint
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' auto-incrementable que será la clave primaria
            $table->string('uuid')->unique(); // Crea una columna 'uuid' para almacenar un identificador único para el trabajo fallido
            $table->text('connection'); // Crea una columna 'connection' para almacenar la información sobre la conexión del trabajo fallido
            $table->text('queue'); // Crea una columna 'queue' para almacenar la cola del trabajo fallido
            $table->longText('payload'); // Crea una columna 'payload' para almacenar la carga útil del trabajo fallido (es decir, los datos del trabajo)
            $table->longText('exception'); // Crea una columna 'exception' para almacenar la información sobre la excepción que causó el fallo
            $table->timestamp('failed_at')->useCurrent(); // Crea una columna 'failed_at' para almacenar la fecha y hora en que falló el trabajo, usando la hora actual por defecto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Método para revertir la migración y eliminar la tabla 'failed_jobs'
    public function down()
    {
        // Elimina la tabla 'failed_jobs' si existe
        Schema::dropIfExists('failed_jobs');
    }
};
