@extends('layouts.dashboard')

@section('title', 'Oportunidades')

@section('header-title', 'Oportunidades')




@section('content')

<div>

    <div class="mb-8">

        <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
            HORECA PRO
        </p>

        <h2 class="mt-2 text-3xl font-black">
            Editar oportunidad
        </h2>

        <p class="mt-1 text-sm text-white/70">
            Actualiza la información de tu oportunidad.
        </p>

    </div>


    {{-- ERRORES DE VALIDACIÓN --}}

    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-300">

            <ul class="list-disc space-y-1 pl-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('oportunidades.update', $oportunidad) }}"
        method="POST"
        class="rounded-2xl border border-white/10 bg-[#111A29] p-6"
    >

        @csrf

        @method('PUT')


        <div class="grid gap-6 md:grid-cols-2">


            {{-- TÍTULO --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-bold">
                    Título de la oportunidad
                </label>

                <input
                    type="text"
                    name="titulo"
                    value="{{ old('titulo', $oportunidad->titulo) }}"
                    required
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


            {{-- ÁREA --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Área
                </label>

                <input
                    type="text"
                    name="area"
                    value="{{ old('area', $oportunidad->area) }}"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


            {{-- TIPO CONTRATO --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Tipo de contrato
                </label>

                <select
                    name="tipo_contrato"
                    class="w-full rounded-xl border border-white/10 bg-horeca-fondo
                                           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20 px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

                    <option value="">Seleccionar</option>

                    <option value="tiempo_completo"
                        @selected(old('tipo_contrato', $oportunidad->tipo_contrato) === 'tiempo_completo')>
                        Tiempo completo
                    </option>

                    <option value="medio_tiempo"
                        @selected(old('tipo_contrato', $oportunidad->tipo_contrato) === 'medio_tiempo')>
                        Medio tiempo
                    </option>

                    <option value="temporal"
                        @selected(old('tipo_contrato', $oportunidad->tipo_contrato) === 'temporal')>
                        Temporal
                    </option>

                    <option value="practicas"
                        @selected(old('tipo_contrato', $oportunidad->tipo_contrato) === 'practicas')>
                        Prácticas
                    </option>

                </select>

            </div>


            {{-- MODALIDAD --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Modalidad
                </label>

                <select
                    name="modalidad"
                    class="w-full rounded-xl border border-white/10 bg-horeca-fondo
                                           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20 px-4 py-3 text-sm  outline-none focus:border-horeca-dorado"
                >

                    <option value="">Seleccionar</option>

                    <option value="presencial"
                        @selected(old('modalidad', $oportunidad->modalidad) === 'presencial')>
                        Presencial
                    </option>

                    <option value="hibrido"
                        @selected(old('modalidad', $oportunidad->modalidad) === 'hibrido')>
                        Híbrido
                    </option>

                    <option value="remoto"
                        @selected(old('modalidad', $oportunidad->modalidad) === 'remoto')>
                        Remoto
                    </option>

                </select>

            </div>


            {{-- UBICACIÓN --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Ubicación
                </label>

                <input
                    type="text"
                    name="ubicacion"
                    value="{{ old('ubicacion', $oportunidad->ubicacion) }}"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


            {{-- DESCRIPCIÓN --}}

            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-bold">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    rows="5"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >{{ old('descripcion', $oportunidad->descripcion) }}</textarea>

            </div>


            {{-- FUNCIONES --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Funciones
                </label>

                <textarea
                    name="funciones"
                    rows="6"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >{{ old('funciones', $oportunidad->funciones) }}</textarea>

            </div>


            {{-- REQUISITOS --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Requisitos
                </label>

                <textarea
                    name="requisitos"
                    rows="6"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >{{ old('requisitos', $oportunidad->requisitos) }}</textarea>

            </div>


            {{-- SALARIO MÍNIMO --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Salario mínimo
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="salario_min"
                    value="{{ old('salario_min', $oportunidad->salario_min) }}"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


            {{-- SALARIO MÁXIMO --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Salario máximo
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="salario_max"
                    value="{{ old('salario_max', $oportunidad->salario_max) }}"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


            {{-- MOSTRAR SALARIO --}}

            <div class="md:col-span-2">

                <label class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="mostrar_salario"
                        value="1"
                        @checked(old('mostrar_salario', $oportunidad->mostrar_salario))
                        class="h-4 w-4 rounded border-white/20 bg-[#0B1220] text-horeca-dorado"
                    >

                    <span class="text-sm text-white/70">
                        Mostrar salario públicamente
                    </span>

                </label>

            </div>


            {{-- FECHA CIERRE --}}

            <div>

                <label class="mb-2 block text-sm font-bold">
                    Fecha de cierre
                </label>

                <input
                    type="date"
                    name="fecha_cierre"
                    value="{{ old('fecha_cierre', optional($oportunidad->fecha_cierre)->format('Y-m-d')) }}"
                    class="w-full rounded-xl border border-white/10 bg-[#0B1220] px-4 py-3 text-sm text-white outline-none focus:border-horeca-dorado"
                >

            </div>


        </div>


        {{-- BOTONES --}}

        <div class="mt-8 flex flex-wrap gap-3">

            <button
                type="submit"
                class="rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-black"
            >
                Guardar cambios
            </button>

            <a
                href="{{ route('oportunidades.index') }}"
                class="rounded-xl border border-white/10 px-6 py-3 text-sm font-bold text-white/70 hover:bg-white/5"
            >
                Cancelar
            </a>

        </div>

    </form>

</div>

@endsection