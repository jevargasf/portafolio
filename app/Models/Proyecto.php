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
    const ESTADO_PAUSADO = 0;
    const ESTADO_ACTIVO = 1;

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }
}