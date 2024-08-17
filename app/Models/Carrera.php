<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model

// Define la clase Carrera que extiende de Model
class Carrera extends Model
{
    use HasFactory; // Usa el trait HasFactory para habilitar la creación de fábricas de modelos

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Nombre',
        'GrupoID'
    ];

    // Define una relación uno a muchos (hasMany) con el propio modelo Carrera
    public function Carrera()
    {
        return $this->hasMany(Carrera::class);
    }     
}
