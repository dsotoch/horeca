<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulaciones';

    protected $fillable = [

        'oportunidad_id',
        'profesional_id',

        'estado',

        'mensaje',
        'observaciones',

        'fecha_postulacion',
    ];

    protected $casts = [

        'fecha_postulacion' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function oportunidad()
    {
        return $this->belongsTo(
            Oportunidad::class
        );
    }

    public function profesional()
    {
        return $this->belongsTo(
            Profesional::class
        );
    }
}