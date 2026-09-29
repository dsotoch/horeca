<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profesionales', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | DATOS PERSONALES
            |--------------------------------------------------------------------------
            */

            $table->string('nombres');
            $table->string('apellidos');

            $table->enum('tipo_documento', [
                'DNI',
                'CE'
            ]);

            $table->string('numero_documento', 20);

            $table->string('celular', 20);


            /*
            |--------------------------------------------------------------------------
            | PERFIL PROFESIONAL
            |--------------------------------------------------------------------------
            */

            $table->string('especialidad');

            $table->string('subespecialidad')
                ->nullable();

            $table->string('experiencia');

            $table->enum('modalidad', [
                'presencial',
                'remoto',
                'hibrido'
            ]);

            $table->string('ciudad');
            $table->string('distrito');

            $table->text('descripcion');

            $table->text('habilidades')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | VIDEO
            |--------------------------------------------------------------------------
            */

            $table->string('video_presentacion')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | VALIDACIÓN
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

            $table->unique([
                'tipo_documento',
                'numero_documento'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};