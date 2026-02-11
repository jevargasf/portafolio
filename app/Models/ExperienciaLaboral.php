<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    use HasFactory;

    protected $table = 'experiencias_laborales';

    public $timestamps = false;

    protected $fillable = [
        'perfil_id',
        'organizacion',
        'cargo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'es_trabajo_actual' ,
        'comuna_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'es_trabajo_actual' => 'boolean',
    ];

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }
}