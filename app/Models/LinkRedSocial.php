<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkRedSocial extends Model
{
    use HasFactory;

    protected $table = 'links_redes_sociales';
    public $timestamps = false;

    protected $fillable = [
        'perfil_id',
        'nombre_red',  
        'url',
        'icono_class', 
        'estado'
    ];

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }
}