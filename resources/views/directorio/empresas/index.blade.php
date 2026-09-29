@extends('layouts.dashboard')

@section('title', 'Directorio PRO')

@section('header-title', 'Directorio')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- CABECERA --}}

    <div>

        <p class="text-sm font-black uppercase tracking-[0.2em] text-horeca-dorado">
            HORECA PRO
        </p>

        <h1 class="mt-1 text-3xl font-black text-white">
            Directorio PRO
        </h1>

        <p class="mt-2 text-sm text-white/40">
            Conoce las empresas que forman parte de nuestra comunidad profesional.
        </p>

    </div>


    {{-- BUSCADOR --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <form
            method="GET"
            action="{{ route('directorio.empresas.index') }}"
            class="grid gap-3 md:grid-cols-[1fr_220px_auto]"
        >

            <div>

                <label class="mb-2 block text-sm font-black uppercase tracking-wider text-white/70">
                    Buscar empresa
                </label>

                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Nombre, razón social o tipo de empresa..."
                    class="w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm font-bold text-white outline-none placeholder:text-white/50 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                >

            </div>


            <div>

                <label class="mb-2 block text-sm font-black uppercase tracking-wider text-white/70">
                    Ciudad
                </label>

                <select
                    name="ciudad"
                    class="w-full rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-sm font-bold text-white outline-none focus:border-horeca-dorado"
                >

                    <option value="">
                        Todas las ciudades
                    </option>

                    @foreach($ciudades as $item)

                        <option
                            value="{{ $item }}"
                            @selected($ciudad === $item)
                        >
                            {{ $item }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="flex items-end">

                <button
                    type="submit"
                    class="w-full rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-[#07111F] transition hover:opacity-90 md:w-auto"
                >
                    🔎 Buscar
                </button>

            </div>

        </form>

    </div>


    {{-- RESULTADOS --}}

    <div class="flex items-center justify-between">

        <div>

            <p class="text-sm font-bold text-white">
                Empresas registradas
            </p>

            <p class="mt-1 text-sm text-white/70">
                {{ $empresas->total() }} empresas encontradas
            </p>

        </div>

    </div>


    @if($empresas->count())

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            @foreach($empresas as $empresa)

                <article
                    class="group rounded-3xl border border-white/10 bg-[#111A29] p-6 transition hover:border-horeca-dorado/30 hover:bg-white/[0.04]"
                >

                    {{-- CABECERA EMPRESA --}}

                    <div class="flex items-start gap-4">

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-xl font-black text-horeca-dorado">

                            {{ strtoupper(
                                substr(
                                    $empresa->nombre_comercial
                                        ?: $empresa->razon_social
                                        ?: 'E',
                                    0,
                                    1
                                )
                            ) }}

                        </div>


                        <div class="min-w-0 flex-1">

                            <h2 class="truncate text-lg font-black text-white">
                                {{ $empresa->nombre_comercial ?: $empresa->razon_social }}
                            </h2>

                            @if($empresa->tipo_empresa)

                                <p class="mt-1 text-sm font-bold text-horeca-dorado">
                                    {{ $empresa->tipo_empresa }}
                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- INFORMACIÓN --}}

                    <div class="mt-5 space-y-3">

                        @if($empresa->ciudad)

                            <div class="flex items-center gap-2 text-sm text-white/50">
                                <span>📍</span>
                                <span>
                                    {{ $empresa->ciudad }}
                                    @if($empresa->distrito)
                                        · {{ $empresa->distrito }}
                                    @endif
                                </span>
                            </div>

                        @endif


                        @if($empresa->descripcion)

                            <p class="line-clamp-3 text-sm leading-6 text-white/50">
                                {{ $empresa->descripcion }}
                            </p>

                        @endif

                    </div>


                    {{-- OPORTUNIDADES --}}

                    <div class="mt-5 flex items-center justify-between border-t border-white/10 pt-4">

                        <span class="text-sm font-bold text-white/70">
                            Oportunidades
                        </span>

                        <span class="rounded-lg bg-white/5 px-3 py-1 text-sm font-black text-white/70">
                            {{ $empresa->oportunidades->count() }}
                        </span>

                    </div>


                    {{-- BOTÓN --}}

                    <a
                        href="{{ route('directorio.empresas.show', $empresa) }}"
                        class="mt-4 flex w-full items-center justify-center rounded-xl border border-horeca-dorado/30 px-4 py-3 text-sm font-black text-horeca-dorado transition hover:bg-horeca-dorado hover:text-[#07111F]"
                    >
                        Ver empresa →
                    </a>

                </article>

            @endforeach

        </div>


        {{-- PAGINACIÓN --}}

        @if($empresas->hasPages())

            <div class="pt-3">
                {{ $empresas->links() }}
            </div>

        @endif

    @else

        <div class="rounded-3xl border border-white/10 bg-[#111A29] px-6 py-16 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-3xl">
                🏢
            </div>

            <h2 class="mt-5 text-xl font-black text-white">
                No encontramos empresas
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-white/40">
                Intenta cambiar los filtros de búsqueda.
            </p>

        </div>

    @endif

</div>

@endsection