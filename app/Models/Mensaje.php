<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';
    
    // Desactivamos los timestamps de Laravel porque usas 'fecha_envio'
    public $timestamps = false;

    protected $fillable = [
        'nombre_remitente',
        'correo_remitente',
        'telefono',
        'asunto',
        'detalle',
        'fecha_envio', // Opcional, la BBDD pone la actual por defecto
        'estado'       // 1: No leído, 2: Leído, etc.
    ];

    /**
     * Convertir columnas automáticamente a tipos de datos nativos
     */
    protected $casts = [
        'fecha_envio' => 'datetime',
        'estado'      => 'integer',
    ];

    // Opcional: Scope para filtrar solo los no leídos
    public function scopeNoLeidos($query)
    {
        return $query->where('estado', 1);
    }
}