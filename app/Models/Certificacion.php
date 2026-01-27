<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $table = 'certificaciones';
    public $timestamps = false;

    protected $fillable = [
        'perfil_id',
        'nombre',
        'organizacion',
        'numero_horas',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'url_certificado',
        'comuna_id',
        'estado'
    ];

    // Convierte automáticamente las columnas de texto a objetos Carbon (Fecha)
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    /* RELACIONES */
    
    public function perfil()
    {
        return $this->belongsTo(PerfilProfesional::class, 'perfil_id');
    }

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }
}