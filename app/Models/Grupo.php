<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model

// Define la clase Grupo que extiende de Model
class Grupo extends Model
{
    use HasFactory; // Usa el trait HasFactory para habilitar la creación de fábricas de modelos

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Nombre'
    ];

    // Define una relación inversa (belongsTo) con el modelo Carrera
    public function Carrera()
    {
        return $this->belongsTo(Carrera::class, 'Nombre');
    }
}
