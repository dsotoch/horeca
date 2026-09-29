<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | INFORMACIÓN EMPRESA
            |--------------------------------------------------------------------------
            */

            $table->string('ruc', 11)
                ->unique();

            $table->string('razon_social');

            $table->string('nombre_comercial');

            $table->string('tipo_empresa');


            $table->string('sitio_web')
                ->nullable();

            $table->string('red_social')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | CONTACTO
            |--------------------------------------------------------------------------
            */

            $table->string('contacto_nombres');

            $table->string('contacto_apellidos');

            $table->string('cargo');

            $table->string('celular', 20);

            $table->string('email');


            /*
            |--------------------------------------------------------------------------
            | UBICACIÓN
            |--------------------------------------------------------------------------
            */

            $table->string('departamento');

            $table->string('ciudad');

            $table->string('distrito');

            $table->string('direccion');


            /*
            |--------------------------------------------------------------------------
            | NECESIDADES
            |--------------------------------------------------------------------------
            */

            $table->text('perfiles_busca')
                ->nullable();

            $table->string('tipo_contratacion')
                ->nullable();

            $table->unsignedInteger('cantidad_profesionales')
                ->nullable();

            $table->text('descripcion')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | VALIDACIÓN HORECA PRO
            |--------------------------------------------------------------------------
            */

            $table->enum('estado_validacion', [
                'pendiente',
                'aprobado',
                'rechazado'
            ])->default('pendiente');

            $table->timestamp('fecha_validacion')
                ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};