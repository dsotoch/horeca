@extends('layouts.dashboard')

@section('title', 'Perfil del profesional')

@section('header-title', 'Perfil del profesional')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

    {{-- ==========================================
         VOLVER
    =========================================== --}}

    <div>
        <a
            href="{{ route('empresa.postulaciones.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-white/50 transition hover:text-horeca-dorado"
        >
            ← Volver a postulaciones
        </a>
    </div>


    @php

        $profesional = $postulacion->profesional;
        $oportunidad = $postulacion->oportunidad;

        $nombreCompleto = trim(
            ($profesional->nombres ?? '') . ' ' .
            ($profesional->apellidos ?? '')
        );

        $iniciales = strtoupper(
            substr($profesional->nombres ?? '', 0, 1) .
            substr($profesional->apellidos ?? '', 0, 1)
        );

    @endphp


    {{-- ==========================================
         CABECERA DEL PROFESIONAL
    =========================================== --}}

    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex flex-col gap-6 md:flex-row md:items-start">

            {{-- AVATAR --}}

            <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-3xl bg-horeca-dorado/10 text-3xl font-black text-horeca-dorado">

                {{ $iniciales ?: 'P' }}

            </div>


            {{-- DATOS PRINCIPALES --}}

            <div class="min-w-0 flex-1">

                <div class="flex flex-wrap items-center gap-3">

                    <h1 class="text-3xl font-black text-white">
                        {{ $nombreCompleto ?: 'Profesional' }}
                    </h1>

                    @if($postulacion->estado === 'pendiente')

                        <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                            Pendiente
                        </span>

                    @elseif($postulacion->estado === 'en_revision')

                        <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-bold text-blue-400">
                            En revisión
                        </span>

                    @elseif($postulacion->estado === 'entrevista')

                        <span class="rounded-full bg-purple-500/10 px-3 py-1 text-xs font-bold text-purple-400">
                            Entrevista
                        </span>

                    @elseif($postulacion->estado === 'seleccionado')

                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-400">
                            Seleccionado
                        </span>

                    @elseif($postulacion->estado === 'descartado')

                        <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                            Descartado
                        </span>

                    @endif

                </div>


                @if($profesional->especialidad)

                    <p class="mt-2 text-lg font-bold text-horeca-dorado">
                        {{ $profesional->especialidad }}
                    </p>

                @endif


                @if($profesional->subespecialidad)

                    <p class="mt-1 text-sm text-white/50">
                        {{ $profesional->subespecialidad }}
                    </p>

                @endif


                <div class="mt-5 flex flex-wrap gap-2">

                    @if($profesional->experiencia)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            💼 {{ $profesional->experiencia }}
                        </span>

                    @endif


                    @if($profesional->modalidad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            📍 {{ $profesional->modalidad }}
                        </span>

                    @endif


                    @if($profesional->ciudad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            🗺️ {{ $profesional->ciudad }}
                        </span>

                    @endif


                    @if($profesional->distrito)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            📌 {{ $profesional->distrito }}
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         CONTENIDO
    =========================================== --}}

    <div class="grid gap-6 lg:grid-cols-[1fr_340px]">


        {{-- ======================================
             COLUMNA PRINCIPAL
        ======================================= --}}

        <div class="space-y-6">


            {{-- DESCRIPCIÓN PROFESIONAL --}}

            @if($profesional->descripcion)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="text-lg font-black text-white">
                        Sobre el profesional
                    </h2>

                    <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">
                        {{ $profesional->descripcion }}
                    </p>

                </div>

            @endif


            {{-- HABILIDADES --}}

            @if($profesional->habilidades)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="text-lg font-black text-white">
                        Habilidades
                    </h2>

                    <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">
                        {{ $profesional->habilidades }}
                    </p>

                </div>

            @endif


            {{-- VIDEO DE PRESENTACIÓN --}}

            @if($profesional->video_presentacion)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="text-lg font-black text-white">
                        Video de presentación
                    </h2>

                    <div class="mt-4 overflow-hidden rounded-2xl border border-white/10 bg-black">

                        <video
                            controls
                            preload="metadata"
                            class="aspect-video w-full"
                        >

                            <source
                                src="{{ asset('storage/' . $profesional->video_presentacion) }}"
                                type="video/mp4"
                            >

                            Tu navegador no soporta la reproducción de video.

                        </video>

                    </div>

                </div>

            @endif


            {{-- MENSAJE DE POSTULACIÓN --}}

            @if($postulacion->mensaje)

                <div class="rounded-2xl border border-horeca-dorado/20 bg-horeca-dorado/[0.04] p-6">

                    <h2 class="text-lg font-black text-horeca-dorado">
                        Mensaje de postulación
                    </h2>

                    <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/70">
                        {{ $postulacion->mensaje }}
                    </p>

                </div>

            @endif

        </div>


        {{-- ======================================
             COLUMNA DERECHA
        ======================================= --}}

        <div class="space-y-6">


            {{-- OPORTUNIDAD --}}

            <div class="rounded-2xl border border-horeca-dorado/20 bg-[#111A29] p-6">

                <p class="text-[11px] font-black uppercase tracking-[0.15em] text-horeca-dorado">
                    Se postuló a
                </p>

                @if($oportunidad)

                    <a
                        href="{{ route('empresa.oportunidades.postulaciones', $oportunidad) }}"
                        class="mt-2 block text-lg font-black text-white transition hover:text-horeca-dorado"
                    >
                        {{ $oportunidad->titulo }}
                    </a>

                    @if($oportunidad->area)

                        <p class="mt-1 text-sm text-white/50">
                            {{ $oportunidad->area }}
                        </p>

                    @endif

                @endif

            </div>


            {{-- DATOS DE CONTACTO --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">
                    Información
                </h2>

                <div class="mt-5 space-y-4 text-sm">


                    @if($profesional->celular)

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                                Celular
                            </p>

                            <p class="mt-1 font-bold text-white">
                                {{ $profesional->celular }}
                            </p>

                        </div>

                    @endif


                    @if($profesional->ciudad)

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                                Ciudad
                            </p>

                            <p class="mt-1 font-bold text-white">
                                {{ $profesional->ciudad }}
                            </p>

                        </div>

                    @endif


                    @if($profesional->distrito)

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                                Distrito
                            </p>

                            <p class="mt-1 font-bold text-white">
                                {{ $profesional->distrito }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- CV --}}

            @if($profesional->cv)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <h2 class="text-lg font-black text-white">
                        Currículum
                    </h2>

                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-4 flex w-full items-center justify-center rounded-xl bg-horeca-dorado px-4 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90"
                    >
                        📄 Ver CV
                    </a>

                </div>

            @endif


            {{-- FECHA DE POSTULACIÓN --}}

            @if($postulacion->fecha_postulacion)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                        Fecha de postulación
                    </p>

                    <p class="mt-2 font-bold text-white">
                        {{ $postulacion->fecha_postulacion->format('d/m/Y') }}
                    </p>

                    <p class="mt-1 text-sm text-white/40">
                        {{ $postulacion->fecha_postulacion->format('H:i') }}
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- ==========================================
         OBSERVACIONES DE LA EMPRESA
    =========================================== --}}

    @if($postulacion->observaciones)

        <div class="rounded-2xl border border-blue-400/10 bg-blue-400/[0.03] p-6">

            <h2 class="text-lg font-black text-blue-400">
                Observaciones de la empresa
            </h2>

            <p class="mt-3 whitespace-pre-line text-sm leading-7 text-white/70">
                {{ $postulacion->observaciones }}
            </p>

        </div>

    @endif

</div>

@endsection