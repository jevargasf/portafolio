<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entradas';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'slug',
        'titulo',
        'extracto',
        'contenido',
        'fecha_publicacion',
        'scope',   // 'personal' o 'profesional'
        'estado',  // 1: Borrador, 2: Publicado
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
        'estado' => 'integer',
    ];

    // ==========================================
    // RELACIONES
    // ==========================================

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoEntrada::class, 'entrada_id');
    }

    // Helper para obtener la portada rápidamente
    public function portada()
    {
        return $this->hasOne(DocumentoEntrada::class, 'entrada_id')->where('es_portada', 1);
    }

    // ==========================================
    // SCOPES (Filtros Rápidos)
    // ==========================================

    // Uso: Entrada::publicadas()->get();
    public function scopePublicadas($query)
    {
        return $query->where('estado', 2)
                     ->where('fecha_publicacion', '<=', now());
    }

    // Uso: Entrada::profesionales()->get();
    public function scopeProfesionales($query)
    {
        return $query->where('scope', 'profesional');
    }

    // Uso: Entrada::personales()->get();
    public function scopePersonales($query)
    {
        return $query->where('scope', 'personal');
    }
}