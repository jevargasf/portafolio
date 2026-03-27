<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscriptor extends Model
{
    protected $table = 'suscriptores';

    public $timestamps = false;

    protected $fillable = [
        'correo',
        'timestamp_verificacion',
        'estado',
    ];

    protected $casts = [
        'timestamp_verificacion' => 'datetime',
        'estado' => 'integer',
    ];
}