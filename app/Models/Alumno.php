<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model
use App\Models\Prestamo; // Importa el modelo Prestamo

// Define la clase Alumno que extiende de Model
class Alumno extends Model
{
    use HasFactory; // Usa el trait HasFactory para habilitar la creación de fábricas de modelos

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Nombre',
        'Carrera',
        'GrupoID',
        'Semestre',
        'Curp',
        'Fecha_nac',
        'Edad'
    ];

    // Define una relación uno a muchos (hasMany) con el propio modelo Alumno
    public function Alumno()
    {
        return $this->hasMany(Alumno::class);
    }

    // Define una relación inversa (belongsTo) con el modelo Grupo
    public function Grupo()
    {
        return $this->belongsTo(Grupo::class, 'Nombre');
    }
}
