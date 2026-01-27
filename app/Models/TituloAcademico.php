<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TituloAcademico extends Model
{
    use HasFactory;

    protected $table = 'educacion'; // O 'formacion_academica'

    protected $fillable = [
        'perfil_id',
        'institucion',
        'titulo_obtenido',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }
}