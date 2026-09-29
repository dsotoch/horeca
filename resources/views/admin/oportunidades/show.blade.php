@extends('layouts.dashboard')

@section('title', 'Detalle de oportunidad')

@section('header-title', 'Detalle de oportunidad')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- =========================================================
         VOLVER
    ========================================================== --}}

    <div>

        <a
            href="{{ route('admin.oportunidades.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-white/50 transition hover:text-horeca-dorado"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Volver a oportunidades
        </a>

    </div>


    {{-- =========================================================
         CABECERA
    ========================================================== --}}

    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6 md:p-8">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <div class="flex gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10">
                    <i class="fa-solid fa-briefcase text-2xl text-horeca-dorado"></i>
                </div>

                <div>

                    <div class="flex flex-wrap items-center gap-3">

                        <h1 class="text-2xl font-black text-white">
                            {{ $oportunidad->titulo }}
                        </h1>

                        @if($oportunidad->estado === 'publicada')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1.5 text-sm font-bold text-emerald-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Publicada
                            </span>

                        @elseif($oportunidad->estado === 'cerrada')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-500/10 px-3 py-1.5 text-sm font-bold text-orange-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>
                                Cerrada
                            </span>

                        @else

                            <span class="rounded-full bg-white/10 px-3 py-1.5 text-sm font-bold text-white/60">
                                {{ ucfirst($oportunidad->estado ?: 'Sin estado') }}
                            </span>

                        @endif

                    </div>


                    @if($oportunidad->empresa)

                        @php
                            $nombreEmpresa =
                                $oportunidad->empresa->nombre_comercial
                                ?? $oportunidad->empresa->razon_social
                                ?? 'Empresa';
                        @endphp

                        <p class="mt-2 text-sm text-white/50">

                            <i class="fa-solid fa-building mr-1"></i>

                            {{ $nombreEmpresa }}

                        </p>

                    @endif

                </div>

            </div>


            {{-- CAMBIAR ESTADO --}}

            <form
                method="POST"
                action="{{ route('admin.oportunidades.estado', $oportunidad) }}"
            >

                @csrf
                @method('PATCH')

                @if($oportunidad->estado === 'publicada')

                    <button
                        type="submit"
                        onclick="return confirm('¿Deseas cerrar esta oportunidad?')"
                        class="inline-flex items-center gap-2 rounded-xl bg-orange-500/10 px-5 py-3 text-sm font-bold text-orange-400 transition hover:bg-orange-500/20"
                    >
                        <i class="fa-solid fa-lock"></i>
                        Cerrar oportunidad
                    </button>

                @else

                    <button
                        type="submit"
                        onclick="return confirm('¿Deseas publicar nuevamente esta oportunidad?')"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-500/10 px-5 py-3 text-sm font-bold text-emerald-400 transition hover:bg-emerald-500/20"
                    >
                        <i class="fa-solid fa-unlock"></i>
                        Publicar oportunidad
                    </button>

                @endif

            </form>

        </div>

    </div>


    {{-- =========================================================
         CONTENIDO
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- =====================================================
             INFORMACIÓN
        ====================================================== --}}

        <div class="space-y-6 lg:col-span-2">

            {{-- DESCRIPCIÓN --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="flex items-center gap-2 text-lg font-black text-white">

                    <i class="fa-solid fa-align-left text-horeca-dorado"></i>

                    Descripción

                </h2>

                <div class="mt-4 whitespace-pre-line text-sm leading-7 text-white/65">

                    {{ $oportunidad->descripcion ?: 'No se ha registrado una descripción.' }}

                </div>

            </div>


            {{-- FUNCIONES --}}

            @if($oportunidad->funciones)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="flex items-center gap-2 text-lg font-black text-white">

                        <i class="fa-solid fa-list-check text-horeca-dorado"></i>

                        Funciones

                    </h2>

                    <div class="mt-4 whitespace-pre-line text-sm leading-7 text-white/65">

                        {{ $oportunidad->funciones }}

                    </div>

                </div>

            @endif


            {{-- REQUISITOS --}}

            @if($oportunidad->requisitos)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="flex items-center gap-2 text-lg font-black text-white">

                        <i class="fa-solid fa-clipboard-check text-horeca-dorado"></i>

                        Requisitos

                    </h2>

                    <div class="mt-4 whitespace-pre-line text-sm leading-7 text-white/65">

                        {{ $oportunidad->requisitos }}

                    </div>

                </div>

            @endif


            {{-- =================================================
                 POSTULACIONES
            ================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#111A29]">

                <div class="border-b border-white/10 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-lg font-black text-white">
                                Postulaciones
                            </h2>

                            <p class="mt-1 text-sm text-white/40">
                                Profesionales que han postulado a esta oportunidad.
                            </p>

                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10">

                            <i class="fa-solid fa-paper-plane text-horeca-dorado"></i>

                        </div>

                    </div>

                </div>


                @if($oportunidad->postulaciones->count())

                    <div class="divide-y divide-white/5">

                        @foreach($oportunidad->postulaciones as $postulacion)

                            @php
                                $profesional = $postulacion->profesional;

                                $nombreProfesional = trim(
                                    ($profesional?->nombres ?? '') . ' ' .
                                    ($profesional?->apellidos ?? '')
                                );

                                $nombreProfesional =
                                    $nombreProfesional ?: 'Profesional';

                                $estadoPostulacion =
                                    $postulacion->estado ?? 'pendiente';
                            @endphp

                            <div class="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white/5">

                                        <i class="fa-solid fa-user text-white/60"></i>

                                    </div>

                                    <div>

                                        <p class="font-bold text-white">
                                            {{ $nombreProfesional }}
                                        </p>

                                        @if($profesional?->especialidad)

                                            <p class="mt-1 text-sm text-white/40">
                                                {{ $profesional->especialidad }}
                                            </p>

                                        @endif

                                        @if($profesional?->numero_documento)

                                            <p class="mt-1 text-sm text-white/60">
                                                Documento:
                                                {{ $profesional->numero_documento }}
                                            </p>

                                        @endif

                                    </div>

                                </div>


                                <div class="flex items-center gap-3">

                                    @if($estadoPostulacion === 'pendiente')

                                        <span class="rounded-full bg-yellow-500/10 px-3 py-1.5 text-sm font-bold text-yellow-400">
                                            Pendiente
                                        </span>

                                    @elseif($estadoPostulacion === 'en_revision')

                                        <span class="rounded-full bg-blue-500/10 px-3 py-1.5 text-sm font-bold text-blue-400">
                                            En revisión
                                        </span>

                                    @elseif($estadoPostulacion === 'entrevista')

                                        <span class="rounded-full bg-purple-500/10 px-3 py-1.5 text-sm font-bold text-purple-400">
                                            Entrevista
                                        </span>

                                    @elseif($estadoPostulacion === 'seleccionado')

                                        <span class="rounded-full bg-emerald-500/10 px-3 py-1.5 text-sm font-bold text-emerald-400">
                                            Seleccionado
                                        </span>

                                    @elseif($estadoPostulacion === 'descartado')

                                        <span class="rounded-full bg-red-500/10 px-3 py-1.5 text-sm font-bold text-red-400">
                                            Descartado
                                        </span>

                                    @else

                                        <span class="rounded-full bg-white/10 px-3 py-1.5 text-sm font-bold text-white/50">
                                            {{ ucfirst(str_replace('_', ' ', $estadoPostulacion)) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <i class="fa-solid fa-users-slash text-3xl text-white/15"></i>

                        <p class="mt-4 font-bold text-white">
                            Aún no hay postulaciones
                        </p>

                        <p class="mt-1 text-sm text-white/40">
                            Ningún profesional ha postulado a esta oportunidad.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <div class="space-y-6">

            {{-- DATOS DE LA OPORTUNIDAD --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">
                    Información
                </h2>

                <div class="mt-5 space-y-5">

                    {{-- ÁREA --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Área
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white/80">
                            {{ $oportunidad->area ?: 'No especificada' }}
                        </p>

                    </div>


                    {{-- CONTRATO --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Tipo de contrato
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white/80">
                            {{ $oportunidad->tipo_contrato ?: 'No especificado' }}
                        </p>

                    </div>


                    {{-- MODALIDAD --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Modalidad
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white/80">
                            {{ $oportunidad->modalidad ?: 'No especificada' }}
                        </p>

                    </div>


                    {{-- UBICACIÓN --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Ubicación
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white/80">
                            {{ $oportunidad->ubicacion ?: 'No especificada' }}
                        </p>

                    </div>


                    {{-- SALARIO --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Salario
                        </p>

                        @if($oportunidad->mostrar_salario)

                            @if($oportunidad->salario_min && $oportunidad->salario_max)

                                <p class="mt-1 text-sm font-semibold text-white/80">
                                    S/ {{ number_format($oportunidad->salario_min, 2) }}
                                    -
                                    S/ {{ number_format($oportunidad->salario_max, 2) }}
                                </p>

                            @elseif($oportunidad->salario_min)

                                <p class="mt-1 text-sm font-semibold text-white/80">
                                    Desde S/
                                    {{ number_format($oportunidad->salario_min, 2) }}
                                </p>

                            @elseif($oportunidad->salario_max)

                                <p class="mt-1 text-sm font-semibold text-white/80">
                                    Hasta S/
                                    {{ number_format($oportunidad->salario_max, 2) }}
                                </p>

                            @else

                                <p class="mt-1 text-sm text-white/40">
                                    No especificado
                                </p>

                            @endif

                        @else

                            <p class="mt-1 text-sm text-white/40">
                                No publicado
                            </p>

                        @endif

                    </div>


                    {{-- FECHA CIERRE --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Fecha de cierre
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white/80">

                            @if($oportunidad->fecha_cierre)

                                {{ \Carbon\Carbon::parse($oportunidad->fecha_cierre)->format('d/m/Y') }}

                            @else

                                Sin fecha

                            @endif

                        </p>

                    </div>


                    {{-- POSTULACIONES --}}

                    <div>

                        <p class="text-sm font-bold uppercase tracking-wider text-white/60">
                            Postulaciones
                        </p>

                        <p class="mt-1 text-2xl font-black text-horeca-dorado">
                            {{ $oportunidad->postulaciones->count() }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- EMPRESA --}}

            @if($oportunidad->empresa)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="text-lg font-black text-white">
                        Empresa
                    </h2>

                    @php
                        $empresa = $oportunidad->empresa;

                        $nombreEmpresa =
                            $empresa->nombre_comercial
                            ?? $empresa->razon_social
                            ?? 'Empresa';
                    @endphp

                    <div class="mt-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-horeca-dorado/10">

                                <i class="fa-solid fa-building text-horeca-dorado"></i>

                            </div>

                            <div>

                                <p class="font-bold text-white">
                                    {{ $nombreEmpresa }}
                                </p>

                                @if($empresa->ruc)

                                    <p class="mt-1 text-sm text-white/40">
                                        RUC: {{ $empresa->ruc }}
                                    </p>

                                @endif

                            </div>

                        </div>


                        @if($empresa->ciudad || $empresa->departamento)

                            <div class="mt-5 flex items-start gap-3">

                                <i class="fa-solid fa-location-dot mt-1 text-white/60"></i>

                                <p class="text-sm text-white/60">

                                    {{ $empresa->ciudad }}

                                    @if($empresa->ciudad && $empresa->departamento)
                                        ,
                                    @endif

                                    {{ $empresa->departamento }}

                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection