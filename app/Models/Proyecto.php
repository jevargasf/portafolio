<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'perfil_id',          
        'nombre',
        'descripcion',
        'desafio',
        'solucion',
        'horas_trabajo',      
        'url_repositorio',    
        'url_produccion',    
        'fecha_realizacion', 
        'estado',
    ];

    protected $casts = [
        'fecha_realizacion' => 'date',
        'estado' => 'integer',
        'horas_trabajo' => 'integer',
    ];

    // CONSTANTES DE ESTADO
    const ESTADO_EN_PROGRESO = 0;
    const ESTADO_TERMINADO = 1;
    const ESTADO_PAUSADO = 2;
    const ESTADO_ELIMINADO = 9;

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }

    public function tecnologias()
    {
        return $this->belongsToMany(
            Tecnologia::class, 
            'proyectos_tecnologias', 
            'proyecto_id', 
            'tecnologia_id'
        );
    }
}