@extends('layouts.dashboard')

@section('title', 'Postulaciones')

@section('header-title', 'Postulaciones')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

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


    {{-- ERRORES --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4">

            <p class="text-sm font-black text-red-400">
                Revisa los siguientes errores:
            </p>

            <ul class="mt-2 space-y-1 text-xs text-red-300">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- VOLVER --}}

    <a
        href="{{ route('empresa.postulaciones.index') }}"
        class="inline-flex items-center gap-2 text-sm font-bold text-white/70 transition hover:text-white"
    >
        ← Volver a mis oportunidades
    </a>


    {{-- CABECERA DE LA OPORTUNIDAD --}}

    <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-8">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <div class="min-w-0">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-xl font-black text-horeca-dorado">

                        {{ strtoupper(
                            substr(
                                $empresa->nombre_comercial
                                ?? $empresa->razon_social
                                ?? 'E',
                                0,
                                1
                            )
                        ) }}

                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-sm font-bold text-white/70">
                            {{ $empresa->nombre_comercial
                                ?? $empresa->razon_social
                                ?? 'Empresa' }}
                        </p>

                        @if($oportunidad->area)

                            <p class="mt-1 text-xs font-black uppercase tracking-wider text-horeca-dorado">
                                {{ $oportunidad->area }}
                            </p>

                        @endif

                    </div>

                </div>


                <h1 class="mt-6 text-3xl font-black leading-tight text-white">
                    {{ $oportunidad->titulo }}
                </h1>


                <div class="mt-4 flex flex-wrap gap-2">

                    @if($oportunidad->modalidad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/70">
                            📍 {{ $oportunidad->modalidad }}
                        </span>

                    @endif

                    @if($oportunidad->ubicacion)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/70">
                            🗺️ {{ $oportunidad->ubicacion }}
                        </span>

                    @endif

                    @if($oportunidad->tipo_contrato)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/70">
                            💼 {{ $oportunidad->tipo_contrato }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- CONTADOR --}}

            <div class="shrink-0 rounded-2xl border border-horeca-dorado/20 bg-horeca-dorado/[0.05] px-6 py-5 text-center">

                <p class="text-3xl font-black text-horeca-dorado">
                    {{ $postulaciones->total() }}
                </p>

                <p class="mt-1 text-xs font-bold text-white/40">
                    {{ $postulaciones->total() === 1 ? 'Postulación' : 'Postulaciones' }}
                </p>

            </div>

        </div>

    </div>


    {{-- FILTROS / RESUMEN --}}

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

        @php

            $estadosResumen = [
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


        @foreach($estadosResumen as $estado => $info)

            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-4">

                <p class="text-xs font-bold text-white/30">
                    {{ $info['label'] }}
                </p>

                <p class="mt-2 text-xl font-black {{ $info['clase'] }}">

                    {{ $oportunidad->postulaciones()
                        ->where('estado', $estado)
                        ->count() }}

                </p>

            </div>

        @endforeach

    </div>


    {{-- LISTADO --}}

    @if($postulaciones->count())

        <div class="space-y-5">

            @foreach($postulaciones as $postulacion)

                @php

                    $profesional = $postulacion->profesional;

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

                    $estadoInfo = $estados[$postulacion->estado] ?? [
                        'texto' => ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $postulacion->estado
                            )
                        ),
                        'clase' => 'border-white/10 bg-white/5 text-white/70',
                        'icono' => '•',
                    ];

                @endphp


                {{-- TARJETA DEL PROFESIONAL --}}

                <article class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">

                    <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">


                        {{-- PERFIL --}}

                        <div class="min-w-0 flex-1">

                            <div class="flex items-start gap-4">

                                {{-- FOTO / INICIAL --}}

                                <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-horeca-dorado/10 text-lg font-black text-horeca-dorado">

                                    @if($profesional?->foto)

                                        <img
                                            src="{{ asset('storage/' . $profesional->foto) }}"
                                            alt="{{ $profesional->nombres }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        {{ strtoupper(
                                            substr(
                                                $profesional?->nombres
                                                ?? 'P',
                                                0,
                                                1
                                            )
                                        ) }}

                                    @endif

                                </div>


                                <div class="min-w-0">

                                    <h2 class="text-xl font-black text-white">

                                        {{ $profesional?->nombres }}
                                        {{ $profesional?->apellidos }}

                                    </h2>


                                    @if($profesional?->especialidad)

                                        <p class="mt-1 text-sm font-bold text-horeca-dorado">
                                            {{ $profesional->especialidad }}
                                        </p>

                                    @endif


                                    @if($profesional?->subespecialidad)

                                        <p class="mt-1 text-xs text-white/40">
                                            {{ $profesional->subespecialidad }}
                                        </p>

                                    @endif

                                </div>

                            </div>


                            {{-- INFORMACIÓN PROFESIONAL --}}

                            <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">

                                @if($profesional?->experiencia)

                                    <div class="rounded-xl bg-white/[0.03] p-3">

                                        <p class="text-[11px] font-bold uppercase tracking-wider text-white/25">
                                            Experiencia
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-white/70">
                                            {{ $profesional->experiencia }}
                                        </p>

                                    </div>

                                @endif


                                @if($profesional?->modalidad)

                                    <div class="rounded-xl bg-white/[0.03] p-3">

                                        <p class="text-[11px] font-bold uppercase tracking-wider text-white/25">
                                            Modalidad
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-white/70">
                                            {{ $profesional->modalidad }}
                                        </p>

                                    </div>

                                @endif


                                @if($profesional?->ciudad)

                                    <div class="rounded-xl bg-white/[0.03] p-3">

                                        <p class="text-[11px] font-bold uppercase tracking-wider text-white/25">
                                            Ciudad
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-white/70">
                                            {{ $profesional->ciudad }}
                                        </p>

                                    </div>

                                @endif


                                @if($profesional?->distrito)

                                    <div class="rounded-xl bg-white/[0.03] p-3">

                                        <p class="text-[11px] font-bold uppercase tracking-wider text-white/25">
                                            Distrito
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-white/70">
                                            {{ $profesional->distrito }}
                                        </p>

                                    </div>

                                @endif

                            </div>


                            {{-- DESCRIPCIÓN --}}

                            @if($profesional?->descripcion)

                                <div class="mt-5">

                                    <p class="text-xs font-black uppercase tracking-wider text-white/30">
                                        Perfil profesional
                                    </p>

                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-white/70">
                                        {{ $profesional->descripcion }}
                                    </p>

                                </div>

                            @endif


                            {{-- MENSAJE --}}

                            @if($postulacion->mensaje)

                                <div class="mt-5 rounded-xl border border-horeca-dorado/10 bg-horeca-dorado/[0.03] p-4">

                                    <p class="text-xs font-black uppercase tracking-wider text-horeca-dorado">
                                        Mensaje del profesional
                                    </p>

                                    <p class="mt-2 whitespace-pre-line text-sm leading-6 text-white/60">
                                        {{ $postulacion->mensaje }}
                                    </p>

                                </div>

                            @endif


                            {{-- FECHA --}}

                            @if($postulacion->fecha_postulacion)

                                <p class="mt-5 text-xs text-white/30">

                                    📅 Postulación recibida el

                                    <span class="font-bold text-white/70">
                                        {{ $postulacion->fecha_postulacion->format('d/m/Y') }}
                                    </span>

                                    a las

                                    <span class="font-bold text-white/70">
                                        {{ $postulacion->fecha_postulacion->format('H:i') }}
                                    </span>

                                </p>

                            @endif

                        </div>


                        {{-- PANEL DERECHO --}}

                        <div class="w-full shrink-0 xl:w-64">


                            {{-- ESTADO ACTUAL --}}

                            <div
                                class="rounded-xl border px-4 py-4 text-center {{ $estadoInfo['clase'] }}"
                            >

                                <div class="text-lg">
                                    {{ $estadoInfo['icono'] }}
                                </div>

                                <p class="mt-1 text-xs font-black">
                                    {{ $estadoInfo['texto'] }}
                                </p>

                            </div>


                            {{-- CAMBIAR ESTADO --}}

                            <form
                                method="POST"
                                action="{{ route('empresa.postulaciones.estado', $postulacion) }}"
                                class="mt-4 space-y-3"
                            >

                                @csrf
                                @method('PATCH')


                                <div>

                                    <label
                                        for="estado_{{ $postulacion->id }}"
                                        class="mb-2 block text-xs font-bold text-white/40"
                                    >
                                        Cambiar estado
                                    </label>

                                    <select
                                        id="estado_{{ $postulacion->id }}"
                                        name="estado"
                                        class="w-full rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-sm font-bold text-white outline-none focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                                    >

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


                                <div>

                                    <label
                                        for="observaciones_{{ $postulacion->id }}"
                                        class="mb-2 block text-xs font-bold text-white/40"
                                    >
                                        Observaciones
                                    </label>

                                    <textarea
                                        id="observaciones_{{ $postulacion->id }}"
                                        name="observaciones"
                                        rows="4"
                                        maxlength="3000"
                                        placeholder="Agrega una observación..."
                                        class="w-full resize-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-xs leading-5 text-white outline-none placeholder:text-white/20 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                                    >{{ $postulacion->observaciones }}</textarea>

                                </div>


                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-horeca-dorado px-4 py-3 text-xs font-black text-[#07111F] transition hover:opacity-90"
                                >
                                    Guardar cambios
                                </button>

                            </form>


                            {{-- CV --}}

                            @if($profesional?->cv)

                                <a
                                    href="{{ asset('storage/' . $profesional->cv) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-3 flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-xs font-black text-white transition hover:bg-white/[0.07]"
                                >
                                    📄 Ver CV
                                </a>

                            @endif

                        </div>

                    </div>

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

        {{-- SIN POSTULACIONES --}}

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-16 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 text-3xl">
                👥
            </div>

            <h2 class="mt-5 text-xl font-black text-white">
                Aún no hay postulaciones
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-white/40">
                Los profesionales que se postulen a esta oportunidad
                aparecerán aquí.
            </p>

        </div>

    @endif

</div>

@endsection