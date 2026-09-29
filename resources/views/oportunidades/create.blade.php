@extends('layouts.dashboard')

@section('title', 'Oportunidades')

@section('header-title', 'Oportunidades')

@section('menu')

    <nav class="space-y-2">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-white/60 hover:bg-white/5 hover:text-white"
        >
            <span>⌂ &nbsp; Inicio</span>
        </a>

        <a
            href="{{ route('oportunidades.index') }}"
            class="flex items-center rounded-xl bg-horeca-dorado px-4 py-3 text-sm font-bold text-black"
        >
            <span>💼 &nbsp; Mis oportunidades</span>
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

    </nav>

@endsection


@section('content')

<div class="max-w-5xl">

    <div class="mb-8">

        <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
            HORECA PRO
        </p>

        <h2 class="mt-2 text-3xl font-black">
            Publicar oportunidad
        </h2>

        <p class="mt-2 text-sm text-white/70">
            Encuentra profesionales especializados para tu empresa.
        </p>

    </div>


    {{-- ERRORES --}}

    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-5 text-red-300">

            <p class="font-bold">
                Hay algunos errores en el formulario:
            </p>

            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('oportunidades.store') }}"
        method="POST"
        class="space-y-6"
    >

        @csrf


        {{-- INFORMACIÓN PRINCIPAL --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <h3 class="text-lg font-bold">
                Información de la oportunidad
            </h3>

            <p class="mt-1 text-sm text-white/80">
                Describe el puesto que necesita cubrir tu empresa.
            </p>


            <div class="mt-6 grid gap-5 md:grid-cols-2">


                <div class="md:col-span-2">

                    <label class="text-sm font-semibold">
                        Título de la oportunidad
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo') }}"
                        placeholder="Ej. Chef Ejecutivo"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Área
                    </label>

                    <select
                        name="area"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                        <option value="">
                            Seleccionar
                        </option>

                        <option value="Gastronomía"
                            @selected(old('area') === 'Gastronomía')>
                            Gastronomía
                        </option>

                        <option value="Hotelería"
                            @selected(old('area') === 'Hotelería')>
                            Hotelería
                        </option>

                        <option value="Turismo"
                            @selected(old('area') === 'Turismo')>
                            Turismo
                        </option>

                        <option value="Administración"
                            @selected(old('area') === 'Administración')>
                            Administración
                        </option>

                        <option value="Operaciones"
                            @selected(old('area') === 'Operaciones')>
                            Operaciones
                        </option>

                    </select>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Tipo de contrato
                    </label>

                    <select
                        name="tipo_contrato"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                        <option value="">
                            Seleccionar
                        </option>

                        <option value="tiempo_completo">
                            Tiempo completo
                        </option>

                        <option value="medio_tiempo">
                            Medio tiempo
                        </option>


                        <option value="temporal">
                            Temporal
                        </option>

                        <option value="practicas">
                            Prácticas
                        </option>

                    </select>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Modalidad
                    </label>

                    <select
                        name="modalidad"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                        <option value="">
                            Seleccionar
                        </option>

                        <option value="presencial">
                            Presencial
                        </option>

                        <option value="hibrido">
                            Híbrido
                        </option>

                        <option value="remoto">
                            Remoto
                        </option>

                    </select>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Ubicación
                    </label>

                    <input
                        type="text"
                        name="ubicacion"
                        value="{{ old('ubicacion') }}"
                        placeholder="Ej. Miraflores, Lima"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                </div>

            </div>

        </div>


        {{-- DESCRIPCIÓN --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <h3 class="text-lg font-bold">
                Descripción
            </h3>

            <div class="mt-5 space-y-5">


                <div>

                    <label class="text-sm font-semibold">
                        Descripción de la oportunidad
                    </label>

                    <textarea
                        name="descripcion"
                        rows="5"
                        placeholder="Describe la posición y lo que busca tu empresa..."
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >{{ old('descripcion') }}</textarea>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Funciones principales
                    </label>

                    <textarea
                        name="funciones"
                        rows="5"
                        placeholder="Describe las principales funciones..."
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >{{ old('funciones') }}</textarea>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Requisitos
                    </label>

                    <textarea
                        name="requisitos"
                        rows="5"
                        placeholder="Experiencia, formación, conocimientos, habilidades..."
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >{{ old('requisitos') }}</textarea>

                </div>

            </div>

        </div>


        {{-- CONDICIONES --}}

        <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

            <h3 class="text-lg font-bold">
                Condiciones
            </h3>


            <div class="mt-5 grid gap-5 md:grid-cols-2">


                <div>

                    <label class="text-sm font-semibold">
                        Salario mínimo
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="salario_min"
                        value="{{ old('salario_min') }}"
                        placeholder="0.00"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Salario máximo
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="salario_max"
                        value="{{ old('salario_max') }}"
                        placeholder="0.00"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                </div>


                <div>

                    <label class="flex items-center gap-3">

                        <input
                            type="checkbox"
                            name="mostrar_salario"
                            value="1"
                            @checked(old('mostrar_salario'))
                            class="h-4 w-4 rounded border-white/20 bg-[#182337] text-horeca-dorado"
                        >

                        <span class="text-sm">
                            Mostrar salario a los profesionales
                        </span>

                    </label>

                </div>


                <div>

                    <label class="text-sm font-semibold">
                        Fecha de cierre
                    </label>

                    <input
                        type="date"
                        name="fecha_cierre"
                        value="{{ old('fecha_cierre') }}"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-[#182337] px-4 py-3 text-sm outline-none focus:border-horeca-dorado"
                    >

                </div>

            </div>

        </div>


        {{-- BOTONES --}}

        <div class="flex flex-wrap justify-end gap-3">

            <a
                href="{{ route('oportunidades.index') }}"
                class="rounded-xl border border-white/10 bg-[#111A29] px-6 py-3 text-sm font-bold"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-black hover:opacity-90"
            >
                Publicar oportunidad →
            </button>

        </div>

    </form>

</div>

@endsection