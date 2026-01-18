<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'usuarios';
    
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'ultima_actualizacion';
    const ESTADO_ACTIVO = 1;
    const ESTADO_ELIMINADO = 9;
    
    protected $fillable = [
        'run',
        'correo',
        'password',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'rol_id',
        'ultima_actualizacion',
        'estado'
    ];

    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'estado' => 'boolean',
        'fecha_creacion' => 'datetime',
        'ultima_actualizacion' => 'datetime',
    ];

    public function getNombreCompletoAttribute()
        {
            return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
        }
}
