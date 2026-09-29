@extends('layouts.dashboard')

@section('title', 'Oportunidades')

@section('header-title', 'Oportunidades')

@section('content')

<div class="space-y-6">

    {{-- CABECERA --}}
    <div>
        <p class="text-xs font-black uppercase tracking-[0.2em] text-horeca-dorado">
            HORECA PRO
        </p>

        <h1 class="mt-1 text-2xl font-black text-white">
            Oportunidades profesionales
        </h1>

        <p class="mt-1 text-md text-white/70">
            Encuentra oportunidades laborales publicadas por empresas HORECA.
        </p>
    </div>


    {{-- FILTROS --}}
    <form
        method="GET"
        action="{{ route('profesional.oportunidades.index') }}"
        class="rounded-2xl border border-white/10 bg-white/[0.03] p-5"
    >

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">

            {{-- BUSCAR --}}
            <div class="xl:col-span-2">

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Buscar
                </label>

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Cargo, área, palabra clave..."
                    class="w-full rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-md text-white outline-none placeholder:text-white/30 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                >

            </div>


            {{-- ÁREA --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Área
                </label>

                <select
                    name="area"
                    class="w-full appearance-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-md text-white outline-none focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                >

                    <option value="">Todas</option>

                    @foreach($areas as $item)

                        <option
                            value="{{ $item }}"
                            @selected($area === $item)
                        >
                            {{ $item }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- MODALIDAD --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Modalidad
                </label>

                <select
                    name="modalidad"
                    class="w-full appearance-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-md text-white outline-none focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                >

                    <option value="">Todas</option>

                    @foreach($modalidades as $item)

                        <option
                            value="{{ $item }}"
                            @selected($modalidad === $item)
                        >
                            {{ $item }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TIPO CONTRATO --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-white/70">
                    Contrato
                </label>

                <select
                    name="tipo_contrato"
                    class="w-full appearance-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-md text-white outline-none focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                >

                    <option value="">Todos</option>

                    @foreach($tiposContrato as $item)

                        <option
                            value="{{ $item }}"
                            @selected($tipoContrato === $item)
                        >
                            {{ $item }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        <div class="mt-4 flex flex-wrap gap-3">

            <button
                type="submit"
                class="rounded-xl bg-horeca-dorado px-5 py-3 text-md font-black text-[#07111F] transition hover:opacity-90"
            >
                Buscar oportunidades
            </button>


            <a
                href="{{ route('profesional.oportunidades.index') }}"
                class="rounded-xl border border-white/10 px-5 py-3 text-md font-bold text-white/60 transition hover:bg-white/5 hover:text-white"
            >
                Limpiar
            </a>

        </div>

    </form>


    {{-- RESULTADOS --}}
    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-lg font-black text-white">
                Oportunidades disponibles
            </h2>

            <p class="text-xs text-white/40">
                {{ $oportunidades->total() }}
                oportunidades encontradas
            </p>

        </div>

    </div>


    @if($oportunidades->count())

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            @foreach($oportunidades as $oportunidad)

                <article
                    class="group flex flex-col rounded-2xl border border-white/10 bg-white/[0.03] p-5 transition hover:border-horeca-dorado/40 hover:bg-white/[0.05]"
                >

                    {{-- EMPRESA --}}
                    <div class="mb-4 flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-horeca-dorado/10 text-md font-black text-horeca-dorado">
                            {{ strtoupper(substr($oportunidad->empresa->razon_social ?? 'E', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-xs font-bold text-white/70">
                                {{ $oportunidad->empresa->nombre_comercial
                                    ?? $oportunidad->empresa->razon_social
                                    ?? 'Empresa' }}
                            </p>

                            <p class="text-[11px] text-white/30">
                                {{ $oportunidad->ubicacion ?: 'Ubicación no especificada' }}
                            </p>

                        </div>

                    </div>


                    {{-- TÍTULO --}}
                    <h3 class="text-lg font-black text-white transition group-hover:text-horeca-dorado">
                        {{ $oportunidad->titulo }}
                    </h3>


                    {{-- ÁREA --}}
                    @if($oportunidad->area)

                        <p class="mt-1 text-md font-bold text-horeca-dorado">
                            {{ $oportunidad->area }}
                        </p>

                    @endif


                    {{-- DESCRIPCIÓN --}}
                    @if($oportunidad->descripcion)

                        <p class="mt-4 line-clamp-3 text-md leading-6 text-white/70">
                            {{ $oportunidad->descripcion }}
                        </p>

                    @endif


                    {{-- INFORMACIÓN --}}
                    <div class="mt-5 flex flex-wrap gap-2">

                        @if($oportunidad->modalidad)

                            <span class="rounded-lg bg-white/5 px-3 py-1.5 text-[11px] font-bold text-white/60">
                                {{ $oportunidad->modalidad }}
                            </span>

                        @endif


                        @if($oportunidad->tipo_contrato)

                            <span class="rounded-lg bg-white/5 px-3 py-1.5 text-[11px] font-bold text-white/60">
                                {{ $oportunidad->tipo_contrato }}
                            </span>

                        @endif

                    </div>


                    {{-- SALARIO --}}
                    @if($oportunidad->mostrar_salario)

                        <div class="mt-4 text-md font-black text-white">

                            @if($oportunidad->salario_min && $oportunidad->salario_max)

                                S/ {{ number_format($oportunidad->salario_min, 0) }}
                                -
                                S/ {{ number_format($oportunidad->salario_max, 0) }}

                            @elseif($oportunidad->salario_min)

                                Desde S/ {{ number_format($oportunidad->salario_min, 0) }}

                            @elseif($oportunidad->salario_max)

                                Hasta S/ {{ number_format($oportunidad->salario_max, 0) }}

                            @endif

                        </div>

                    @endif


                    {{-- FOOTER --}}
                    <div class="mt-6 flex items-center justify-between border-t border-white/10 pt-4">

                        @if($oportunidad->fecha_cierre)

                            <span class="text-[11px] text-white/30">
                                Cierra:
                                {{ $oportunidad->fecha_cierre->format('d/m/Y') }}
                            </span>

                        @else

                            <span class="text-[11px] text-white/30">
                                Convocatoria abierta
                            </span>

                        @endif


                        <a
                            href="{{ route('profesional.oportunidades.show', $oportunidad) }}"
                            class="text-xs font-black text-horeca-dorado hover:underline"
                        >
                            Ver oportunidad →
                        </a>

                    </div>

                </article>

            @endforeach

        </div>


        {{-- PAGINACIÓN --}}
        <div class="pt-3">
            {{ $oportunidades->links() }}
        </div>

    @else

        <div class="rounded-2xl border border-dashed border-white/10 bg-white/[0.02] px-6 py-16 text-center">

            <div class="text-4xl">
                🔎
            </div>

            <h3 class="mt-4 text-lg font-black text-white">
                No encontramos oportunidades
            </h3>

            <p class="mx-auto mt-2 max-w-md text-md text-white/40">
                Prueba cambiando los filtros o realizando una búsqueda diferente.
            </p>

        </div>

    @endif

</div>

@endsection