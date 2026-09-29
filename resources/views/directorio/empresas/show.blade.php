@extends('layouts.dashboard')

@section('title', $empresa->nombre_comercial ?: $empresa->razon_social)

@section('header-title', 'Perfil de empresa')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- ==========================================
         VOLVER
    =========================================== --}}

    <div>

        <a
            href="{{ route('directorio.empresas.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-white/50 transition hover:text-horeca-dorado">
            ← Volver al Directorio PRO
        </a>

    </div>


    {{-- ==========================================
         CABECERA
    =========================================== --}}

    <div class="overflow-hidden rounded-3xl border border-horeca-dorado/20 bg-[#111A29]">

        <div class="h-2 bg-horeca-dorado"></div>

        <div class="p-6 md:p-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">


                {{-- EMPRESA --}}

                <div class="flex min-w-0 items-start gap-5">

                    {{-- LOGO / AVATAR --}}

                    <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-3xl bg-horeca-dorado/10 text-3xl font-black text-horeca-dorado">

                        {{ strtoupper(
                            substr(
                                $empresa->nombre_comercial
                                    ?: $empresa->razon_social
                                    ?: 'E',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    {{-- DATOS --}}

                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-3xl font-black text-white">

                                {{ $empresa->nombre_comercial ?: $empresa->razon_social }}

                            </h1>


                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-black text-emerald-400">

                                ✓ Empresa validada

                            </span>

                        </div>


                        @if(
                        $empresa->nombre_comercial &&
                        $empresa->razon_social &&
                        $empresa->nombre_comercial !== $empresa->razon_social
                        )

                        <p class="mt-2 text-sm text-white/40">

                            {{ $empresa->razon_social }}

                        </p>

                        @endif


                        @if($empresa->tipo_empresa)

                        <p class="mt-3 text-base font-bold text-horeca-dorado">

                            {{ $empresa->tipo_empresa }}

                        </p>

                        @endif


                        <div class="mt-4 flex flex-wrap gap-2">

                            @if($empresa->ciudad)

                            <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/60">

                                📍 {{ $empresa->ciudad }}

                            </span>

                            @endif


                            @if($empresa->distrito)

                            <span class="rounded-lg bg-white/5 px-3 py-2 text-sm font-bold text-white/60">

                                📌 {{ $empresa->distrito }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- SITIO WEB --}}

                @if($empresa->sitio_web)

                @php

                $sitioWeb = $empresa->sitio_web;

                if (!preg_match('/^https?:\/\//i', $sitioWeb)) {
                $sitioWeb = 'https://' . $sitioWeb;
                }

                @endphp

                <a
                    href="{{ $sitioWeb }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex shrink-0 items-center justify-center rounded-xl border border-horeca-dorado/30 px-5 py-3 text-sm font-black text-horeca-dorado transition hover:bg-horeca-dorado hover:text-[#07111F]">
                    🌐 Sitio web
                </a>

                @endif

            </div>

        </div>

    </div>
    {{-- ==========================================
     VIDEO DE PRESENTACIÓN
=========================================== --}}

    @if($empresa->video_presentacion)

    <div class="overflow-hidden rounded-3xl border border-white/10 bg-[#111A29]">

        <div class="border-b border-white/10 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-lg">
                    🎥
                </div>

                <div>
                    <h2 class="text-lg font-black text-white">
                        Video de presentación
                    </h2>

                    <p class="mt-1 text-sm text-white/40">
                        Conoce más sobre esta empresa.
                    </p>
                </div>

            </div>

        </div>

        <div class="bg-black">

            <video
                controls
                preload="metadata"
                playsinline
                class="aspect-video w-full object-contain">

                <source
                    src="{{ asset('storage/' . $empresa->video_presentacion) }}"
                    type="video/mp4">

                Tu navegador no soporta la reproducción de video.

            </video>

        </div>

    </div>

    @endif

    {{-- ==========================================
         CONTENIDO
    =========================================== --}}

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">


        {{-- ======================================
             COLUMNA PRINCIPAL
        ======================================= --}}

        <div class="space-y-6">


            {{-- DESCRIPCIÓN --}}

            @if($empresa->descripcion)

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-xl font-black text-white">

                    Sobre la empresa

                </h2>

                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">

                    {{ $empresa->descripcion }}

                </p>

            </div>

            @endif


            {{-- PERFILES QUE BUSCA --}}

            @if($empresa->perfiles_busca)

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-xl font-black text-white">

                    Perfiles que busca

                </h2>

                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">

                    {{ $empresa->perfiles_busca }}

                </p>

            </div>

            @endif


            {{-- OPORTUNIDADES --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-xl font-black text-white">

                            Oportunidades laborales

                        </h2>

                        <p class="mt-1 text-sm text-white/40">

                            Puestos publicados actualmente por esta empresa.

                        </p>

                    </div>


                    <span class="rounded-full bg-horeca-dorado/10 px-4 py-2 text-sm font-black text-horeca-dorado">

                        {{ $empresa->oportunidades->count() }}

                        {{ $empresa->oportunidades->count() === 1 ? 'oportunidad' : 'oportunidades' }}

                    </span>

                </div>


                @if($empresa->oportunidades->count())

                <div class="mt-6 space-y-4">

                    @foreach($empresa->oportunidades as $oportunidad)

                    <div
                        class="rounded-2xl border border-white/10 bg-white/[0.02] p-5 transition hover:border-horeca-dorado/30">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">


                            {{-- DATOS --}}

                            <div class="min-w-0">

                                <h3 class="text-lg font-black text-white">

                                    {{ $oportunidad->titulo }}

                                </h3>


                                @if($oportunidad->area)

                                <p class="mt-1 text-sm font-bold text-horeca-dorado">

                                    {{ $oportunidad->area }}

                                </p>

                                @endif


                                <div class="mt-3 flex flex-wrap gap-2">

                                    @if($oportunidad->tipo_contrato)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">

                                        📄 {{ $oportunidad->tipo_contrato }}

                                    </span>

                                    @endif


                                    @if($oportunidad->modalidad)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">

                                        💼 {{ $oportunidad->modalidad }}

                                    </span>

                                    @endif


                                    @if($oportunidad->ubicacion)

                                    <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">

                                        📍 {{ $oportunidad->ubicacion }}

                                    </span>

                                    @endif

                                </div>


                                @if($oportunidad->descripcion)

                                <p class="mt-4 line-clamp-3 text-sm leading-6 text-white/40">

                                    {{ $oportunidad->descripcion }}

                                </p>

                                @endif

                            </div>


                            {{-- BOTÓN --}}

                            <div class="shrink-0">

                                <a
                                    href="{{ auth()->user()->rol=='profesional'? route('profesional.oportunidades.show', $oportunidad):route('oportunidades.show', $oportunidad)}}"
                                    class="inline-flex items-center justify-center rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90">
                                    Ver oportunidad →
                                </a>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="mt-6 rounded-2xl border border-dashed border-white/10 p-10 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-2xl">

                        💼

                    </div>

                    <p class="mt-4 font-black text-white">

                        No hay oportunidades publicadas

                    </p>

                    <p class="mt-1 text-sm text-white/40">

                        Actualmente esta empresa no tiene puestos disponibles.

                    </p>

                </div>

                @endif

            </div>

        </div>


        {{-- ======================================
             COLUMNA DERECHA
        ======================================= --}}

        <div class="space-y-6">


            {{-- INFORMACIÓN DE EMPRESA --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">

                    Información de la empresa

                </h2>


                <div class="mt-5 space-y-5">


                    @if($empresa->tipo_empresa)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Tipo de empresa

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->tipo_empresa }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->ruc)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            RUC

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->ruc }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->ciudad)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Ciudad

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->ciudad }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->distrito)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Distrito

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->distrito }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->direccion)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Dirección

                        </p>

                        <p class="mt-1 text-sm leading-6 font-bold text-white">

                            {{ $empresa->direccion }}

                        </p>

                    </div>

                    @endif

                </div>

            </div>


            {{-- CONTACTO --}}

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">

                    Contacto

                </h2>


                <div class="mt-5 space-y-4">


                    @if($empresa->contacto_nombres || $empresa->contacto_apellidos)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Contacto

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ trim(
                                    ($empresa->contacto_nombres ?? '') . ' ' .
                                    ($empresa->contacto_apellidos ?? '')
                                ) }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->cargo)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Cargo

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->cargo }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->celular)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Celular

                        </p>

                        <p class="mt-1 text-sm font-bold text-white">

                            {{ $empresa->celular }}

                        </p>

                    </div>

                    @endif


                    @if($empresa->email)

                    <div>

                        <p class="text-[11px] font-black uppercase tracking-wider text-white/30">

                            Email

                        </p>

                        <p class="mt-1 break-all text-sm font-bold text-white">

                            {{ $empresa->email }}

                        </p>

                    </div>

                    @endif

                </div>

            </div>


            {{-- REDES --}}

            @if($empresa->red_social)

            @php

            $redSocial = $empresa->red_social;

            if (!preg_match('/^https?:\/\//i', $redSocial)) {
            $redSocial = 'https://' . $redSocial;
            }

            @endphp

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">

                    Redes sociales

                </h2>

                <a
                    href="{{ $redSocial }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-4 flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm font-black text-white transition hover:bg-white/[0.07]">
                    🔗 Ver redes sociales
                </a>

            </div>

            @endif


            {{-- RESUMEN --}}

            <div class="rounded-2xl border border-horeca-dorado/20 bg-horeca-dorado/[0.04] p-6">

                <p class="text-[11px] font-black uppercase tracking-[0.15em] text-horeca-dorado">

                    HORECA PRO

                </p>

                <p class="mt-2 text-lg font-black text-white">

                    {{ $empresa->oportunidades->count() }}

                    {{ $empresa->oportunidades->count() === 1
                        ? 'oportunidad publicada'
                        : 'oportunidades publicadas'
                    }}

                </p>

                <p class="mt-2 text-sm leading-6 text-white/40">

                    Conoce las oportunidades disponibles y postúlate directamente.

                </p>

            </div>

        </div>

    </div>

</div>

@endsection