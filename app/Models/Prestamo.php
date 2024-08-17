<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model

// Define la clase Prestamo que extiende de Model
class Prestamo extends Model
{
    use HasFactory; // Usa el trait HasFactory para habilitar la creación de fábricas de modelos

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Nombre_alumno',
        'Carrera',
        'Grupo',
        'Fecha_hora',
        'Cantidad',
        'Descripcion',
        'Estado',
        'Fecha_devolucion',
        'Material_Folio',
        'Detalle'
    ];

    // Define una relación inversa (belongsTo) con el modelo Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'Material_Folio', 'Folio');
    }

    // Define una relación inversa (belongsTo) con el modelo Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'Nombre');
    }
}
