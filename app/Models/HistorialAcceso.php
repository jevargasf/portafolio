<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAcceso extends Model
{
    use HasFactory;

    protected $table = 'historial_accesos';
    
    // Desactivamos timestamps estándar porque usas 'fecha'
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'fecha',
        'tipo_accion' // Ej: 1=Login, 2=Logout, 3=Intento Fallido
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Relación: Un registro de historial pertenece a un Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}