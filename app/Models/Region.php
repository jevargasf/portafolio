<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regiones';
    
    // Desactivamos timestamps si tu tabla SQL no tiene created_at/updated_at
    public $timestamps = false; 

    protected $fillable = [
        'nombre',
        'iso'
    ];

    /**
     * Relación: Una región tiene muchas comunas
     */
    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'region_id');
    }
}