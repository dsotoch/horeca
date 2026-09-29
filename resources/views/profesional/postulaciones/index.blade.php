@extends('layouts.dashboard')

@section('title', 'Mis postulaciones')

@section('header-title', 'Mis postulaciones')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">


{{-- CABECERA --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

    <div>
        <p class="text-sm font-black uppercase tracking-[0.2em] text-horeca-dorado">
            HORECA PRO
        </p>

        <h1 class="mt-1 text-2xl font-black text-white">
            Mis postulaciones
        </h1>

        <p class="mt-2 text-sm text-white/80">
            Consulta las oportunidades a las que te has postulado y revisa el estado de cada proceso.
        </p>
    </div>

    <a
        href="{{ route('profesional.oportunidades.index') }}"
        class="inline-flex items-center justify-center rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90"
    >
        + Buscar oportunidades
    </a>

</div>


{{-- MENSAJES --}}
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


{{-- CONTADOR --}}
@if($postulaciones->total() > 0)

    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-4">

        <div>
            <p class="text-sm font-bold text-white">
                {{ $postulaciones->total() }}
                {{ $postulaciones->total() === 1 ? 'postulación' : 'postulaciones' }}
            </p>

            <p class="mt-1 text-sm text-white/80">
                Estas son tus postulaciones registradas.
            </p>
        </div>

        <div class="hidden sm:block text-2xl">
            📄
        </div>

    </div>

@endif


{{-- LISTADO --}}
@if($postulaciones->count())

    <div class="grid gap-5">

        @foreach($postulaciones as $postulacion)

            @php

                $oportunidad = $postulacion->oportunidad;
                $empresa = $oportunidad?->empresa;

                $estado = $postulacion->estado;

                $estados = [

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

                ];

                $estadoInfo = $estados[$estado] ?? [
                    'texto' => ucfirst(str_replace('_', ' ', $estado)),
                    'clase' => 'border-white/10 bg-white/5 text-white/70',
                    'icono' => '•',
                ];

            @endphp


            {{-- POSTULACIÓN --}}
            <article
                class="rounded-3xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-white/20 md:p-6"
            >

                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                    {{-- INFORMACIÓN --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex items-start gap-4">

                            {{-- ICONO EMPRESA --}}
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-lg font-black text-horeca-dorado">

                                {{ strtoupper(
                                    substr(
                                        $empresa?->nombre_comercial
                                        ?? $empresa?->razon_social
                                        ?? 'E',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div class="min-w-0">

                                {{-- EMPRESA --}}
                                <p class="truncate text-sm font-bold text-white/70">
                                    {{ $empresa?->nombre_comercial
                                        ?? $empresa?->razon_social
                                        ?? 'Empresa' }}
                                </p>


                                {{-- TITULO --}}
                                <h2 class="mt-1 text-xl font-black leading-tight text-white">
                                    {{ $oportunidad?->titulo ?? 'Oportunidad no disponible' }}
                                </h2>


                                {{-- ÁREA --}}
                                @if($oportunidad?->area)

                                    <p class="mt-2 text-sm font-black uppercase tracking-wider text-horeca-dorado">
                                        {{ $oportunidad->area }}
                                    </p>

                                @endif

                            </div>

                        </div>


                        {{-- DATOS --}}
                        @if($oportunidad)

                            <div class="mt-5 flex flex-wrap gap-2">

                                @if($oportunidad->modalidad)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                                        📍 {{ $oportunidad->modalidad }}
                                    </span>

                                @endif


                                @if($oportunidad->ubicacion)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                                        🗺️ {{ $oportunidad->ubicacion }}
                                    </span>

                                @endif


                                @if($oportunidad->tipo_contrato)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/70">
                                        💼 {{ $oportunidad->tipo_contrato }}
                                    </span>

                                @endif

                            </div>

                        @endif


                        {{-- MENSAJE --}}
                        @if($postulacion->mensaje)

                            <div class="mt-5 rounded-xl border border-white/10 bg-white/[0.02] p-4">

                                <p class="text-sm font-black uppercase tracking-wider text-white/80">
                                    Mensaje enviado
                                </p>

                                <p class="mt-2 whitespace-pre-line text-sm leading-6 text-white/70">
                                    {{ $postulacion->mensaje }}
                                </p>

                            </div>

                        @endif


                        {{-- FECHA --}}
                        <div class="mt-5 flex flex-wrap gap-x-5 gap-y-2 text-sm text-white/80">

                            @if($postulacion->fecha_postulacion)

                                <span>
                                    📅 Postulado el
                                    <span class="font-bold text-white/70">
                                        {{ $postulacion->fecha_postulacion->format('d/m/Y') }}
                                    </span>
                                </span>

                                <span>
                                    🕐
                                    <span class="font-bold text-white/70">
                                        {{ $postulacion->fecha_postulacion->format('H:i') }}
                                    </span>
                                </span>

                            @else

                                <span>
                                    📅 Fecha de postulación no disponible
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ESTADO + ACCIONES --}}
                    <div class="flex shrink-0 flex-col gap-3 lg:w-44">

                        {{-- ESTADO --}}
                        <div
                            class="rounded-xl border px-4 py-3 text-center {{ $estadoInfo['clase'] }}"
                        >

                            <div class="text-base">
                                {{ $estadoInfo['icono'] }}
                            </div>

                            <p class="mt-1 text-sm font-black">
                                {{ $estadoInfo['texto'] }}
                            </p>

                        </div>


                        {{-- VER OPORTUNIDAD --}}
                        @if($oportunidad)

                            <a
                                href="{{ route('profesional.oportunidades.show', $oportunidad) }}"
                                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm font-black text-white transition hover:bg-white/[0.07]"
                            >
                                Ver oportunidad →
                            </a>

                        @endif

                    </div>

                </div>


                {{-- OBSERVACIONES DE LA EMPRESA --}}
                @if($postulacion->observaciones)

                    <div class="mt-5 border-t border-white/10 pt-5">

                        <div class="rounded-xl border border-blue-400/10 bg-blue-400/[0.03] p-4">

                            <p class="text-sm font-black uppercase tracking-wider text-blue-400">
                                Observaciones de la empresa
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

    {{-- ESTADO VACÍO --}}
    <div class="rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-16 text-center">

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-3xl">
            📄
        </div>

        <h2 class="mt-5 text-xl font-black text-white">
            Aún no tienes postulaciones
        </h2>

        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-white/80">
            Explora las oportunidades disponibles para profesionales
            y encuentra una propuesta que se adapte a tu perfil.
        </p>

        <a
            href="{{ route('profesional.oportunidades.index') }}"
            class="mt-6 inline-flex items-center justify-center rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90"
        >
            Explorar oportunidades
        </a>

    </div>

@endif


</div>

@endsection
