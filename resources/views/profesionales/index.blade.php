@extends('layouts.dashboard')

@section('title', 'Buscar profesionales')

@section('header-title', 'Profesionales')


@section('content')

<div class="space-y-8">


    {{-- =========================================================
         ENCABEZADO
    ========================================================== --}}

    <section>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
                    TALENTO HORECA
                </p>

                <h1 class="mt-2 text-3xl font-black">
                    Buscar profesionales
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/70">
                    Encuentra profesionales especializados para las necesidades
                    de tu empresa dentro de la comunidad HORECA PRO.
                </p>

            </div>


            <div class="hidden rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 sm:block">

                <p class="text-[10px] font-bold uppercase tracking-wider text-white/30">
                    Profesionales
                </p>

                <p class="mt-1 text-xl font-black text-horeca-dorado">
                    {{ $profesionales->total() }}
                </p>

            </div>

        </div>

    </section>



    {{-- =========================================================
         BUSCADOR Y FILTROS
    ========================================================== --}}

    <section class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

        <form
            method="GET"
            action="{{ route('profesionales.index') }}"
        >

            <div class="grid gap-4 xl:grid-cols-[2fr_1fr_1fr_1fr_auto]">


                {{-- =================================================
                     BUSCAR
                ================================================== --}}

                <div>

                    <label
                        for="buscar"
                        class="mb-2 block text-xs font-bold text-white/70"
                    >
                        Buscar profesional
                    </label>

                    <div class="relative">

                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-white/30">
                            🔎
                        </span>

                        <input
                            id="buscar"
                            type="text"
                            name="buscar"
                            value="{{ $buscar }}"
                            placeholder="Nombre, especialidad, habilidad..."
                            autocomplete="off"
                            class="w-full rounded-xl border border-white/10 bg-[#0B1220] py-3 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-white/25 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                        >

                    </div>

                </div>



                {{-- =================================================
                     ESPECIALIDAD
                ================================================== --}}

                <div>

                    <label
                        for="especialidad"
                        class="mb-2 block text-xs font-bold text-white/70"
                    >
                        Especialidad
                    </label>

                    <select
                        id="especialidad"
                        name="especialidad"
                        class="w-full appearance-none rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none transition focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                    >

                        <option
                            value=""
                            class="bg-[#111A29] text-white"
                        >
                            Todas
                        </option>

                        @foreach($especialidades as $item)

                            <option
                                value="{{ $item }}"
                                @selected($especialidad === $item)
                                class="bg-[#111A29] text-white"
                            >
                                {{ $item }}
                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- =================================================
                     CIUDAD
                ================================================== --}}

                <div>

                    <label
                        for="ciudad"
                        class="mb-2 block text-xs font-bold text-white/70"
                    >
                        Ciudad
                    </label>

                    <select
                        id="ciudad"
                        name="ciudad"
                        class="w-full appearance-none rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none transition focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                    >

                        <option
                            value=""
                            class="bg-[#111A29] text-white"
                        >
                            Todas
                        </option>

                        @foreach($ciudades as $item)

                            <option
                                value="{{ $item }}"
                                @selected($ciudad === $item)
                                class="bg-[#111A29] text-white"
                            >
                                {{ $item }}
                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- =================================================
                     MODALIDAD
                ================================================== --}}

                <div>

                    <label
                        for="modalidad"
                        class="mb-2 block text-xs font-bold text-white/70"
                    >
                        Modalidad
                    </label>

                    <select
                        id="modalidad"
                        name="modalidad"
                        class="w-full appearance-none rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none transition focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                    >

                        <option
                            value=""
                            class="bg-[#111A29] text-white"
                        >
                            Todas
                        </option>

                        @foreach($modalidades as $item)

                            <option
                                value="{{ $item }}"
                                @selected($modalidad === $item)
                                class="bg-[#111A29] text-white"
                            >
                                {{ ucfirst($item) }}
                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- =================================================
                     BOTÓN
                ================================================== --}}

                <div class="flex items-end">

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-black transition hover:opacity-90"
                    >
                        Buscar
                    </button>

                </div>

            </div>



            {{-- =====================================================
                 FILTROS ACTIVOS
            ====================================================== --}}

            @if($buscar || $especialidad || $ciudad || $modalidad)

                <div class="mt-5 flex flex-wrap items-center gap-2 border-t border-white/10 pt-5">

                    <span class="mr-1 text-xs font-bold text-white/40">
                        Filtros activos:
                    </span>


                    @if($buscar)

                        <span class="rounded-full bg-horeca-dorado/10 px-3 py-1.5 text-xs font-bold text-horeca-dorado">
                            🔎 {{ $buscar }}
                        </span>

                    @endif


                    @if($especialidad)

                        <span class="rounded-full bg-white/5 px-3 py-1.5 text-xs text-white/60">
                            {{ $especialidad }}
                        </span>

                    @endif


                    @if($ciudad)

                        <span class="rounded-full bg-white/5 px-3 py-1.5 text-xs text-white/60">
                            📍 {{ $ciudad }}
                        </span>

                    @endif


                    @if($modalidad)

                        <span class="rounded-full bg-white/5 px-3 py-1.5 text-xs capitalize text-white/60">
                            💼 {{ $modalidad }}
                        </span>

                    @endif


                    <a
                        href="{{ route('profesionales.index') }}"
                        class="ml-2 text-xs font-bold text-red-400 transition hover:text-red-300 hover:underline"
                    >
                        Limpiar filtros
                    </a>

                </div>

            @endif

        </form>

    </section>



    {{-- =========================================================
         RESULTADOS
    ========================================================== --}}

    <section>

        <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-xl font-black">
                    Profesionales disponibles
                </h2>

                <p class="mt-1 text-xs text-white/40">

                    @if($profesionales->total() === 0)

                        No se encontraron profesionales

                    @elseif($profesionales->total() === 1)

                        1 profesional encontrado

                    @else

                        {{ $profesionales->total() }} profesionales encontrados

                    @endif

                </p>

            </div>


            @if($profesionales->total() > 0)

                <div class="text-xs text-white/30">

                    Página
                    {{ $profesionales->currentPage() }}
                    de
                    {{ $profesionales->lastPage() }}

                </div>

            @endif

        </div>



        {{-- =====================================================
             TARJETAS
        ====================================================== --}}

        @if($profesionales->count() > 0)

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">


                @foreach($profesionales as $profesional)

                    <article
                        class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-[#111A29] transition duration-200 hover:-translate-y-1 hover:border-horeca-dorado/30 hover:bg-[#151F30]"
                    >


                        {{-- =================================================
                             PARTE SUPERIOR
                        ================================================== --}}

                        <div class="p-6">


                            {{-- =================================================
                                 PERFIL
                            ================================================== --}}

                            <div class="flex items-start gap-4">


                                {{-- AVATAR --}}

                                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado text-xl font-black uppercase text-black">

                                    {{ strtoupper(substr($profesional->nombres ?: 'P', 0, 1)) }}

                                </div>



                                {{-- NOMBRE --}}

                                <div class="min-w-0 flex-1">

                                    <h3 class="text-base font-black leading-5">

                                        {{ $profesional->nombres }}
                                        {{ $profesional->apellidos }}

                                    </h3>


                                    @if($profesional->especialidad)

                                        <p class="mt-2 text-sm font-bold text-horeca-dorado">

                                            {{ $profesional->especialidad }}

                                        </p>

                                    @endif


                                    @if($profesional->subespecialidad)

                                        <p class="mt-1 text-xs text-white/40">

                                            {{ $profesional->subespecialidad }}

                                        </p>

                                    @endif

                                </div>

                            </div>



                            {{-- =================================================
                                 UBICACIÓN
                            ================================================== --}}

                            @if($profesional->ciudad || $profesional->distrito)

                                <div class="mt-5 flex items-center gap-2 text-xs text-white/40">

                                    <span>
                                        📍
                                    </span>

                                    <span>

                                        @if($profesional->ciudad)
                                            {{ $profesional->ciudad }}
                                        @endif

                                        @if($profesional->ciudad && $profesional->distrito)
                                            ,
                                        @endif

                                        @if($profesional->distrito)
                                            {{ $profesional->distrito }}
                                        @endif

                                    </span>

                                </div>

                            @endif



                            {{-- =================================================
                                 EXPERIENCIA
                            ================================================== --}}

                            @if(
                                $profesional->experiencia !== null &&
                                $profesional->experiencia !== ''
                            )

                                <div class="mt-4">

                                    <span class="inline-flex items-center rounded-full bg-white/5 px-3 py-1.5 text-xs font-bold text-white/60">

                                        ⭐

                                        <span class="ml-1">

                                            {{ $profesional->experiencia }}

                                            @if((int) $profesional->experiencia === 1)
                                                año de experiencia
                                            @else
                                                años de experiencia
                                            @endif

                                        </span>

                                    </span>

                                </div>

                            @endif



                            {{-- =================================================
                                 MODALIDAD
                            ================================================== --}}

                            @if($profesional->modalidad)

                                <div class="mt-4 flex items-center gap-2 text-xs text-white/70">

                                    <span>
                                        💼
                                    </span>

                                    <span class="capitalize">

                                        {{ $profesional->modalidad }}

                                    </span>

                                </div>

                            @endif



                            {{-- =================================================
                                 DESCRIPCIÓN
                            ================================================== --}}

                            @if($profesional->descripcion)

                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-white/70">

                                    {{ $profesional->descripcion }}

                                </p>

                            @else

                                <p class="mt-5 text-sm leading-6 text-white/30">

                                    Profesional registrado en HORECA PRO.

                                </p>

                            @endif



                            {{-- =================================================
                                 HABILIDADES
                            ================================================== --}}

                            @if($profesional->habilidades)

                                <div class="mt-5">

                                    <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-white/30">
                                        Habilidades
                                    </p>

                                    <p class="line-clamp-2 text-xs leading-5 text-white/70">

                                        {{ $profesional->habilidades }}

                                    </p>

                                </div>

                            @endif

                        </div>



                        {{-- =================================================
                             PIE DE TARJETA
                        ================================================== --}}

                        <div class="mt-auto border-t border-white/10 px-6 py-4">

                            <div class="flex items-center justify-between gap-4">


                                {{-- ESTADO --}}

                                <div>

                                    @if($profesional->estado_validacion === 'validado')

                                        <span class="inline-flex items-center gap-2 text-xs font-bold text-emerald-400">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                            Perfil validado

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2 text-xs text-white/30">

                                            <span class="h-1.5 w-1.5 rounded-full bg-white/30"></span>

                                            Profesional

                                        </span>

                                    @endif

                                </div>



                                {{-- VER PERFIL --}}

                                <a
                                    href="{{ route('profesionales.show', $profesional) }}"
                                    class="shrink-0 text-xs font-black text-horeca-dorado transition hover:underline"
                                >
                                    Ver perfil →
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>



            {{-- =====================================================
                 PAGINACIÓN
            ====================================================== --}}

            @if($profesionales->hasPages())

                <div class="mt-6 rounded-2xl border border-white/10 bg-[#111A29] p-4">

                    {{ $profesionales->links() }}

                </div>

            @endif


        @else


            {{-- =====================================================
                 SIN RESULTADOS
            ====================================================== --}}

            <div class="rounded-2xl border border-dashed border-white/10 bg-[#111A29] px-6 py-16 text-center">


                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 text-2xl">
                    🔎
                </div>


                <h3 class="mt-5 text-lg font-black">
                    No encontramos profesionales
                </h3>


                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-white/40">

                    No existen profesionales que coincidan con los
                    criterios de búsqueda seleccionados.

                </p>


                <a
                    href="{{ route('profesionales.index') }}"
                    class="mt-6 inline-flex rounded-xl border border-horeca-dorado/30 px-5 py-3 text-sm font-bold text-horeca-dorado transition hover:bg-horeca-dorado/10"
                >
                    Limpiar filtros
                </a>

            </div>

        @endif

    </section>

</div>

@endsection