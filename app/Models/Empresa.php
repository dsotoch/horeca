<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [

        'user_id',

        'ruc',
        'razon_social',
        'nombre_comercial',
        'tipo_empresa',

        'sitio_web',
        'red_social',

        'contacto_nombres',
        'contacto_apellidos',
        'cargo',

        'celular',
        'email',

        'departamento',
        'ciudad',
        'distrito',
        'direccion',

        'perfiles_busca',
        'tipo_contratacion',
        'cantidad_profesionales',

        'descripcion',

        'estado_validacion',
        'fecha_validacion',
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
}