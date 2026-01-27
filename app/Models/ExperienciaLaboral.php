<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    use HasFactory;

    protected $table = 'experiencias_laborales';

    protected $fillable = [
        'perfil_id',
        'empresa',
        'cargo',
        'descripcion_tareas',
        'fecha_inicio',
        'fecha_fin',
        'es_actual' 
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }
}