@extends('layouts.dashboard')

@section('title', 'Profesionales')

@section('header-title', 'Profesionales')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- CABECERA --}}
    <div>
        <h1 class="text-2xl font-black text-white">
            Profesionales
        </h1>

        <p class="mt-1 text-sm text-white/70">
            Gestiona los profesionales registrados en HORECA PRO.
        </p>
    </div>


    {{-- ESTADÍSTICA --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

            <p class="text-sm font-bold uppercase tracking-wider text-white/70">
                Total profesionales
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $totalProfesionales }}
            </p>

        </div>


        <div class="rounded-2xl border border-green-500/20 bg-[#111A29] p-5">

            <p class="text-sm font-bold uppercase tracking-wider text-green-400">
                Activos
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $profesionales->getCollection()->where('user.estado', 'activo')->count() }}
            </p>

        </div>


        <div class="rounded-2xl border border-red-500/20 bg-[#111A29] p-5">

            <p class="text-sm font-bold uppercase tracking-wider text-red-400">
                Inactivos
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $profesionales->getCollection()->where('user.estado', 'inactivo')->count() }}
            </p>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <form
            method="GET"
            action="{{ route('admin.profesionales.index') }}"
            class="flex flex-col gap-3 md:flex-row">

            <div class="flex-1">

                <label class="mb-2 block text-sm font-bold text-white/70">
                    Buscar profesional
                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-white/70"></i>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ $buscar }}"
                        placeholder="Nombre, apellido, documento o especialidad..."
                        class="w-full rounded-xl border border-white/10 bg-[#0B1220] py-3 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-white/70 focus:border-horeca-dorado">

                </div>

            </div>


            <div class="flex items-end gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-black transition hover:opacity-90">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Buscar
                </button>


                @if($buscar)

                <a
                    href="{{ route('admin.profesionales.index') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white/60 transition hover:bg-white/10 hover:text-white">
                    Limpiar
                </a>

                @endif

            </div>

        </form>

    </div>


    {{-- TABLA --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#111A29]">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] text-left">

                <thead class="border-b border-white/10 bg-white/[0.02]">

                    <tr>

                        <th class="px-5 py-4 text-sm font-black uppercase tracking-wider text-white/70">
                            Profesional
                        </th>

                        <th class="px-5 py-4 text-sm font-black uppercase tracking-wider text-white/70">
                            Documento
                        </th>

                        <th class="px-5 py-4 text-sm font-black uppercase tracking-wider text-white/70">
                            Especialidad
                        </th>

                        <th class="px-5 py-4 text-sm font-black uppercase tracking-wider text-white/70">
                            Email
                        </th>

                        <th class="px-5 py-4 text-sm font-black uppercase tracking-wider text-white/70">
                            Estado
                        </th>

                        <th class="px-5 py-4 text-right text-sm font-black uppercase tracking-wider text-white/70">
                            Acción
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-white/5">

                    @forelse($profesionales as $profesional)

                    @php

                    $nombre = trim(
                    ($profesional->nombres ?? '') . ' ' .
                    ($profesional->apellidos ?? '')
                    );

                    $nombre = $nombre ?: (
                    $profesional->user?->name ?? 'Profesional'
                    );

                    $estado = $profesional->user?->estado ?? 'inactivo';

                    @endphp


                    <tr class="transition hover:bg-white/[0.02]">

                        {{-- PROFESIONAL --}}
                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div>

                                    <a
                                        href="{{ route('admin.profesionales.show', $profesional) }}"
                                        class="font-bold text-white transition hover:text-horeca-dorado">
                                        {{ $nombre }}
                                    </a>

                                </div>

                            </div>

                        </td>


                        {{-- DOCUMENTO --}}
                        <td class="px-5 py-4">

                            <span class="text-sm text-white/60">
                                {{ $profesional->numero_documento ?: '—' }}
                            </span>

                        </td>


                        {{-- ESPECIALIDAD --}}
                        <td class="px-5 py-4">

                            <span class="text-sm text-white/60">
                                {{ $profesional->especialidad ?: '—' }}
                            </span>

                        </td>


                        {{-- EMAIL --}}
                        <td class="px-5 py-4">

                            <span class="text-sm text-white/50">
                                {{ $profesional->user?->email ?: '—' }}
                            </span>

                        </td>


                        {{-- ESTADO --}}
                        <td class="px-5 py-4">

                            @if($estado === 'activo')

                            <span class="inline-flex items-center gap-2 rounded-full bg-green-500/10 px-3 py-1 text-sm font-bold text-green-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>

                                Activo

                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 rounded-full bg-red-500/10 px-3 py-1 text-sm font-bold text-red-400">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                Inactivo

                            </span>

                            @endif

                        </td>


                        {{-- ACCIÓN --}}
                        <td class="px-5 py-4">

                            <div class="flex justify-end">

                                <form
                                    method="POST"
                                    action="{{ route('admin.profesionales.estado', $profesional) }}">

                                    @csrf
                                    @method('PATCH')


                                    @if($estado === 'activo')

                                    <button
                                        type="submit"
                                        onclick="return confirm('¿Deseas inhabilitar a este profesional?')"
                                        class="inline-flex items-center rounded-xl bg-red-500/10 px-4 py-2 text-sm font-bold text-red-400 transition hover:bg-red-500/20">

                                        <i class="fa-solid fa-ban mr-2"></i>

                                        Inhabilitar

                                    </button>

                                    @else

                                    <button
                                        type="submit"
                                        onclick="return confirm('¿Deseas habilitar a este profesional?')"
                                        class="inline-flex items-center rounded-xl bg-green-500/10 px-4 py-2 text-sm font-bold text-green-400 transition hover:bg-green-500/20">

                                        <i class="fa-solid fa-check mr-2"></i>

                                        Habilitar

                                    </button>

                                    @endif

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-5 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 text-white/70">

                                    <i class="fa-solid fa-user-doctor text-2xl"></i>

                                </div>


                                <p class="mt-4 font-bold text-white">
                                    No se encontraron profesionales
                                </p>

                                <p class="mt-1 text-sm text-white/70">
                                    Prueba con otro término de búsqueda.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINACIÓN --}}
        @if($profesionales->hasPages())

        <div class="border-t border-white/10 px-5 py-4">

            {{ $profesionales->links() }}

        </div>

        @endif

    </div>

</div>

@endsection