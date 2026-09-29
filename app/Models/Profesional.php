<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    use HasFactory;

    protected $table = 'profesionales';

    protected $fillable = [

        'user_id',

        'nombres',
        'apellidos',

        'tipo_documento',
        'numero_documento',

        'celular',

        'especialidad',
        'subespecialidad',

        'experiencia',
        'modalidad',

        'ciudad',
        'distrito',

        'descripcion',
        'habilidades',

        'video_presentacion',

        'estado_validacion',
        'fecha_validacion',
        'cv'
    ];

    protected $casts = [
        'fecha_validacion' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
