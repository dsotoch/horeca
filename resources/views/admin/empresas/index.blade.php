@extends('layouts.dashboard')

@section('title', 'Empresas')

@section('header-title', 'Empresas')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- CABECERA --}}
    <div>
        <h1 class="text-2xl font-black text-white">
            Empresas
        </h1>

        <p class="mt-1 text-sm text-white/40">
            Gestiona las empresas registradas en HORECA PRO.
        </p>
    </div>


    {{-- ESTADÍSTICAS --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-white/40">
                Total
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $totalEmpresas }}
            </p>
        </div>


        <div class="rounded-2xl border border-yellow-500/20 bg-[#111A29] p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-yellow-400">
                Pendientes
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $pendientes }}
            </p>
        </div>


        <div class="rounded-2xl border border-green-500/20 bg-[#111A29] p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-green-400">
                Validadas
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $validadas }}
            </p>
        </div>


        <div class="rounded-2xl border border-red-500/20 bg-[#111A29] p-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-red-400">
                Observadas
            </p>

            <p class="mt-2 text-3xl font-black text-white">
                {{ $observadas }}
            </p>
        </div>

    </div>


    {{-- FILTROS --}}
    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <form
            method="GET"
            action="{{ route('admin.empresas.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-3"
        >

            {{-- BUSCAR --}}
            <div class="md:col-span-2">

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Buscar empresa
                </label>

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Razón social, nombre comercial, RUC o email..."
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none transition focus:border-horeca-dorado"
                >

            </div>


            {{-- ESTADO --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Estado
                </label>

                <select
                    name="estado"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

                    <option value="">
                        Todos
                    </option>

                    <option
                        value="pendiente"
                        @selected($estado === 'pendiente')
                    >
                        Pendientes
                    </option>

                    <option
                        value="validado"
                        @selected($estado === 'validado')
                    >
                        Validadas
                    </option>

                    <option
                        value="observado"
                        @selected($estado === 'observado')
                    >
                        Observadas
                    </option>

                </select>

            </div>


            {{-- BOTONES --}}
            <div class="md:col-span-3 flex gap-3">

                <button
                    type="submit"
                    class="rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-black transition hover:opacity-90"
                >
                    <i class="fa-solid fa-filter mr-2"></i>
                    Filtrar
                </button>

                <a
                    href="{{ route('admin.empresas.index') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white"
                >
                    Limpiar
                </a>

            </div>

        </form>

    </div>


    {{-- TABLA --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#111A29]">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b border-white/10 bg-white/[0.02]">

                    <tr>

                        <th class="px-5 py-4 text-xs font-black uppercase tracking-wider text-white/40">
                            Empresa
                        </th>

                        <th class="px-5 py-4 text-xs font-black uppercase tracking-wider text-white/40">
                            RUC
                        </th>

                        <th class="px-5 py-4 text-xs font-black uppercase tracking-wider text-white/40">
                            Ubicación
                        </th>

                        <th class="px-5 py-4 text-xs font-black uppercase tracking-wider text-white/40">
                            Estado
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-black uppercase tracking-wider text-white/40">
                            Acción
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-white/5">

                    @forelse($empresas as $empresa)

                        <tr class="transition hover:bg-white/[0.02]">

                            {{-- EMPRESA --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">

                                        <i class="fa-solid fa-building"></i>

                                    </div>

                                    <div>

                                        <p class="font-bold text-white">
                                            {{ $empresa->nombre_comercial ?: $empresa->razon_social }}
                                        </p>

                                        @if($empresa->nombre_comercial && $empresa->razon_social)
                                            <p class="mt-1 text-xs text-white/70">
                                                {{ $empresa->razon_social }}
                                            </p>
                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- RUC --}}
                            <td class="px-5 py-4 text-sm text-white/60">
                                {{ $empresa->ruc ?: '—' }}
                            </td>


                            {{-- UBICACIÓN --}}
                            <td class="px-5 py-4">

                                <p class="text-sm text-white/70">
                                    {{ $empresa->ciudad ?: '—' }}
                                </p>

                                @if($empresa->departamento)
                                    <p class="text-xs text-white/70">
                                        {{ $empresa->departamento }}
                                    </p>
                                @endif

                            </td>


                            {{-- ESTADO --}}
                            <td class="px-5 py-4">

                                @if($empresa->estado_validacion === 'validado')

                                    <span class="inline-flex rounded-full bg-green-500/10 px-3 py-1 text-xs font-bold text-green-400">
                                        Validada
                                    </span>

                                @elseif($empresa->estado_validacion === 'observado')

                                    <span class="inline-flex rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                                        Observada
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                                        Pendiente
                                    </span>

                                @endif

                            </td>


                            {{-- ACCIÓN --}}
                            <td class="px-5 py-4 text-right">

                                <a
                                    href="{{ route('admin.empresas.show', $empresa) }}"
                                    class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-xs font-bold text-white transition hover:bg-white/10"
                                >
                                    Ver empresa
                                    <i class="fa-solid fa-arrow-right ml-2"></i>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-5 py-12 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-white/20">
                                        <i class="fa-solid fa-building text-xl"></i>
                                    </div>

                                    <p class="mt-4 font-bold text-white">
                                        No se encontraron empresas
                                    </p>

                                    <p class="mt-1 text-sm text-white/70">
                                        Intenta modificar los filtros de búsqueda.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINACIÓN --}}
        @if($empresas->hasPages())

            <div class="border-t border-white/10 px-5 py-4">

                {{ $empresas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection