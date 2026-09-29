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
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('empresa_id')
                ->constrained('empresas')
                ->cascadeOnDelete();

            $table->string('titulo');

            $table->string('area')->nullable();

            $table->text('descripcion');

            $table->text('requisitos')->nullable();

            $table->text('funciones')->nullable();

            $table->string('tipo_contrato')->nullable();

            $table->string('modalidad')->nullable();

            $table->string('ubicacion')->nullable();

            $table->decimal('salario_min', 10, 2)->nullable();

            $table->decimal('salario_max', 10, 2)->nullable();

            $table->boolean('mostrar_salario')->default(false);

            $table->date('fecha_cierre')->nullable();

            $table->enum('estado', [
                'borrador',
                'pendiente',
                'publicada',
                'cerrada',
                'cancelada'
            ])->default('borrador');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oportunidads');
    }
};
