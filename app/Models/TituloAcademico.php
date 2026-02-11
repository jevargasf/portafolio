<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TituloAcademico extends Model
{
    use HasFactory;

    protected $table = 'titulos_academicos';

    public $timestamps = false;
    
    protected $fillable = [
        'perfil_id',
        'institucion',
        'nombre_titulo',
        'fecha_inicio',
        'fecha_obtencion',
        'comuna_id',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio'    => 'date', 
        'fecha_obtencion' => 'date', 
        'estado'          => 'integer',
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