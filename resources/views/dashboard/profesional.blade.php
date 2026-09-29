@extends('layouts.dashboard')

@section('title', 'Panel Profesional')

@section('header-title', 'Panel principal')








@section('content')

<div class="w-full max-w-full overflow-hidden">


    {{-- ========================================================= --}}
    {{-- ENCABEZADO --}}
    {{-- ========================================================= --}}

    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <p class="text-xs font-bold uppercase tracking-[0.2em] text-horeca-dorado">
                Área profesional
            </p>

            <h1 class="mt-1 text-2xl font-black sm:text-3xl">
                Hola,
                {{ $profesional?->nombres ?? $usuario->name }}
            </h1>

            <p class="mt-1 text-sm text-white/40">
                Este es el resumen de tu actividad en CLUB HORECA PRO.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('perfil.profesional') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-xs font-bold text-white/70 transition hover:bg-white/5 hover:text-white">
                <i class="fa-solid fa-eye text-horeca-dorado"></i>
                Ver mi perfil
            </a>

            <a
                href="#"
                class="inline-flex items-center gap-2 rounded-xl bg-horeca-dorado px-4 py-3 text-xs font-black text-black transition hover:opacity-90">
                <i class="fa-solid fa-briefcase"></i>
                Buscar oportunidades
            </a>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- ALERTA PERFIL --}}
    {{-- ========================================================= --}}

    @if($porcentajePerfil < 100)

        <div
        class="mb-6 flex items-start gap-4 rounded-2xl border border-horeca-dorado/20 bg-horeca-dorado/5 p-4">

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
            <i class="fa-solid fa-circle-info"></i>
        </div>


        <div class="min-w-0">

            <p class="text-sm font-bold">
                Completa tu perfil profesional
            </p>

            <p class="mt-1 text-xs leading-5 text-white/50">
                Tu perfil está al {{ $porcentajePerfil }}%.
                Completarlo aumentará tus posibilidades
                de aparecer en búsquedas y recibir oportunidades.
            </p>

        </div>


        <a
            href="{{ route('perfil.profesional') }}"
            class="ml-auto hidden shrink-0 text-xs font-bold text-horeca-dorado sm:block">
            Completar →
        </a>

</div>

@endif



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    class="w-full rounded-2xl border border-horeca-dorado/30 bg-gradient-to-br from-[#26364D] to-[#172334] p-5 sm:rounded-[28px] sm:p-7 lg:p-10">

    <div
        class="grid grid-cols-1 items-center gap-7 lg:grid-cols-[minmax(0,1fr)_360px] lg:gap-10">

        {{-- HERO TEXTO --}}

        <div class="min-w-0">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-horeca-dorado/40 bg-horeca-dorado/10 text-horeca-dorado">
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <div>

                    <p class="text-[10px] font-bold tracking-[0.2em] text-horeca-dorado">
                        COMUNIDAD PROFESIONAL HORECA
                    </p>

                    <p class="text-xs text-white/50">
                        Gastronomía · Hotelería · Turismo
                    </p>

                </div>

            </div>


            <h2
                class="mt-5 break-words text-2xl font-black leading-[1.05] sm:text-3xl lg:text-4xl">
                ¡Bienvenido,

                <span class="text-horeca-dorado">
                    {{ $profesional?->nombres ?? $usuario->name }}
                </span>!

            </h2>


            <p
                class="mt-5 max-w-2xl text-sm leading-7 text-white/70 sm:text-base lg:text-lg">
                Conecta con empresas, encuentra nuevas oportunidades,
                desarrolla tus habilidades y haz crecer tu carrera
                dentro de la comunidad HORECA.
            </p>


            <div class="mt-6 grid grid-cols-1 gap-3 sm:flex sm:flex-wrap">

                <a
                    href="#"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-horeca-dorado px-5 py-3.5 text-sm font-black text-black transition hover:opacity-90">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Explorar oportunidades
                </a>


                <a
                    href="#"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-[#101A2B] px-5 py-3.5 text-sm font-bold transition hover:bg-white/10">
                    <i class="fa-solid fa-graduation-cap text-horeca-dorado"></i>
                    Academia PRO
                </a>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- MEMBRESÍA --}}
        {{-- ========================================================= --}}

        <div
            class="w-full rounded-2xl border border-horeca-dorado/40 bg-[#101829] p-5 sm:p-6">

            <div class="flex items-center justify-between">

                <span class="text-[10px] font-bold uppercase tracking-wide text-white/40">
                    Membresía actual
                </span>


                @if($membresia)

                <span
                    class="rounded-full bg-horeca-dorado/20 px-3 py-1 text-[10px] font-bold text-horeca-dorado">
                    ACTIVA
                </span>

                @else

                <span
                    class="rounded-full bg-red-500/10 px-3 py-1 text-[10px] font-bold text-red-400">
                    SIN MEMBRESÍA
                </span>

                @endif

            </div>


            <div class="mt-5 flex items-center gap-4">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-horeca-dorado/10 text-xl text-horeca-dorado">
                    <i class="fa-solid fa-crown"></i>
                </div>


                <div>

                    @if($membresia)

                    <h3 class="text-xl font-black">
                        {{ $membresia->nombre }}
                    </h3>

                    <p class="text-xs text-white/40">
                        {{ $membresia->descripcion ?? 'Membresía profesional' }}
                    </p>

                    @else

                    <h3 class="text-xl font-black">
                        Sin membresía
                    </h3>

                    <p class="text-xs text-white/40">
                        No tienes una membresía activa
                    </p>

                    @endif

                </div>

            </div>


            <div class="mt-5">

                @if($membresia)

                <span class="text-4xl font-black text-horeca-dorado">
                    S/ {{ number_format((float) $membresia->precio, 2) }}
                </span>

                <span class="text-sm text-white/40">
                    / {{ $membresia->duracion }}
                </span>

                @else

                <span class="text-2xl font-black text-white/40">
                    Sin plan activo
                </span>

                @endif

            </div>


            <div class="mt-5 space-y-3 text-xs text-white/60">

                <p class="flex gap-2">
                    <i class="fa-solid fa-circle-check mt-0.5 text-horeca-dorado"></i>
                    Ofertas laborales exclusivas
                </p>

                <p class="flex gap-2">
                    <i class="fa-solid fa-circle-check mt-0.5 text-horeca-dorado"></i>
                    Perfil visible para empresas
                </p>

                <p class="flex gap-2">
                    <i class="fa-solid fa-circle-check mt-0.5 text-horeca-dorado"></i>
                    Acceso a Academia PRO
                </p>

            </div>


            <a
                href="#"
                class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-horeca-dorado py-3 text-xs font-black text-black">
                <i class="fa-solid fa-gear"></i>

                {{ $membresia ? 'Gestionar membresía' : 'Elegir membresía' }}

            </a>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- ESTADÍSTICAS --}}
{{-- ========================================================= --}}

<section
    class="mt-6 grid grid-cols-1 gap-4 min-[480px]:grid-cols-2 lg:grid-cols-4">

    {{-- PERFIL --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-xs text-white/40">
                    Perfil profesional
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $estadisticas['perfil'] }}%
                </p>

            </div>


            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                <i class="fa-solid fa-user-check"></i>
            </div>

        </div>


        <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-white/10">

            <div
                class="h-full rounded-full bg-horeca-dorado"
                style="width: {{ $estadisticas['perfil'] }}%"></div>

        </div>


        <p class="mt-3 text-xs text-horeca-dorado">

            @if($estadisticas['perfil'] >= 100)

            Perfil completo

            @else

            +{{ 100 - $estadisticas['perfil'] }}% para completar

            @endif

        </p>

    </div>



    {{-- OPORTUNIDADES --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-xs text-white/40">
                    Oportunidades
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $estadisticas['oportunidades'] ?? 0 }}
                </p>

            </div>


            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                <i class="fa-solid fa-briefcase"></i>
            </div>

        </div>


        <p class="mt-4 text-xs text-emerald-400">

            <i class="fa-solid fa-arrow-trend-up mr-1"></i>

            {{ $estadisticas['oportunidades_nuevas'] ?? 0 }} nuevas hoy

        </p>

    </div>



    {{-- POSTULACIONES --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-xs text-white/40">
                    Postulaciones
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $estadisticas['postulaciones'] ?? 0 }}
                </p>

            </div>


            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                <i class="fa-solid fa-file-signature"></i>
            </div>

        </div>


        <p class="mt-4 text-xs text-blue-400">

            {{ $estadisticas['postulaciones_revision'] ?? 0 }}
            en revisión

        </p>

    </div>



    {{-- CERTIFICACIONES --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <div class="flex items-start justify-between">

            <div>

                <p class="text-xs text-white/40">
                    Certificaciones
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $estadisticas['certificaciones'] ?? 0 }}
                </p>

            </div>


            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                <i class="fa-solid fa-award"></i>
            </div>

        </div>


        <p class="mt-4 text-xs text-white/40">

            {{ $estadisticas['certificaciones_pendientes'] ?? 0 }}
            pendiente(s)

        </p>

    </div>

</section>



{{-- ========================================================= --}}
{{-- PERFIL + ACTIVIDAD --}}
{{-- ========================================================= --}}

<section
    class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-[1fr_360px]">

    {{-- ========================================================= --}}
    {{-- PERFIL --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border border-white/10 bg-[#111A29] p-5 sm:p-6">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

            {{-- AVATAR --}}

            <div
                class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-horeca-dorado to-[#8d6d20] text-2xl font-black text-black">
                {{ $iniciales }}
            </div>


            <div class="min-w-0 flex-1">

                <div class="flex flex-wrap items-center gap-2">

                    <h3 class="text-xl font-black">

                        {{ $profesional?->nombres ?? $usuario->name }}

                        {{ $profesional?->apellidos ?? '' }}

                    </h3>


                    @php

                    $estadoTexto = match($estadoValidacion) {

                    'aprobado',
                    'validado'
                    => 'Perfil validado',

                    'rechazado'
                    => 'Perfil rechazado',

                    default
                    => 'Validación pendiente',

                    };


                    $estadoClase = match($estadoValidacion) {

                    'aprobado',
                    'validado'
                    => 'bg-emerald-500/10 text-emerald-400',

                    'rechazado'
                    => 'bg-red-500/10 text-red-400',

                    default
                    => 'bg-yellow-500/10 text-yellow-400',

                    };

                    @endphp


                    <span
                        class="rounded-full px-2.5 py-1 text-[10px] font-bold {{ $estadoClase }}">
                        <i class="fa-solid fa-circle mr-1 text-[6px]"></i>
                        {{ $estadoTexto }}
                    </span>

                </div>


                <p class="mt-1 text-sm text-white/40">

                    {{ $profesional?->especialidad ?? 'Profesional HORECA' }}

                    @if($profesional?->subespecialidad)

                    · {{ $profesional->subespecialidad }}

                    @endif

                </p>


                <div class="mt-3 flex flex-wrap gap-4 text-xs text-white/40">

                    @if($profesional?->ciudad || $profesional?->distrito)

                    <span>

                        <i class="fa-solid fa-location-dot mr-1 text-horeca-dorado"></i>

                        {{ $profesional?->distrito }}

                        @if($profesional?->distrito && $profesional?->ciudad)
                        ,
                        @endif

                        {{ $profesional?->ciudad }}

                    </span>

                    @endif


                    @if($profesional?->experiencia)

                    <span>

                        <i class="fa-solid fa-briefcase mr-1 text-horeca-dorado"></i>

                        {{ $profesional->experiencia }}

                    </span>

                    @endif


                    @if($profesional?->modalidad)

                    <span>

                        <i class="fa-solid fa-laptop mr-1 text-horeca-dorado"></i>

                        {{ $profesional->modalidad }}

                    </span>

                    @endif

                </div>

            </div>


            <a
                href="{{ route('perfil.profesional') }}"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-xs font-bold text-white/70 hover:text-white">
                <i class="fa-solid fa-pen"></i>
                Editar perfil
            </a>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- ACTIVIDAD --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border border-white/10 bg-[#111A29] p-5 sm:p-6">

        <div class="flex items-center justify-between">

            <h3 class="font-bold">
                Actividad reciente
            </h3>

            <i class="fa-solid fa-clock-rotate-left text-xs text-white/30"></i>

        </div>


        <div class="mt-5">

            @if(!empty($actividadesRecientes) && count($actividadesRecientes))

            <div class="space-y-4">

                @foreach($actividadesRecientes as $actividad)

                <div class="flex gap-3">

                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-horeca-dorado/10 text-horeca-dorado">
                        <i class="{{ $actividad->icono ?? 'fa-solid fa-clock' }}"></i>
                    </div>


                    <div>

                        <p class="text-xs font-bold">
                            {{ $actividad->titulo }}
                        </p>

                        <p class="mt-1 text-[11px] text-white/40">
                            {{ $actividad->descripcion }}
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

            @else

            <div class="py-6 text-center">

                <div
                    class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-white/5 text-white/30">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>

                <p class="mt-3 text-xs font-bold text-white/60">
                    Sin actividad reciente
                </p>

                <p class="mt-1 text-[11px] text-white/30">
                    Aquí aparecerán tus últimas actividades.
                </p>

            </div>

            @endif

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- OPORTUNIDADES + ACTIVIDADES --}}
{{-- ========================================================= --}}

<section
    class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-2">

    {{-- ========================================================= --}}
    {{-- OPORTUNIDADES --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border border-white/10 bg-[#111A29] p-5 sm:p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-horeca-dorado">
                    Para ti
                </p>

                <h3 class="mt-1 text-lg font-black">
                    Oportunidades recomendadas
                </h3>

            </div>


            <a
                href="#"
                class="text-xs font-bold text-horeca-dorado">
                Ver todas →
            </a>

        </div>


        <div class="mt-5 space-y-3">

            @if(!empty($oportunidades) && count($oportunidades))

            @foreach($oportunidades as $oportunidad)

            <div
                class="rounded-xl border border-white/5 bg-[#182337] p-4 transition hover:border-horeca-dorado/30">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>


                    <div class="min-w-0 flex-1">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h4 class="text-sm font-bold">
                                    {{ $oportunidad->titulo }}
                                </h4>

                                <p class="mt-1 text-xs text-white/40">

                                    {{ $oportunidad->empresa ?? 'Empresa HORECA' }}

                                    @if($oportunidad->ciudad)
                                    · {{ $oportunidad->ciudad }}
                                    @endif

                                </p>

                            </div>


                            @if(!empty($oportunidad->es_nueva) && $oportunidad->es_nueva)

                            <span
                                class="shrink-0 rounded-full bg-emerald-500/10 px-2 py-1 text-[9px] font-bold text-emerald-400">
                                NUEVA
                            </span>

                            @endif

                        </div>


                        <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-white/40">

                            @if($oportunidad->salario_min || $oportunidad->salario_max)

                            <span>

                                <i class="fa-solid fa-money-bill-wave mr-1 text-horeca-dorado"></i>

                                S/
                                {{ number_format((float) $oportunidad->salario_min, 0) }}

                                -

                                S/
                                {{ number_format((float) $oportunidad->salario_max, 0) }}

                            </span>

                            @endif


                            @if($oportunidad->ciudad)

                            <span>

                                <i class="fa-solid fa-location-dot mr-1 text-horeca-dorado"></i>

                                {{ $oportunidad->ciudad }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

            @else

            <div class="rounded-xl border border-white/5 bg-[#182337] p-6 text-center">

                <div
                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white/5 text-white/30">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <p class="mt-3 text-sm font-bold text-white/60">
                    No hay oportunidades disponibles
                </p>

                <p class="mt-1 text-xs text-white/30">
                    Cuando encontremos oportunidades para tu perfil aparecerán aquí.
                </p>

            </div>

            @endif

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- ACTIVIDADES --}}
    {{-- ========================================================= --}}

    <div
        class="rounded-2xl border border-white/10 bg-[#111A29] p-5 sm:p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-horeca-dorado">
                    Próximamente
                </p>

                <h3 class="mt-1 text-lg font-black">
                    Actividades
                </h3>

            </div>


            <a
                href="#"
                class="text-xs font-bold text-horeca-dorado">
                Ver calendario
            </a>

        </div>


        <div class="mt-5 space-y-3">

            @if(!empty($actividades) && count($actividades))

            @foreach($actividades as $actividad)

            <div
                class="flex gap-4 rounded-xl bg-[#182337] p-4">

                <div
                    class="flex h-12 w-12 shrink-0 flex-col items-center justify-center rounded-xl bg-horeca-dorado text-black">

                    <span class="text-[9px] font-black uppercase">
                        {{ \Carbon\Carbon::parse($actividad->fecha)->translatedFormat('M') }}
                    </span>

                    <span class="text-lg font-black leading-none">
                        {{ \Carbon\Carbon::parse($actividad->fecha)->format('d') }}
                    </span>

                </div>


                <div class="min-w-0 flex-1">

                    <div class="flex items-start justify-between gap-2">

                        <div>

                            <h4 class="text-sm font-bold">
                                {{ $actividad->titulo }}
                            </h4>

                            <p class="mt-1 text-xs text-white/40">
                                {{ $actividad->descripcion }}
                            </p>

                        </div>

                        <i class="fa-solid fa-arrow-up-right-from-square text-xs text-white/30"></i>

                    </div>


                    <div class="mt-3 flex flex-wrap gap-3 text-[10px] text-white/40">

                        @if($actividad->hora)

                        <span>
                            <i class="fa-regular fa-clock mr-1 text-horeca-dorado"></i>
                            {{ $actividad->hora }}
                        </span>

                        @endif


                        @if($actividad->modalidad)

                        <span>
                            <i class="fa-solid fa-video mr-1 text-horeca-dorado"></i>
                            {{ $actividad->modalidad }}
                        </span>

                        @endif

                    </div>

                </div>

            </div>

            @endforeach

            @else

            <div class="rounded-xl border border-white/5 bg-[#182337] p-6 text-center">

                <div
                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white/5 text-white/30">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <p class="mt-3 text-sm font-bold text-white/60">
                    No hay actividades próximas
                </p>

                <p class="mt-1 text-xs text-white/30">
                    Aquí aparecerán masterclasses, cursos y eventos.
                </p>

            </div>

            @endif

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- MEMBRESÍA INFO --}}
{{-- ========================================================= --}}

@if($membresia && $membresia->fecha_fin)

<div
    class="mt-6 rounded-2xl border border-horeca-dorado/10 bg-horeca-dorado/5 p-4">

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                <i class="fa-solid fa-calendar-check"></i>
            </div>

            <div>

                <p class="text-xs font-bold">
                    Membresía activa
                </p>

                <p class="mt-1 text-[11px] text-white/40">
                    Válida hasta
                    {{ \Carbon\Carbon::parse($membresia->fecha_fin)->format('d/m/Y') }}
                </p>

            </div>

        </div>

        <a
            href="#"
            class="text-xs font-bold text-horeca-dorado">
            Gestionar membresía →
        </a>

    </div>

</div>

@endif



{{-- ========================================================= --}}
{{-- FOOTER INFORMATIVO --}}
{{-- ========================================================= --}}

<div
    class="mt-6 flex flex-col gap-3 rounded-2xl border border-white/10 bg-[#0D1522] p-5 sm:flex-row sm:items-center sm:justify-between">

    <div class="flex items-center gap-3">

        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
            <i class="fa-solid fa-shield-halved"></i>
        </div>


        <div>

            <p class="text-xs font-bold">
                Tu perfil está protegido
            </p>

            <p class="mt-1 text-[10px] text-white/40">
                CLUB HORECA PRO verifica la información profesional.
            </p>

        </div>

    </div>


    <a
        href="#"
        class="text-xs font-bold text-horeca-dorado">
        Ver información de seguridad →
    </a>

</div>


</div>

@endsection