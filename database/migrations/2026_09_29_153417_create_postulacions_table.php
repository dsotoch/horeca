<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {

            $table->id();

            $table->foreignId('oportunidad_id')
                ->constrained('oportunidades')
                ->cascadeOnDelete();

            $table->foreignId('profesional_id')
                ->constrained('profesionales')
                ->cascadeOnDelete();

            $table->enum('estado', [
                'pendiente',
                'en_revision',
                'entrevista',
                'seleccionado',
                'descartado',
            ])->default('pendiente');

            $table->text('mensaje')->nullable();

            $table->text('observaciones')->nullable();

            $table->timestamp('fecha_postulacion')->nullable();

            $table->timestamps();

            $table->unique([
                'oportunidad_id',
                'profesional_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulacions');
    }
};
