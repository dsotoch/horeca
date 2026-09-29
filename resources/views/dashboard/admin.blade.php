@extends('layouts.dashboard')

@section('title', 'Dashboard Administrativo')

@section('header-title', 'Dashboard Administrativo')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- =========================================================
         CABECERA
    ========================================================== --}}

    <div>
        <p class="text-sm text-white/40">
            Administración
        </p>

        <h1 class="mt-1 text-2xl font-black text-white">
            Panel de administración
        </h1>

        <p class="mt-1 text-sm text-white/50">
            Resumen general de HORECA PRO.
        </p>
    </div>


    {{-- =========================================================
         ESTADÍSTICAS
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Usuarios --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-white/40">
                        Usuarios
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $totalUsuarios }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">
                    <i class="fa-solid fa-users"></i>
                </div>

            </div>

        </div>


        {{-- Empresas --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-white/40">
                        Empresas
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $totalEmpresas }}
                    </p>

                    <p class="mt-1 text-sm text-horeca-dorado">
                        {{ $empresasPendientes }} por validar
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                    <i class="fa-solid fa-building"></i>
                </div>

            </div>

        </div>


        {{-- Profesionales --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-white/40">
                        Profesionales
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $totalProfesionales }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400">
                    <i class="fa-solid fa-user-tie"></i>
                </div>

            </div>

        </div>


        {{-- Postulaciones --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-white/40">
                        Postulaciones
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $totalPostulaciones }}
                    </p>

                    <p class="mt-1 text-sm text-horeca-dorado">
                        {{ $postulacionesPendientes }} pendientes
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SEGUNDA FILA
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Oportunidades --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-black text-white">
                        Oportunidades
                    </h2>

                    <p class="mt-1 text-sm text-white/40">
                        Estado actual
                    </p>
                </div>

                <i class="fa-solid fa-briefcase text-horeca-dorado"></i>

            </div>

            <div class="mt-6">

                <p class="text-4xl font-black text-white">
                    {{ $totalOportunidades }}
                </p>

                <p class="mt-1 text-sm text-white/40">
                    oportunidades registradas
                </p>

                <div class="mt-5 h-px bg-white/10"></div>

                <div class="mt-4 flex items-center justify-between">

                    <span class="text-sm text-white/50">
                        Publicadas
                    </span>

                    <span class="font-black text-emerald-400">
                        {{ $oportunidadesPublicadas }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Empresas por validar --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6 lg:col-span-2">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-black text-white">
                        Empresas por validar
                    </h2>

                    <p class="mt-1 text-sm text-white/40">
                        Empresas pendientes de revisión.
                    </p>
                </div>

                <a
                    href="#"
                    class="text-sm font-bold text-horeca-dorado hover:underline"
                >
                    Ver todas
                </a>

            </div>


            <div class="mt-5 space-y-3">

                @forelse($empresasPorValidar as $empresa)

                    <div class="flex items-center justify-between rounded-xl border border-white/5 bg-white/[0.02] p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                                <i class="fa-solid fa-building"></i>
                            </div>

                            <div>

                                <p class="text-sm font-bold text-white">
                                    {{ $empresa->nombre_comercial ?? $empresa->razon_social }}
                                </p>

                                <p class="mt-1 text-sm text-white/40">
                                    RUC: {{ $empresa->ruc }}
                                </p>

                            </div>

                        </div>

                        <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-[10px] font-bold text-yellow-400">
                            Pendiente
                        </span>

                    </div>

                @empty

                    <div class="py-8 text-center">

                        <i class="fa-solid fa-circle-check text-2xl text-emerald-400"></i>

                        <p class="mt-3 text-sm font-bold text-white">
                            No hay empresas pendientes
                        </p>

                        <p class="mt-1 text-sm text-white/40">
                            Todas las empresas han sido revisadas.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================================================
         ACTIVIDAD + POSTULACIONES
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Actividad reciente --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div>
                <h2 class="font-black text-white">
                    Actividad reciente
                </h2>

                <p class="mt-1 text-sm text-white/40">
                    Últimos movimientos registrados.
                </p>
            </div>


            <div class="mt-6">

                @if($actividadesRecientes->count())

                    <div class="space-y-5">

                        @foreach($actividadesRecientes as $actividad)

                            <div class="flex gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-horeca-dorado/10 text-horeca-dorado">
                                    <i class="{{ $actividad->icono }}"></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-white">
                                        {{ $actividad->titulo }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-white/40">
                                        {{ $actividad->descripcion }}
                                    </p>

                                    @if($actividad->fecha)
                                        <p class="mt-1 text-[10px] text-white/60">
                                            {{ $actividad->fecha->diffForHumans() }}
                                        </p>
                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="py-8 text-center">

                        <i class="fa-solid fa-clock-rotate-left text-2xl text-white/60"></i>

                        <p class="mt-3 text-sm font-bold text-white/60">
                            Sin actividad reciente
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- Últimas postulaciones --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div>
                <h2 class="font-black text-white">
                    Últimas postulaciones
                </h2>

                <p class="mt-1 text-sm text-white/40">
                    Postulaciones más recientes.
                </p>
            </div>


            <div class="mt-5 space-y-3">

                @forelse($ultimasPostulaciones as $postulacion)

                    <div class="rounded-xl border border-white/5 bg-white/[0.02] p-4">

                        <p class="text-sm font-bold text-white">

                            {{ $postulacion->profesional?->usuario?->name
                                ?? 'Profesional' }}

                        </p>

                        <p class="mt-1 text-sm text-white/40">

                            {{ $postulacion->oportunidad?->titulo
                                ?? 'Oportunidad' }}

                        </p>

                        <div class="mt-3 flex items-center justify-between">

                            <span class="rounded-full bg-horeca-dorado/10 px-2.5 py-1 text-[10px] font-bold text-horeca-dorado">
                                {{ str_replace('_', ' ', $postulacion->estado) }}
                            </span>

                            <span class="text-[10px] text-white/60">
                                {{ $postulacion->fecha_postulacion?->diffForHumans() }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center">

                        <i class="fa-solid fa-paper-plane text-2xl text-white/60"></i>

                        <p class="mt-3 text-sm font-bold text-white/60">
                            Sin postulaciones
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection