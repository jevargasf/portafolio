<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos_proyectos';

    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'nombre_archivo',
        'ruta_archivo',
        'extension',
        'hash_archivo',
        'es_portada',
        'es_demo',
        'estado'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
    
    public function getUrlPublicaAttribute()
    {
        return asset('storage/' . $this->ruta_archivo);
    }
}