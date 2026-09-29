@extends('layouts.dashboard')

@section('title', 'Detalle de oportunidad')

@section('header-title', 'Oportunidad')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- =========================================================
         MENSAJES
    ========================================================== --}}

    @if(session('success'))

        <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-md font-bold text-emerald-400">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4 text-md font-bold text-red-400">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =========================================================
         ERRORES DE VALIDACIÓN
    ========================================================== --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4">

            <p class="text-md font-black text-red-400">
                Revisa los siguientes errores:
            </p>

            <ul class="mt-2 space-y-1 text-xs text-red-300">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         VOLVER
    ========================================================== --}}

    <a
        href="{{ route('profesional.oportunidades.index') }}"
        class="inline-flex items-center gap-2 text-md font-bold text-white/70 transition hover:text-white"
    >
        ← Volver a oportunidades
    </a>


    {{-- =========================================================
         CABECERA
    ========================================================== --}}

    <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 md:p-8">

        <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">

            {{-- INFORMACIÓN PRINCIPAL --}}

            <div class="min-w-0">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-xl font-black text-horeca-dorado">

                        {{ strtoupper(
                            substr(
                                $oportunidad->empresa->nombre_comercial
                                ?? $oportunidad->empresa->razon_social
                                ?? 'E',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div class="min-w-0">

                        <p class="truncate text-md font-bold text-white/70">

                            {{ $oportunidad->empresa->nombre_comercial
                                ?? $oportunidad->empresa->razon_social
                                ?? 'Empresa' }}

                        </p>


                        @if($oportunidad->area)

                            <p class="mt-1 text-xs font-black uppercase tracking-wider text-horeca-dorado">
                                {{ $oportunidad->area }}
                            </p>

                        @endif

                    </div>

                </div>


                <h1 class="mt-6 text-3xl font-black leading-tight text-white">
                    {{ $oportunidad->titulo }}
                </h1>


                {{-- INFORMACIÓN RÁPIDA --}}

                <div class="mt-4 flex flex-wrap gap-2">

                    @if($oportunidad->modalidad)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">
                            📍 {{ $oportunidad->modalidad }}
                        </span>

                    @endif


                    @if($oportunidad->ubicacion)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">
                            🗺️ {{ $oportunidad->ubicacion }}
                        </span>

                    @endif


                    @if($oportunidad->tipo_contrato)

                        <span class="rounded-lg bg-white/5 px-3 py-2 text-xs font-bold text-white/60">
                            💼 {{ $oportunidad->tipo_contrato }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 BOTÓN POSTULAR
            ================================================== --}}

            <div class="shrink-0">

                @if($yaPostulado)

                    <div class="rounded-xl bg-emerald-500/10 px-5 py-3 text-center text-md font-black text-emerald-400">
                        ✓ Ya estás postulado
                    </div>

                @else

                    <a
                        href="#postular"
                        class="inline-flex rounded-xl bg-horeca-dorado px-6 py-3 text-md font-black text-[#07111F] transition hover:opacity-90"
                    >
                        Postularme
                    </a>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <div class="grid gap-6 lg:grid-cols-3">


        {{-- =====================================================
             COLUMNA PRINCIPAL
        ====================================================== --}}

        <div class="space-y-6 lg:col-span-2">


            {{-- DESCRIPCIÓN --}}

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">

                <h2 class="text-lg font-black text-white">
                    Descripción
                </h2>

                <div class="mt-4 whitespace-pre-line text-md leading-7 text-white/60">

                    {{ $oportunidad->descripcion ?: 'No se ha registrado una descripción.' }}

                </div>

            </section>


            {{-- FUNCIONES --}}

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">

                <h2 class="text-lg font-black text-white">
                    Funciones
                </h2>

                <div class="mt-4 whitespace-pre-line text-md leading-7 text-white/60">

                    {{ $oportunidad->funciones ?: 'No se han especificado las funciones.' }}

                </div>

            </section>


            {{-- REQUISITOS --}}

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">

                <h2 class="text-lg font-black text-white">
                    Requisitos
                </h2>

                <div class="mt-4 whitespace-pre-line text-md leading-7 text-white/60">

                    {{ $oportunidad->requisitos ?: 'No se han especificado requisitos.' }}

                </div>

            </section>


            {{-- =================================================
                 FORMULARIO DE POSTULACIÓN
            ================================================== --}}

            @if(!$yaPostulado)

                <section
                    id="postular"
                    class="scroll-mt-24 rounded-2xl border border-horeca-dorado/20 bg-horeca-dorado/[0.04] p-6"
                >

                    <div class="mb-6">

                        <p class="text-xs font-black uppercase tracking-[0.2em] text-horeca-dorado">
                            Postulación
                        </p>

                        <h2 class="mt-1 text-xl font-black text-white">
                            Postúlate a esta oportunidad
                        </h2>

                        <p class="mt-2 text-md leading-6 text-white/40">
                            Envía un mensaje a la empresa para acompañar tu postulación.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('profesional.oportunidades.postular', $oportunidad) }}"
                        class="space-y-5"
                    >

                        @csrf


                        {{-- MENSAJE --}}

                        <div>

                            <label
                                for="mensaje"
                                class="mb-2 block text-md font-bold text-white"
                            >
                                Mensaje para la empresa
                            </label>

                            <textarea
                                id="mensaje"
                                name="mensaje"
                                rows="6"
                                maxlength="2000"
                                placeholder="Cuéntale brevemente a la empresa por qué estás interesado en esta oportunidad..."
                                class="w-full resize-none rounded-xl border border-white/10 bg-[#111A29] px-4 py-3 text-md leading-6 text-white outline-none placeholder:text-white/25 focus:border-horeca-dorado focus:ring-1 focus:ring-horeca-dorado"
                            >{{ old('mensaje') }}</textarea>


                            <div class="mt-2 flex justify-between gap-3">

                                <p class="text-xs text-white/30">
                                    Máximo 2000 caracteres.
                                </p>

                                <p class="text-xs text-white/30">
                                    Opcional
                                </p>

                            </div>


                            @error('mensaje')

                                <p class="mt-2 text-xs font-bold text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- CONFIRMACIÓN --}}

                        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4">

                            <div class="flex gap-3">

                                <div class="mt-0.5 text-lg">
                                    ℹ️
                                </div>

                                <div>

                                    <p class="text-md font-bold text-white">
                                        ¿Listo para postularte?
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-white/40">
                                        La empresa recibirá tu perfil profesional junto con tu postulación.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- BOTÓN --}}

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                            <p class="text-xs text-white/30">
                                Tu postulación comenzará en estado
                                <span class="font-bold text-amber-400">
                                    pendiente
                                </span>.
                            </p>


                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-horeca-dorado px-6 py-3 text-md font-black text-[#07111F] transition hover:opacity-90"
                            >
                                Enviar postulación
                            </button>

                        </div>

                    </form>

                </section>

            @else

                {{-- =================================================
                     YA POSTULADO
                ================================================== --}}

                <section class="rounded-2xl border border-emerald-400/20 bg-emerald-400/[0.04] p-6">

                    <div class="flex gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-400/10 text-xl text-emerald-400">
                            ✓
                        </div>

                        <div>

                            <h2 class="text-lg font-black text-white">
                                Ya te has postulado
                            </h2>

                            <p class="mt-1 text-md leading-6 text-white/40">
                                Tu postulación ya fue enviada a la empresa.
                                Puedes consultar su estado desde
                                <a
                                    href="{{ route('profesional.postulaciones.index') }}"
                                    class="font-bold text-horeca-dorado hover:underline"
                                >
                                    Mis postulaciones
                                </a>.
                            </p>

                        </div>

                    </div>

                </section>

            @endif

        </div>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="space-y-6">


            {{-- =================================================
                 CONDICIONES
            ================================================== --}}

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">

                <h2 class="text-md font-black uppercase tracking-wider text-white">
                    Condiciones
                </h2>


                <div class="mt-5 space-y-5">


                    {{-- SALARIO --}}

                    @if($oportunidad->mostrar_salario)

                        @if(
                            $oportunidad->salario_min ||
                            $oportunidad->salario_max
                        )

                            <div>

                                <p class="text-xs text-white/30">
                                    Salario
                                </p>

                                <p class="mt-1 text-md font-black text-white">

                                    @if(
                                        $oportunidad->salario_min &&
                                        $oportunidad->salario_max
                                    )

                                        S/
                                        {{ number_format($oportunidad->salario_min, 0) }}
                                        -
                                        S/
                                        {{ number_format($oportunidad->salario_max, 0) }}

                                    @elseif($oportunidad->salario_min)

                                        Desde S/
                                        {{ number_format($oportunidad->salario_min, 0) }}

                                    @elseif($oportunidad->salario_max)

                                        Hasta S/
                                        {{ number_format($oportunidad->salario_max, 0) }}

                                    @endif

                                </p>

                            </div>

                        @endif

                    @endif


                    {{-- TIPO CONTRATO --}}

                    @if($oportunidad->tipo_contrato)

                        <div>

                            <p class="text-xs text-white/30">
                                Tipo de contrato
                            </p>

                            <p class="mt-1 text-md font-bold text-white">
                                {{ $oportunidad->tipo_contrato }}
                            </p>

                        </div>

                    @endif


                    {{-- MODALIDAD --}}

                    @if($oportunidad->modalidad)

                        <div>

                            <p class="text-xs text-white/30">
                                Modalidad
                            </p>

                            <p class="mt-1 text-md font-bold text-white">
                                {{ $oportunidad->modalidad }}
                            </p>

                        </div>

                    @endif


                    {{-- UBICACIÓN --}}

                    @if($oportunidad->ubicacion)

                        <div>

                            <p class="text-xs text-white/30">
                                Ubicación
                            </p>

                            <p class="mt-1 text-md font-bold text-white">
                                {{ $oportunidad->ubicacion }}
                            </p>

                        </div>

                    @endif


                    {{-- FECHA DE CIERRE --}}

                    @if($oportunidad->fecha_cierre)

                        <div>

                            <p class="text-xs text-white/30">
                                Fecha de cierre
                            </p>

                            <p class="mt-1 text-md font-bold text-white">
                                {{ $oportunidad->fecha_cierre->format('d/m/Y') }}
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- =================================================
                 EMPRESA
            ================================================== --}}

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">

                <h2 class="text-md font-black uppercase tracking-wider text-white">
                    Empresa
                </h2>


                <p class="mt-4 text-lg font-black text-white">

                    {{ $oportunidad->empresa->nombre_comercial
                        ?? $oportunidad->empresa->razon_social
                        ?? 'Empresa' }}

                </p>


                @if($oportunidad->empresa->ciudad)

                    <p class="mt-2 text-md text-white/40">
                        📍 {{ $oportunidad->empresa->ciudad }}
                    </p>

                @endif


                @if($oportunidad->empresa->sitio_web)

                    <a
                        href="{{ $oportunidad->empresa->sitio_web }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-4 inline-flex text-xs font-black text-horeca-dorado hover:underline"
                    >
                        Visitar sitio web →
                    </a>

                @endif

            </section>


            {{-- =================================================
                 ACCESO A POSTULACIONES
            ================================================== --}}

            @if($yaPostulado)

                <a
                    href="{{ route('profesional.postulaciones.index') }}"
                    class="flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] px-5 py-3 text-md font-black text-white transition hover:bg-white/[0.06]"
                >
                    Ver mis postulaciones →
                </a>

            @endif

        </aside>

    </div>

</div>

@endsection