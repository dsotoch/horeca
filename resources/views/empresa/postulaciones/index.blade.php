@extends('layouts.dashboard')

@section('title', 'Todas las postulaciones')

@section('header-title', 'Postulaciones')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- ==========================================
         CABECERA
    =========================================== --}}

    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

        <div>

            <p class="text-sm font-black uppercase tracking-[0.2em] text-horeca-dorado">
                HORECA PRO
            </p>

            <h1 class="mt-1 text-2xl font-black text-white">
                Todas las postulaciones
            </h1>

            <p class="mt-2 text-sm text-white/40">
                Revisa los profesionales que se han postulado
                a tus oportunidades.
            </p>

        </div>


        <a
            href="{{ route('empresa.postulaciones.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-5 py-3 text-sm font-black text-white transition hover:bg-white/[0.07]">
            ← Mis oportunidades
        </a>

    </div>


    {{-- ==========================================
         MENSAJES
    =========================================== --}}

    @if(session('success'))

    <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm font-bold text-emerald-400">
        ✓ {{ session('success') }}
    </div>

    @endif


    @if(session('error'))

    <div class="rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4 text-sm font-bold text-red-400">
        ⚠ {{ session('error') }}
    </div>

    @endif


    {{-- ==========================================
         RESUMEN
    =========================================== --}}

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

        <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5">

            <p class="text-sm font-bold text-white/80">
                Total
            </p>

            <p class="mt-2 text-2xl font-black text-white">
                {{ $postulaciones->total() }}
            </p>

        </div>


        @php

        $estados = [
        'pendiente' => [
        'label' => 'Pendientes',
        'clase' => 'text-amber-400',
        ],

        'en_revision' => [
        'label' => 'En revisión',
        'clase' => 'text-blue-400',
        ],

        'entrevista' => [
        'label' => 'Entrevistas',
        'clase' => 'text-purple-400',
        ],

        'seleccionado' => [
        'label' => 'Seleccionados',
        'clase' => 'text-emerald-400',
        ],

        'descartado' => [
        'label' => 'Descartados',
        'clase' => 'text-red-400',
        ],
        ];

        @endphp


        @foreach($estados as $estado => $info)

        @php

        $cantidadEstado = \App\Models\Postulacion::query()
        ->where('estado', $estado)
        ->whereHas('oportunidad', function ($query) use ($empresa) {
        $query->where('empresa_id', $empresa->id);
        })
        ->count();

        @endphp

        <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-5">

            <p class="text-sm font-bold text-white/80">
                {{ $info['label'] }}
            </p>

            <p class="mt-2 text-2xl font-black {{ $info['clase'] }}">
                {{ $cantidadEstado }}
            </p>

        </div>

        @endforeach

    </div>


    {{-- ==========================================
         LISTADO
    =========================================== --}}

    @if($postulaciones->count())

    <div class="space-y-5">

        @foreach($postulaciones as $postulacion)

        @php

        $profesional = $postulacion->profesional;
        $oportunidad = $postulacion->oportunidad;

        $estadoInfo = match($postulacion->estado) {

        'pendiente' => [
        'texto' => 'Pendiente',
        'clase' => 'border-amber-400/20 bg-amber-400/10 text-amber-400',
        'icono' => '⏳',
        ],

        'en_revision' => [
        'texto' => 'En revisión',
        'clase' => 'border-blue-400/20 bg-blue-400/10 text-blue-400',
        'icono' => '🔎',
        ],

        'entrevista' => [
        'texto' => 'Entrevista',
        'clase' => 'border-purple-400/20 bg-purple-400/10 text-purple-400',
        'icono' => '📅',
        ],

        'seleccionado' => [
        'texto' => 'Seleccionado',
        'clase' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-400',
        'icono' => '✓',
        ],

        'descartado' => [
        'texto' => 'Descartado',
        'clase' => 'border-red-400/20 bg-red-400/10 text-red-400',
        'icono' => '✕',
        ],

        default => [
        'texto' => ucfirst(
        str_replace(
        '_',
        ' ',
        $postulacion->estado
        )
        ),
        'clase' => 'border-white/10 bg-white/5 text-white/70',
        'icono' => '•',
        ],
        };

        @endphp


        {{-- ==========================================
                     TARJETA
                =========================================== --}}

        <article
            class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 transition hover:border-white/20">

            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">


                {{-- ==================================
                             PROFESIONAL
                        =================================== --}}

                <div class="min-w-0 flex-1">

                    <div class="flex items-start gap-4">

                        {{-- AVATAR --}}

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-lg font-black text-horeca-dorado">

                            {{ strtoupper(
                                        substr(
                                            trim(
                                                ($profesional?->nombres ?? '')
                                                . ' '
                                                . ($profesional?->apellidos ?? '')
                                            ),
                                            0,
                                            1
                                        )
                                    ) }}

                        </div>


                        {{-- NOMBRE --}}

                        <div class="min-w-0">

                            <h2 class="text-xl font-black text-white">

                                {{ $profesional?->nombres ?? 'Profesional' }}

                                {{ $profesional?->apellidos ?? '' }}

                            </h2>


                            @if($profesional?->especialidad)

                            <p class="mt-1 text-sm font-bold text-horeca-dorado">
                                {{ $profesional->especialidad }}
                            </p>

                            @endif


                            @if($profesional?->subespecialidad)

                            <p class="mt-1 text-sm text-white/40">
                                {{ $profesional->subespecialidad }}
                            </p>

                            @endif

                        </div>

                    </div>


                    {{-- ==================================
                                 OPORTUNIDAD
                            =================================== --}}

                    <div class="mt-5 rounded-2xl border border-white/10 bg-white/[0.02] p-4">

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/60">
                            Se postuló a
                        </p>

                        @if($oportunidad)

                        <a
                            href="{{ route('empresa.oportunidades.postulaciones', $oportunidad) }}"
                            class="mt-1 block text-base font-black text-white transition hover:text-horeca-dorado">
                            {{ $oportunidad->titulo }}
                        </a>

                        @if($oportunidad->area)

                        <p class="mt-1 text-sm text-white/40">
                            {{ $oportunidad->area }}
                        </p>

                        @endif

                        @else

                        <p class="mt-1 text-sm text-white/40">
                            Oportunidad no disponible
                        </p>

                        @endif

                    </div>


                    {{-- ==================================
     INFORMACIÓN DEL PROFESIONAL
=================================== --}}

                    <div class="mt-5 flex flex-wrap gap-2">

                        {{-- EDAD --}}

                      


                        {{-- EXPERIENCIA --}}

                        @if($profesional?->experiencia)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            💼 {{ $profesional->experiencia }}
                        </span>

                        @endif


                        {{-- MODALIDAD --}}

                        @if($profesional?->modalidad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            📍 {{ $profesional->modalidad }}
                        </span>

                        @endif


                        {{-- CIUDAD --}}

                        @if($profesional?->ciudad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                            🗺️ {{ $profesional->ciudad }}
                        </span>

                        @endif

                    </div>


                    {{-- ==================================
                                 MENSAJE
                            =================================== --}}

                    @if($postulacion->mensaje)

                    <div class="mt-5">

                        <p class="text-sm font-black uppercase tracking-wider text-white/80">
                            Mensaje del profesional
                        </p>

                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-white/70">
                            {{ $postulacion->mensaje }}
                        </p>

                    </div>

                    @endif


                    {{-- ==================================
                                 FECHA
                            =================================== --}}

                    @if($postulacion->fecha_postulacion)

                    <p class="mt-5 text-sm text-white/80">

                        📅 Postulado el

                        <span class="font-bold text-white/70">
                            {{ $postulacion->fecha_postulacion->format('d/m/Y') }}
                        </span>

                        a las

                        <span class="font-bold text-white/70">
                            {{ $postulacion->fecha_postulacion->format('H:i') }}
                        </span>

                    </p>

                    @endif
                    {{-- ==================================
     VIDEO DE PRESENTACIÓN
=================================== --}}

                    @if($profesional?->video_presentacion)

                    <div class="mt-6">

                        <p class="text-sm font-black uppercase tracking-wider text-white/80">
                            Video de presentación
                        </p>

                        <div class="mt-3 overflow-hidden rounded-2xl border border-white/10 bg-black">

                            <video
                                controls
                                preload="metadata"
                                class="aspect-video w-full">
                                <source
                                    src="{{ asset('storage/' . $profesional->video_presentacion) }}"
                                    type="video/mp4">

                                Tu navegador no soporta la reproducción de video.
                            </video>

                        </div>

                    </div>

                    @endif

                </div>


                {{-- ==================================
                             PANEL DERECHO
                        =================================== --}}

                <div class="w-full shrink-0 xl:w-64">

                    {{-- ESTADO --}}

                    <div
                        class="rounded-xl border px-4 py-4 text-center {{ $estadoInfo['clase'] }}">

                        <div class="text-lg">
                            {{ $estadoInfo['icono'] }}
                        </div>

                        <p class="mt-1 text-sm font-black">
                            {{ $estadoInfo['texto'] }}
                        </p>

                    </div>


                    {{-- CAMBIAR ESTADO --}}

                    <form
                        method="POST"
                        action="{{ route('empresa.postulaciones.estado', $postulacion) }}"
                        class="mt-4 space-y-3">

                        @csrf

                        @method('PATCH')


                        <div>

                            <label
                                for="estado_{{ $postulacion->id }}"
                                class="mb-2 block text-sm font-bold text-white/40">
                                Estado
                            </label>

                            <select
                                id="estado_{{ $postulacion->id }}"
                                name="estado"
                                class="w-full rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-sm font-bold text-white outline-none focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado">

                                <option
                                    value="pendiente"
                                    @selected($postulacion->estado === 'pendiente')
                                    >
                                    Pendiente
                                </option>

                                <option
                                    value="en_revision"
                                    @selected($postulacion->estado === 'en_revision')
                                    >
                                    En revisión
                                </option>

                                <option
                                    value="entrevista"
                                    @selected($postulacion->estado === 'entrevista')
                                    >
                                    Entrevista
                                </option>

                                <option
                                    value="seleccionado"
                                    @selected($postulacion->estado === 'seleccionado')
                                    >
                                    Seleccionado
                                </option>

                                <option
                                    value="descartado"
                                    @selected($postulacion->estado === 'descartado')
                                    >
                                    Descartado
                                </option>

                            </select>

                        </div>


                        {{-- OBSERVACIONES --}}

                        <div>

                            <label
                                for="observaciones_{{ $postulacion->id }}"
                                class="mb-2 block text-sm font-bold text-white/40">
                                Observaciones
                            </label>

                            <textarea
                                id="observaciones_{{ $postulacion->id }}"
                                name="observaciones"
                                rows="3"
                                maxlength="3000"
                                placeholder="Observaciones..."
                                class="w-full resize-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-sm leading-5 text-white outline-none placeholder:text-white/20 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado">{{ $postulacion->observaciones }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="w-full rounded-xl bg-horeca-dorado px-4 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90">
                            Guardar cambios
                        </button>

                    </form>


                    {{-- CV --}}

                    @if($profesional?->cv)

                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-3 flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm font-black text-white transition hover:bg-white/[0.07]">
                        📄 Ver CV
                    </a>

                    @endif

                </div>

            </div>


            {{-- OBSERVACIONES ACTUALES --}}

            @if($postulacion->observaciones)

            <div class="mt-6 border-t border-white/10 pt-5">

                <div class="rounded-xl border border-blue-400/10 bg-blue-400/[0.03] p-4">

                    <p class="text-sm font-black uppercase tracking-wider text-blue-400">
                        Observaciones registradas
                    </p>

                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-white/70">
                        {{ $postulacion->observaciones }}
                    </p>

                </div>

            </div>

            @endif

        </article>

        @endforeach

    </div>


    {{-- PAGINACIÓN --}}

    @if($postulaciones->hasPages())

    <div class="pt-2">
        {{ $postulaciones->links() }}
    </div>

    @endif


    @else

    {{-- ==========================================
             VACÍO
        =========================================== --}}

    <div class="rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-16 text-center">

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-3xl">
            👥
        </div>

        <h2 class="mt-5 text-xl font-black text-white">
            Aún no tienes postulaciones
        </h2>

        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-white/40">
            Cuando los profesionales se postulen a tus oportunidades,
            aparecerán aquí.
        </p>

        <a
            href="{{ route('empresa.postulaciones.index') }}"
            class="mt-6 inline-flex items-center justify-center rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90">
            Ver mis oportunidades
        </a>

    </div>

    @endif

</div>

@endsection