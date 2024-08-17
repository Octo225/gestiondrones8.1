<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory
use Illuminate\Database\Eloquent\Model; // Importa la clase base Model
use App\Models\Prestamo; // Importa el modelo Prestamo

// Define la clase Material que extiende de Model
class Material extends Model
{
    use HasFactory; // Usa el trait HasFactory para habilitar la creación de fábricas de modelos
    
    public $incrementing = false; // Desactiva el auto-incremento de la clave primaria

    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Numero_Serie',
        'Folio_Conalep',
        'Imagen'
    ];

    // Define una relación uno a muchos (hasMany) con el modelo Prestamo
    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }        
}
