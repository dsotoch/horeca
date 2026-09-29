@extends('layouts.dashboard')

@section('title', 'Oportunidades')

@section('header-title', 'Oportunidades')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- =========================================================
         CABECERA
    ========================================================== --}}

    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">

        <div>
            <p class="text-sm font-semibold text-horeca-dorado">
                ADMINISTRACIÓN
            </p>

            <h1 class="mt-1 text-2xl font-black text-white">
                Oportunidades laborales
            </h1>

            <p class="mt-1 text-sm text-white/50">
                Supervisa las oportunidades publicadas por las empresas.
            </p>
        </div>

    </div>


    {{-- =========================================================
         ESTADÍSTICAS
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-white/50">
                        Total
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $totalOportunidades }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/10">
                    <i class="fa-solid fa-briefcase text-xl text-white"></i>
                </div>

            </div>

        </div>


        {{-- PUBLICADAS --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-white/50">
                        Publicadas
                    </p>

                    <p class="mt-2 text-3xl font-black text-emerald-400">
                        {{ $publicadas }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-400"></i>
                </div>

            </div>

        </div>


        {{-- CERRADAS --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-white/50">
                        Cerradas
                    </p>

                    <p class="mt-2 text-3xl font-black text-orange-400">
                        {{ $cerradas }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-500/10">
                    <i class="fa-solid fa-lock text-xl text-orange-400"></i>
                </div>

            </div>

        </div>


        {{-- POSTULACIONES --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-white/50">
                        Postulaciones
                    </p>

                    <p class="mt-2 text-3xl font-black text-horeca-dorado">
                        {{ $totalPostulaciones }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-horeca-dorado/10">
                    <i class="fa-solid fa-paper-plane text-xl text-horeca-dorado"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTROS
    ========================================================== --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <form
            method="GET"
            action="{{ route('admin.oportunidades.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-3"
        >

            {{-- BUSCAR --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-semibold text-white/70">
                    Buscar
                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-white/60"></i>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ $buscar }}"
                        placeholder="Título, área, ubicación o empresa..."
                        class="w-full rounded-xl border border-white/10 bg-[#0B1220] py-3 pl-11 pr-4 text-sm text-white placeholder-white/30 outline-none transition focus:border-horeca-dorado"
                    >

                </div>

            </div>


            {{-- ESTADO --}}

            <div>

                <label class="mb-2 block text-sm font-semibold text-white/70">
                    Estado
                </label>

                <select
                    name="estado"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

                    <option value="">
                        Todos los estados
                    </option>

                    <option
                        value="publicada"
                        @selected($estado === 'publicada')
                    >
                        Publicadas
                    </option>

                    <option
                        value="cerrada"
                        @selected($estado === 'cerrada')
                    >
                        Cerradas
                    </option>

                </select>

            </div>


            {{-- BOTONES --}}

            <div class="md:col-span-3 flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-[#111827] transition hover:brightness-110"
                >
                    <i class="fa-solid fa-filter"></i>
                    Filtrar
                </button>

                <a
                    href="{{ route('admin.oportunidades.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                    Limpiar
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
         TABLA
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#111A29]">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[950px]">

                <thead class="border-b border-white/10 bg-white/[0.03]">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-white/60">
                            Oportunidad
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-white/60">
                            Empresa
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-white/60">
                            Modalidad
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-white/60">
                            Contrato
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider text-white/60">
                            Postulaciones
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider text-white/60">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-white/60">
                            Acción
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-white/5">

                    @forelse($oportunidades as $oportunidad)

                        @php
                            $empresa = $oportunidad->empresa;

                            $nombreEmpresa =
                                $empresa?->nombre_comercial
                                ?? $empresa?->razon_social
                                ?? 'Empresa';

                            $estadoOportunidad = $oportunidad->estado;
                        @endphp

                        <tr class="transition hover:bg-white/[0.025]">

                            {{-- OPORTUNIDAD --}}

                            <td class="px-6 py-5">

                                <a
                                    href="{{ route('admin.oportunidades.show', $oportunidad) }}"
                                    class="font-bold text-white transition hover:text-horeca-dorado"
                                >
                                    {{ $oportunidad->titulo }}
                                </a>

                                @if($oportunidad->area)

                                    <p class="mt-1 text-xs text-white/60">
                                        {{ $oportunidad->area }}
                                    </p>

                                @endif

                                @if($oportunidad->ubicacion)

                                    <p class="mt-1 text-xs text-white/60">
                                        <i class="fa-solid fa-location-dot mr-1"></i>
                                        {{ $oportunidad->ubicacion }}
                                    </p>

                                @endif

                            </td>


                            {{-- EMPRESA --}}

                            <td class="px-6 py-5">

                                @if($empresa)

                                    <p class="font-semibold text-white/80">
                                        {{ $nombreEmpresa }}
                                    </p>

                                    @if($empresa->ruc)

                                        <p class="mt-1 text-xs text-white/35">
                                            RUC: {{ $empresa->ruc }}
                                        </p>

                                    @endif

                                @else

                                    <span class="text-sm text-red-400">
                                        Empresa no disponible
                                    </span>

                                @endif

                            </td>


                            {{-- MODALIDAD --}}

                            <td class="px-6 py-5">

                                <span class="text-sm text-white/70">
                                    {{ $oportunidad->modalidad ?: '—' }}
                                </span>

                            </td>


                            {{-- CONTRATO --}}

                            <td class="px-6 py-5">

                                <span class="text-sm text-white/70">
                                    {{ $oportunidad->tipo_contrato ?: '—' }}
                                </span>

                            </td>


                            {{-- POSTULACIONES --}}

                            <td class="px-6 py-5 text-center">

                                <span class="inline-flex min-w-8 items-center justify-center rounded-full bg-horeca-dorado/10 px-3 py-1 text-sm font-black text-horeca-dorado">
                                    {{ $oportunidad->postulaciones_count }}
                                </span>

                            </td>


                            {{-- ESTADO --}}

                            <td class="px-6 py-5 text-center">

                                @if($estadoOportunidad === 'publicada')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-bold text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                        Publicada
                                    </span>

                                @elseif($estadoOportunidad === 'cerrada')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-500/10 px-3 py-1.5 text-xs font-bold text-orange-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>
                                        Cerrada
                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1.5 text-xs font-bold text-white/60">
                                        {{ ucfirst($estadoOportunidad ?: 'Sin estado') }}
                                    </span>

                                @endif

                            </td>


                            {{-- ACCIONES --}}

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- VER --}}

                                    <a
                                        href="{{ route('admin.oportunidades.show', $oportunidad) }}"
                                        title="Ver oportunidad"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 text-white/60 transition hover:bg-white/10 hover:text-white"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    {{-- CAMBIAR ESTADO --}}

                                    <form
                                        method="POST"
                                        action="{{ route('admin.oportunidades.estado', $oportunidad) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        @if($estadoOportunidad === 'publicada')

                                            <button
                                                type="submit"
                                                title="Cerrar oportunidad"
                                                onclick="return confirm('¿Deseas cerrar esta oportunidad?')"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-500/10 text-orange-400 transition hover:bg-orange-500/20"
                                            >
                                                <i class="fa-solid fa-lock"></i>
                                            </button>

                                        @else

                                            <button
                                                type="submit"
                                                title="Publicar oportunidad"
                                                onclick="return confirm('¿Deseas publicar nuevamente esta oportunidad?')"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400 transition hover:bg-emerald-500/20"
                                            >
                                                <i class="fa-solid fa-unlock"></i>
                                            </button>

                                        @endif

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5">

                                    <i class="fa-solid fa-briefcase text-2xl text-white/20"></i>

                                </div>

                                <p class="mt-4 font-bold text-white">
                                    No se encontraron oportunidades
                                </p>

                                <p class="mt-1 text-sm text-white/60">
                                    Prueba cambiando los filtros de búsqueda.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINACIÓN --}}

        @if($oportunidades->hasPages())

            <div class="border-t border-white/10 px-6 py-4">

                {{ $oportunidades->links() }}

            </div>

        @endif

    </div>

</div>

@endsection