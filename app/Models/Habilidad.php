<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;

    protected $table = 'habilidades';

    protected $fillable = [
        // 'perfil_id',
        'nombre', // Ej: 'Laravel', 'SQL', 'Liderazgo'
        'nivel',  // Ej: 1 al 100, o 'Básico', 'Avanzado'
        'tipo'    // 'Técnica' (Hard Skill) o 'Blanda' (Soft Skill)
    ];

    // public function perfil()
    // {
    //     return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    // }
}