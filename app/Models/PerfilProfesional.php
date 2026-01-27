<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilProfesional extends Model
{
    use HasFactory;

    protected $table = 'perfil_profesional';

    protected $fillable = [
        'usuario_id',
        'ocupacion',       
        'biografia',       
        'telefono',        
        'esta_disponible',
        'estado'           
    ];

    protected $casts = [
        'esta_disponible' => 'boolean',
    ];

    /* |--------------------------------------------------------------------------
    | RELACIONES
    |-------------------------------------------------------------------------- */

    /**
     * El perfil pertenece a un Usuario (1 a 1 o 1 a N)
     */
    public function usuario()
    {
        // 'usuario_id' es la FK en esta tabla
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Un perfil tiene muchos Proyectos (Relación detectada en tu SQL)
     */
    public function proyectos()
    {
        // 'perfil_id' es la FK en la tabla 'proyectos'
        return $this->hasMany(Proyecto::class, 'perfil_id');
    }

    // /**
    //  * Relación con Comuna (para ubicación)
    //  */
    // public function comuna()
    // {
    //     return $this->belongsTo(Comuna::class, 'comuna_id');
    // }

    public function experiencias()
    {
        return $this->hasMany(ExperienciaLaboral::class, 'perfil_id')->orderBy('fecha_inicio', 'desc');
    }

    public function educacion()
    {
        return $this->hasMany(TituloAcademico::class, 'perfil_id')->orderBy('fecha_inicio', 'desc');
    }

    public function habilidades()
    {
        return $this->hasMany(Habilidad::class, 'perfil_id');
    }

    public function redesSociales()
    {
        return $this->hasMany(LinkRedSocial::class, 'perfil_id');
    }

    public function certificaciones()
    {
        return $this->hasMany(Certificacion::class, 'perfil_id')->orderBy('fecha_inicio', 'desc');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoProfesional::class, 'perfil_id');
    }
    
    /* |--------------------------------------------------------------------------
    | ACCESSORS (Opcionales)
    |-------------------------------------------------------------------------- */
    
    // Para obtener la ubicación completa fácilmente: $perfil->ubicacion_completa
    // public function getUbicacionCompletaAttribute()
    // {
    //     if ($this->comuna && $this->comuna->region) {
    //         return $this->comuna->nombre . ', ' . $this->comuna->region->nombre;
    //     }
    //     return 'Ubicación no definida';
    // }

    public function getFotoPerfilAttribute()
    {
        return $this->documentos()->where('es_foto_perfil', 1)->first();
    }

    public function getCvAttribute()
    {
        return $this->documentos()->where('es_cv', 1)->first();
    }
}