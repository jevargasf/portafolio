<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    use HasFactory;

    protected $table = 'tecnologias';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ruta_icono',
        'tipo',
        'estado',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(
            Proyecto::class,          
            'proyectos_tecnologias',  
            'tecnologia_id',        
            'proyecto_id'          
        )->withPivot('prioridad');
    }
}