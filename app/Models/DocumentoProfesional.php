<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoProfesional extends Model
{
    use HasFactory;

    protected $table = 'documentos_profesionales';
    public $timestamps = false;

    protected $fillable = [
        'perfil_id',
        'nombre_archivo',
        'ruta_archivo',
        'extension',
        'hash_archivo',
        'es_cv',           // 1 si es el Curriculum, 0 si no
        'es_foto_perfil',  // 1 si es la foto, 0 si no
        'estado'
    ];

    /* RELACIONES */

    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }

    /* ACCESSORS (Ayuda para la Vista) */
    
    // Uso: $doc->url_publica
    public function getUrlPublicaAttribute()
    {
        return asset('storage/' . $this->ruta_archivo);
    }
}