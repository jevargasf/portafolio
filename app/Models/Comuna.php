<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas';
    
    public $timestamps = false;

    protected $fillable = [
        'nombre', 
        'region_id'
    ];

    /* |--------------------------------------------------------------------------
    | RELACIONES
    |-------------------------------------------------------------------------- */

    /**
     * Relación: Una comuna pertenece a una región
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Relación: Una comuna puede estar en muchos perfiles profesionales
     * (Útil si quieres buscar "todos los profesionales de Rancagua")
     */
    public function perfiles()
    {
        return $this->hasMany(PerfilProfesional::class, 'comuna_id');
    }
}