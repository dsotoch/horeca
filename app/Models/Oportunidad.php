<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oportunidad extends Model
{
    use HasFactory;

    protected $table = 'oportunidades';

    protected $fillable = [
        'empresa_id',
        'titulo',
        'area',
        'descripcion',
        'requisitos',
        'funciones',
        'tipo_contrato',
        'modalidad',
        'ubicacion',
        'salario_min',
        'salario_max',
        'mostrar_salario',
        'fecha_cierre',
        'estado',
    ];

    protected $casts = [
        'mostrar_salario' => 'boolean',
        'fecha_cierre' => 'date',
        'salario_min' => 'decimal:2',
        'salario_max' => 'decimal:2',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
