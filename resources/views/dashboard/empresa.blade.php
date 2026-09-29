@extends('layouts.dashboard')

@section('title', 'Panel Empresa')

@section('header-title', 'Panel principal')

@section('menu')

    <nav class="space-y-2">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center justify-between rounded-xl bg-horeca-dorado px-4 py-3 text-sm font-bold text-black"
        >
            <span>⌂ &nbsp; Inicio</span>
            <span>›</span>
        </a>

        <a
            href="#"
            class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-white/60 hover:bg-white/5 hover:text-white"
        >
            <span>💼 &nbsp; Mis oportunidades</span>

            <span class="rounded-full bg-red-500/80 px-2 py-0.5 text-[10px]">
                3
            </span>
        </a>

        <a
            href="#"
            class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-white/60 hover:bg-white/5 hover:text-white"
        >
            <span>👥 &nbsp; Buscar profesionales</span>
        </a>

        <a
            href="#"
            class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-white/60 hover:bg-white/5 hover:text-white"
        >
            <span>🏢 &nbsp; Mi empresa</span>
        </a>

        <a
            href="#"
            class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-white/60 hover:bg-white/5 hover:text-white"
        >
            <span>📊 &nbsp; Estadísticas</span>
        </a>

    </nav>

@endsection


@section('content')

    {{-- HERO --}}
    <section class="rounded-[28px] border border-horeca-dorado/30 bg-gradient-to-br from-[#26364D] to-[#172334] p-8 lg:p-10">

        <div class="grid lg:grid-cols-[1fr_360px] gap-10 items-center">

            <div>

                <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
                    COMUNIDAD EMPRESARIAL HORECA
                </p>

                <p class="mt-1 text-sm text-white/60">
                    Gastronomía · Hotelería · Turismo
                </p>

                <h2 class="mt-5 text-4xl lg:text-5xl font-black leading-tight">
                    ¡Bienvenido,
                    <span class="text-horeca-dorado">
                        {{ $usuario->name }}
                    </span>!
                </h2>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-white/70">
                    Encuentra talento especializado, publica oportunidades
                    y conecta con profesionales de la comunidad HORECA PRO.
                </p>

                <div class="mt-7 flex flex-wrap gap-3">

                    <a
                        href="#"
                        class="rounded-xl bg-horeca-dorado px-6 py-4 font-bold text-black"
                    >
                        Publicar oportunidad →
                    </a>

                    <a
                        href="#"
                        class="rounded-xl border border-white/10 bg-[#101A2B] px-6 py-4 font-bold"
                    >
                        Buscar profesionales
                    </a>

                </div>

            </div>


            {{-- PLAN EMPRESA --}}
            <div class="rounded-2xl border border-horeca-dorado/40 bg-[#101829] p-6">

                <span class="text-xs font-bold uppercase text-white/50">
                    Plan empresarial
                </span>

                <h3 class="mt-4 text-2xl font-black">
                    Empresa PRO
                </h3>

                <div class="mt-3">
                    <span class="text-4xl font-black text-horeca-dorado">
                        PRO
                    </span>
                </div>

                <div class="mt-6 space-y-4 text-sm text-white/70">

                    <p>✓ Publicación de oportunidades</p>

                    <p>✓ Acceso a profesionales</p>

                    <p>✓ Perfil empresarial visible</p>

                    <p>✓ Herramientas de selección</p>

                </div>

                <a
                    href="#"
                    class="mt-7 block rounded-xl bg-horeca-dorado py-3 text-center text-sm font-black text-black"
                >
                    Administrar empresa
                </a>

            </div>

        </div>

    </section>


    {{-- ESTADÍSTICAS --}}
    <section class="mt-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Oportunidades activas
            </p>

            <p class="mt-2 text-3xl font-black">
                3
            </p>

        </div>

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Postulaciones
            </p>

            <p class="mt-2 text-3xl font-black">
                18
            </p>

        </div>

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Profesionales vistos
            </p>

            <p class="mt-2 text-3xl font-black">
                42
            </p>

        </div>

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Contrataciones
            </p>

            <p class="mt-2 text-3xl font-black">
                5
            </p>

        </div>

    </section>


    {{-- CONTENIDO --}}
    <section class="mt-8 grid lg:grid-cols-2 gap-6">

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center justify-between">

                <h3 class="text-lg font-bold">
                    Mis oportunidades
                </h3>

                <a
                    href="#"
                    class="text-xs font-bold text-horeca-dorado"
                >
                    Ver todas →
                </a>

            </div>

            <div class="mt-5 space-y-3">

                <div class="rounded-xl bg-[#182337] p-4">

                    <div class="flex justify-between">

                        <p class="font-bold">
                            Chef Ejecutivo
                        </p>

                        <span class="text-xs text-emerald-400">
                            Activa
                        </span>

                    </div>

                    <p class="mt-1 text-xs text-white/40">
                        8 postulantes
                    </p>

                </div>

                <div class="rounded-xl bg-[#182337] p-4">

                    <div class="flex justify-between">

                        <p class="font-bold">
                            Jefe de Operaciones
                        </p>

                        <span class="text-xs text-emerald-400">
                            Activa
                        </span>

                    </div>

                    <p class="mt-1 text-xs text-white/40">
                        5 postulantes
                    </p>

                </div>

            </div>

        </div>


        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center justify-between">

                <h3 class="text-lg font-bold">
                    Profesionales recomendados
                </h3>

                <a
                    href="#"
                    class="text-xs font-bold text-horeca-dorado"
                >
                    Explorar →
                </a>

            </div>

            <div class="mt-5 space-y-4">

                <div class="flex items-center gap-4">

                    <div class="h-11 w-11 rounded-full bg-horeca-dorado text-black flex items-center justify-center font-black">
                        JP
                    </div>

                    <div class="flex-1">

                        <p class="text-sm font-bold">
                            Profesional HORECA
                        </p>

                        <p class="text-xs text-white/40">
                            Chef Ejecutivo · Lima
                        </p>

                    </div>

                    <button class="text-xs font-bold text-horeca-dorado">
                        Ver
                    </button>

                </div>

                <div class="flex items-center gap-4">

                    <div class="h-11 w-11 rounded-full bg-horeca-dorado text-black flex items-center justify-center font-black">
                        MG
                    </div>

                    <div class="flex-1">

                        <p class="text-sm font-bold">
                            Profesional HORECA
                        </p>

                        <p class="text-xs text-white/40">
                            Administración · Lima
                        </p>

                    </div>

                    <button class="text-xs font-bold text-horeca-dorado">
                        Ver
                    </button>

                </div>

            </div>

        </div>

    </section>

@endsection