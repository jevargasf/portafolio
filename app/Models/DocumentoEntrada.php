<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoEntrada extends Model
{
    use HasFactory;

    protected $table = 'documentos_entradas';

    public $timestamps = false;

    protected $fillable = [
        'entrada_id',
        'nombre_archivo',
        'ruta_archivo',
        'extension',
        'hash_archivo',
        'es_portada',
        'estado'
    ];

    protected $casts = [
        'es_portada' => 'boolean',
    ];

    public function entrada()
    {
        return $this->belongsTo(Entrada::class, 'entrada_id');
    }
}