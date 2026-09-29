@extends('layouts.dashboard')

@section('title', 'Mis postulaciones')

@section('header-title', 'Mis postulaciones')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- ========================================================= --}}
    {{-- CABECERA --}}
    {{-- ========================================================= --}}

    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden">

        <div class="p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-xl
                                    bg-[#C9A44D]/15
                                    flex items-center justify-center">

                            <i class="fa-solid fa-file-signature text-[#C9A44D] text-xl"></i>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-horeca-titulos">
                                Mis postulaciones
                            </h2>

                            <p class="text-gray-400 mt-1">
                                Consulta y realiza seguimiento a tus oportunidades laborales.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- CONTADOR --}}

                <div class="flex items-center gap-3">

                    <div class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-center">

                        <p class="text-2xl font-bold text-[#C9A44D]">
                            {{ $postulaciones->count() }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Postulaciones
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FILTROS --}}
    {{-- ========================================================= --}}

    <div class="bg-white/5 rounded-2xl border border-white/10">

        <div class="p-5">

            <form
                method="GET"
                action="{{ url()->current() }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- BUSCAR --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Buscar
                    </label>

                    <div class="relative">

                        <i class="fa-solid fa-magnifying-glass
                                  absolute left-4 top-1/2
                                  -translate-y-1/2
                                  text-gray-500">
                        </i>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar por puesto o empresa..."
                            class="w-full rounded-xl
                                   border border-gray-600
                                   bg-horeca-fondo
                                   text-white
                                   pl-11 pr-4 py-3
                                   focus:border-[#C9A44D]
                                   focus:ring-[#C9A44D]">

                    </div>

                </div>


                {{-- ESTADO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-xl
                               border border-gray-600
                               bg-horeca-fondo
                               text-white
                               px-4 py-3
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                        <option value="">
                            Todos los estados
                        </option>

                        <option
                            value="pendiente"
                            @selected(request('estado') === 'pendiente')>
                            Pendiente
                        </option>

                        <option
                            value="revision"
                            @selected(request('estado') === 'revision')>
                            En revisión
                        </option>

                        <option
                            value="aceptada"
                            @selected(request('estado') === 'aceptada')>
                            Aceptada
                        </option>

                        <option
                            value="rechazada"
                            @selected(request('estado') === 'rechazada')>
                            Rechazada
                        </option>

                    </select>

                </div>


                {{-- BOTÓN --}}

                <div class="md:col-span-3 flex justify-end">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 px-5 py-3 rounded-xl
                               bg-horeca-dorado
                               text-black
                               font-semibold
                               hover:bg-horeca-dorado2
                               transition">

                        <i class="fa-solid fa-filter"></i>

                        Filtrar

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- LISTADO --}}
    {{-- ========================================================= --}}

    <div class="space-y-4">

        @forelse($postulaciones as $postulacion)

            @php

                $estado = strtolower($postulacion->estado ?? 'pendiente');

                $configEstado = match($estado) {

                    'aceptada', 'aceptado' => [
                        'texto' => 'Aceptada',
                        'clase' => 'bg-green-500/10 text-green-400 border-green-500/20',
                        'icono' => 'fa-circle-check',
                    ],

                    'rechazada', 'rechazado' => [
                        'texto' => 'Rechazada',
                        'clase' => 'bg-red-500/10 text-red-400 border-red-500/20',
                        'icono' => 'fa-circle-xmark',
                    ],

                    'revision', 'en_revision', 'en revisión' => [
                        'texto' => 'En revisión',
                        'clase' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                        'icono' => 'fa-clock',
                    ],

                    default => [
                        'texto' => 'Pendiente',
                        'clase' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                        'icono' => 'fa-hourglass-half',
                    ],

                };

            @endphp


            <div class="bg-white/5 rounded-2xl
                        border border-white/10
                        overflow-hidden
                        hover:border-[#C9A44D]/40
                        transition">

                <div class="p-6">

                    <div class="flex flex-col lg:flex-row
                                lg:items-center
                                lg:justify-between
                                gap-5">


                        {{-- ================================================= --}}
                        {{-- INFORMACIÓN --}}
                        {{-- ================================================= --}}

                        <div class="flex items-start gap-4">

                            {{-- LOGO EMPRESA --}}

                            <div class="w-14 h-14 rounded-xl
                                        bg-[#0C1C3C]
                                        flex items-center justify-center
                                        flex-shrink-0">

                                @if(!empty($postulacion->empresa?->logo))

                                    <img
                                        src="{{ asset('storage/' . $postulacion->empresa->logo) }}"
                                        alt="Logo"
                                        class="w-full h-full
                                               object-cover
                                               rounded-xl">

                                @else

                                    <i class="fa-solid fa-building
                                              text-[#C9A44D]
                                              text-xl">
                                    </i>

                                @endif

                            </div>


                            {{-- DATOS --}}

                            <div class="min-w-0">

                                <h3 class="text-lg font-bold text-white">

                                    {{ $postulacion->vacante->titulo
                                        ?? $postulacion->puesto
                                        ?? 'Oportunidad laboral' }}

                                </h3>


                                <p class="text-[#C9A44D] font-medium mt-1">

                                    {{ $postulacion->empresa->nombre
                                        ?? $postulacion->empresa_nombre
                                        ?? 'Empresa HORECA' }}

                                </p>


                                <div class="flex flex-wrap items-center gap-3
                                            mt-3 text-sm text-gray-400">

                                    @if(!empty($postulacion->modalidad))

                                        <span class="inline-flex items-center gap-1.5">

                                            <i class="fa-solid fa-location-dot"></i>

                                            {{ ucfirst($postulacion->modalidad) }}

                                        </span>

                                    @endif


                                    @if(!empty($postulacion->ciudad))

                                        <span class="inline-flex items-center gap-1.5">

                                            <i class="fa-solid fa-map-marker-alt"></i>

                                            {{ $postulacion->ciudad }}

                                        </span>

                                    @endif


                                    @if(!empty($postulacion->created_at))

                                        <span class="inline-flex items-center gap-1.5">

                                            <i class="fa-regular fa-calendar"></i>

                                            {{ $postulacion->created_at->format('d/m/Y') }}

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ESTADO --}}
                        {{-- ================================================= --}}

                        <div>

                            <span class="inline-flex items-center gap-2
                                         px-4 py-2 rounded-full
                                         border
                                         text-sm font-semibold
                                         {{ $configEstado['clase'] }}">

                                <i class="fa-solid {{ $configEstado['icono'] }}"></i>

                                {{ $configEstado['texto'] }}

                            </span>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- DETALLE --}}
                    {{-- ================================================= --}}

                    <div class="mt-5 pt-5
                                border-t border-white/10
                                flex flex-col md:flex-row
                                md:items-center
                                md:justify-between
                                gap-4">


                        <div class="flex flex-wrap gap-2">

                            @if(!empty($postulacion->vacante?->tipo_contrato))

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1.5 rounded-lg
                                             bg-white/5
                                             text-xs text-gray-300">

                                    <i class="fa-solid fa-file-contract
                                              text-[#C9A44D]">
                                    </i>

                                    {{ ucfirst($postulacion->vacante->tipo_contrato) }}

                                </span>

                            @endif


                            @if(!empty($postulacion->vacante?->salario))

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1.5 rounded-lg
                                             bg-white/5
                                             text-xs text-gray-300">

                                    <i class="fa-solid fa-money-bill-wave
                                              text-[#C9A44D]">
                                    </i>

                                    {{ $postulacion->vacante->salario }}

                                </span>

                            @endif

                        </div>


                        {{-- ACCIONES --}}

                        <div class="flex flex-wrap gap-2">

                            @if(!empty($postulacion->vacante_id))

                                <a
                                    href="{{ route('vacantes.show', $postulacion->vacante_id) }}"
                                    class="inline-flex items-center justify-center
                                           gap-2 px-4 py-2 rounded-lg
                                           border border-gray-600
                                           text-gray-300
                                           text-sm font-semibold
                                           hover:bg-white/5
                                           hover:text-white
                                           transition">

                                    <i class="fa-solid fa-eye"></i>

                                    Ver oportunidad

                                </a>

                            @endif


                            @if(!empty($postulacion->id))

                                <a
                                    href="{{ route('postulaciones.show', $postulacion->id) }}"
                                    class="inline-flex items-center justify-center
                                           gap-2 px-4 py-2 rounded-lg
                                           bg-horeca-dorado
                                           text-black
                                           text-sm font-semibold
                                           hover:bg-horeca-dorado2
                                           transition">

                                    <i class="fa-solid fa-arrow-right"></i>

                                    Ver postulación

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            {{-- ========================================================= --}}
            {{-- SIN POSTULACIONES --}}
            {{-- ========================================================= --}}

            <div class="bg-white/5 rounded-2xl
                        border border-white/10
                        p-12 text-center">

                <div class="w-20 h-20 mx-auto
                            rounded-2xl
                            bg-[#C9A44D]/10
                            flex items-center justify-center">

                    <i class="fa-solid fa-file-signature
                              text-[#C9A44D]
                              text-3xl">
                    </i>

                </div>

                <h3 class="text-xl font-bold text-white mt-5">
                    Aún no tienes postulaciones
                </h3>

                <p class="text-gray-400 max-w-md mx-auto mt-2">
                    Explora las oportunidades disponibles y encuentra
                    una posición que se adapte a tu experiencia.
                </p>

                <a
                    href="{{ route('oportunidades.index') }}"
                    class="inline-flex items-center justify-center
                           gap-2 mt-6 px-6 py-3
                           rounded-xl
                           bg-horeca-dorado
                           text-black
                           font-semibold
                           hover:bg-horeca-dorado2
                           transition">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Explorar oportunidades

                </a>

            </div>

        @endforelse

    </div>


    {{-- ========================================================= --}}
    {{-- PAGINACIÓN --}}
    {{-- ========================================================= --}}

    @if(method_exists($postulaciones, 'links'))

        <div class="pt-2">

            {{ $postulaciones->withQueryString()->links() }}

        </div>

    @endif

</div>

@endsection