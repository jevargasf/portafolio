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
        'estado',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(
            Proyecto::class,           // Modelo relacionado
            'proyectos_tecnologias',   // Nombre de la tabla pivote en tu BBDD
            'tecnologia_id',           // FK de este modelo en la pivote
            'proyecto_id'              // FK del otro modelo en la pivote
        );
    }
}