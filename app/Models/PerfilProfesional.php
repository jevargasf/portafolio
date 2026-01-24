<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilProfesional extends Model
{
    use HasFactory;

    // Aseguramos que apunte a la tabla correcta (singular o plural según tu SQL)
    // Generalmente en SQL manual suele ser singular: 'perfil_profesional'
    protected $table = 'perfil_profesional';

    protected $fillable = [
        'usuario_id',
        'comuna_id',      // Asumiendo relación con tu tabla 'comunas'
        'titulo',         // Ej: Desarrollador Full Stack
        'biografia',      // o 'resumen_perfil'
        'telefono',
        'url_linkedin',
        'url_github',
        'estado',         // 1: Visible, 0: Oculto
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

    /**
     * Relación con Comuna (para ubicación)
     */
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }

    /* |--------------------------------------------------------------------------
    | ACCESSORS (Opcionales)
    |-------------------------------------------------------------------------- */
    
    // Para obtener la ubicación completa fácilmente: $perfil->ubicacion_completa
    public function getUbicacionCompletaAttribute()
    {
        if ($this->comuna && $this->comuna->region) {
            return $this->comuna->nombre . ', ' . $this->comuna->region->nombre;
        }
        return 'Ubicación no definida';
    }
}