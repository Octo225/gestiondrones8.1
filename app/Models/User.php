<?php

namespace App\Models;

// Importa las clases necesarias para el modelo User
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Define la clase User que extiende de Authenticatable
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Usa los traits necesarios

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Define los atributos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // Define los atributos que deben estar ocultos durante la serialización
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Define los atributos que deben ser convertidos a tipos específicos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
