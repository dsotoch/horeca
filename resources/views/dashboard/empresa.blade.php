@extends('layouts.dashboard')

@section('title', 'Panel Empresa')

@section('header-title', 'Panel principal')


@section('content')

<div class="space-y-8">


    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section class="rounded-[28px] border border-horeca-dorado/30 bg-gradient-to-br from-[#26364D] to-[#172334] p-8 lg:p-10">

        <div class="grid items-center gap-10 lg:grid-cols-[1fr_360px]">

            <div>

                <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
                    COMUNIDAD EMPRESARIAL HORECA
                </p>

                <p class="mt-1 text-sm text-white/60">
                    Gastronomía · Hotelería · Turismo
                </p>


                <h2 class="mt-5 text-4xl font-black leading-tight lg:text-5xl">

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
                        href="{{ route('oportunidades.create') }}"
                        class="rounded-xl bg-horeca-dorado px-6 py-4 font-bold text-black transition hover:opacity-90"
                    >
                        Publicar oportunidad →
                    </a>


                    <a
                       href="{{ route('profesionales.index') }}"
                        class="rounded-xl border border-white/10 bg-[#101A2B] px-6 py-4 font-bold transition hover:bg-white/5"
                    >
                        Buscar profesionales
                    </a>

                </div>

            </div>


            {{-- =====================================================
                 PLAN EMPRESA
            ====================================================== --}}

            <div class="rounded-2xl border border-horeca-dorado/40 bg-[#101829] p-6">

                <span class="text-xs font-bold uppercase text-white/70">
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

                    <p>
                        ✓ Publicación de oportunidades
                    </p>

                    <p>
                        ✓ Acceso a profesionales
                    </p>

                    <p>
                        ✓ Perfil empresarial visible
                    </p>

                    <p>
                        ✓ Herramientas de selección
                    </p>

                </div>


                <a
                    href="#"
                    class="mt-7 block rounded-xl bg-horeca-dorado py-3 text-center text-sm font-black text-black transition hover:opacity-90"
                >
                    Administrar empresa
                </a>

            </div>

        </div>

    </section>



    {{-- =========================================================
         ESTADÍSTICAS
    ========================================================== --}}

    <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


        {{-- OPORTUNIDADES --}}

        <a
            href="{{ route('oportunidades.index') }}"
            class="rounded-2xl border border-white/10 bg-[#111A29] p-6 transition hover:border-horeca-dorado/30 hover:bg-[#151F30]"
        >

            <p class="text-xs text-white/40">
                Oportunidades activas
            </p>

            <p class="mt-2 text-3xl font-black">
                {{ $oportunidadesActivas }}
            </p>

            <p class="mt-2 text-xs text-horeca-dorado">
                Ver oportunidades →
            </p>

        </a>



        {{-- POSTULACIONES --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Postulaciones
            </p>

            <p class="mt-2 text-3xl font-black">
                {{ $totalPostulaciones }}
            </p>

            <p class="mt-2 text-xs text-white/40">
                Recibidas en tus oportunidades
            </p>

        </div>





        {{-- CONTRATACIONES --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <p class="text-xs text-white/40">
                Contrataciones
            </p>

            <p class="mt-2 text-3xl font-black">
                {{ $totalContrataciones }}
            </p>

            <p class="mt-2 text-xs text-white/40">
                Profesionales seleccionados
            </p>

        </div>

    </section>



    {{-- =========================================================
         CONTENIDO
    ========================================================== --}}

    <section class="grid gap-6 lg:grid-cols-2">


        {{-- =====================================================
             MIS OPORTUNIDADES
        ====================================================== --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <h3 class="text-lg font-bold">
                        Mis oportunidades
                    </h3>

                    <p class="mt-1 text-xs text-white/40">
                        Últimas oportunidades de tu empresa
                    </p>

                </div>


                <a
                    href="{{ route('oportunidades.index') }}"
                    class="text-xs font-bold text-horeca-dorado hover:underline"
                >
                    Ver todas →
                </a>

            </div>



            <div class="mt-5 space-y-3">


                @forelse($oportunidades->take(3) as $oportunidad)


                    <div class="rounded-xl bg-[#182337] p-4 transition hover:bg-[#1C2A40]">


                        <div class="flex items-start justify-between gap-4">


                            <div class="min-w-0">

                                <a
                                    href="{{ route('oportunidades.show', $oportunidad) }}"
                                    class="font-bold hover:text-horeca-dorado"
                                >
                                    {{ $oportunidad->titulo }}
                                </a>


                                @if($oportunidad->area)

                                    <p class="mt-1 text-xs text-white/40">
                                        {{ $oportunidad->area }}
                                    </p>

                                @endif

                            </div>



                            {{-- ESTADO --}}

                            <div class="shrink-0">

                                @if($oportunidad->estado === 'publicada')

                                    <span class="rounded-full bg-emerald-500/10 px-2.5 py-1 text-[11px] font-bold text-emerald-400">
                                        Publicada
                                    </span>

                                @elseif($oportunidad->estado === 'pendiente')

                                    <span class="rounded-full bg-yellow-500/10 px-2.5 py-1 text-[11px] font-bold text-yellow-400">
                                        Pendiente
                                    </span>

                                @elseif($oportunidad->estado === 'cerrada')

                                    <span class="rounded-full bg-white/10 px-2.5 py-1 text-[11px] font-bold text-white/70">
                                        Cerrada
                                    </span>

                                @elseif($oportunidad->estado === 'cancelada')

                                    <span class="rounded-full bg-red-500/10 px-2.5 py-1 text-[11px] font-bold text-red-400">
                                        Cancelada
                                    </span>

                                @else

                                    <span class="rounded-full bg-white/10 px-2.5 py-1 text-[11px] font-bold text-white/70">
                                        {{ ucfirst($oportunidad->estado) }}
                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="mt-3 flex items-center justify-between">


                            <p class="text-xs text-white/40">

                                {{ $oportunidad->postulaciones_count }}

                                @if($oportunidad->postulaciones_count == 1)
                                    postulante
                                @else
                                    postulantes
                                @endif

                            </p>


                            <a
                                href="{{ route('oportunidades.show', $oportunidad) }}"
                                class="text-xs font-bold text-horeca-dorado"
                            >
                                Ver oportunidad →
                            </a>

                        </div>


                    </div>


                @empty


                    <div class="rounded-xl border border-dashed border-white/10 p-8 text-center">


                        <div class="text-3xl">
                            💼
                        </div>


                        <p class="mt-3 text-sm font-bold">
                            Aún no tienes oportunidades
                        </p>


                        <p class="mt-1 text-xs text-white/40">
                            Publica tu primera oportunidad y empieza a encontrar talento.
                        </p>


                        <a
                            href="{{ route('oportunidades.create') }}"
                            class="mt-4 inline-block rounded-lg bg-horeca-dorado px-4 py-2 text-xs font-black text-black"
                        >
                            Publicar oportunidad
                        </a>

                    </div>


                @endforelse


            </div>

        </div>



        {{-- =====================================================
             PROFESIONALES
        ====================================================== --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">


            <div class="flex items-center justify-between gap-4">

                <div>

                    <h3 class="text-lg font-bold">
                        Profesionales recomendados
                    </h3>

                    <p class="mt-1 text-xs text-white/40">
                        Encuentra talento para tu empresa
                    </p>

                </div>


                <a
                    href="{{ route('profesionales.index') }}"
                    class="text-xs font-bold text-horeca-dorado hover:underline"
                >
                    Explorar →
                </a>

            </div>



            <div class="mt-5">


                <div class="rounded-xl border border-dashed border-white/10 p-8 text-center">


                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-horeca-dorado text-xl text-black">
                        👤
                    </div>


                    <p class="mt-4 text-sm font-bold">
                        Busca profesionales HORECA
                    </p>


                    <p class="mx-auto mt-2 max-w-sm text-xs leading-5 text-white/40">
                        Encuentra chefs, administradores, especialistas
                        y otros profesionales para las necesidades de tu empresa.
                    </p>


                    <a
                       href="{{ route('profesionales.index') }}"
                        class="mt-5 inline-block rounded-lg border border-horeca-dorado/30 px-4 py-2 text-xs font-bold text-horeca-dorado hover:bg-horeca-dorado/10"
                    >
                        Buscar profesionales →
                    </a>

                </div>


            </div>

        </div>


    </section>


</div>

@endsection