@extends('layouts.dashboard')

@section('title', $oportunidad->titulo)

@section('header-title', 'Detalle de oportunidad')




@section('content')

<div class="space-y-6">


    {{-- CABECERA --}}

    <div class="rounded-2xl border border-horeca-dorado/20 bg-[#111A29] p-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

            <div>

                <div class="flex flex-wrap items-center gap-3">

                    <h2 class="text-3xl font-black">
                        {{ $oportunidad->titulo }}
                    </h2>

                    @if($oportunidad->estado === 'publicada')

                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-400">
                        Publicada
                    </span>

                    @elseif($oportunidad->estado === 'pendiente')

                    <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                        Pendiente
                    </span>

                    @elseif($oportunidad->estado === 'cerrada')

                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-white/70">
                        Cerrada
                    </span>

                    @endif

                </div>


                <div class="mt-3 flex flex-wrap gap-4 text-sm text-white/80">

                    @if($oportunidad->area)
                    <span>
                        📁 {{ $oportunidad->area }}
                    </span>
                    @endif

                    @if($oportunidad->modalidad)
                    <span>
                        💼 {{ $oportunidad->modalidad }}
                    </span>
                    @endif

                    @if($oportunidad->ubicacion)
                    <span>
                        📍 {{ $oportunidad->ubicacion }}
                    </span>
                    @endif

                </div>

            </div>


            <a
                href="{{ route('oportunidades.edit', $oportunidad) }}"
                class="rounded-xl border border-horeca-dorado/30 px-5 py-3 text-sm font-bold text-horeca-dorado">
                Editar oportunidad
            </a>

        </div>

    </div>


    {{-- DESCRIPCIÓN --}}

    <div class="grid gap-6 lg:grid-cols-[1fr_350px]">


        <div class="space-y-6">


            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h3 class="text-lg font-bold">
                    Descripción
                </h3>

                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">
                    {{ $oportunidad->descripcion }}
                </p>

            </div>


            @if($oportunidad->funciones)

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h3 class="text-lg font-bold">
                    Funciones principales
                </h3>

                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">
                    {{ $oportunidad->funciones }}
                </p>

            </div>

            @endif


            @if($oportunidad->requisitos)

            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h3 class="text-lg font-bold">
                    Requisitos
                </h3>

                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-white/60">
                    {{ $oportunidad->requisitos }}
                </p>

            </div>

            @endif

        </div>


        {{-- RESUMEN --}}

        <div>

            <div class="rounded-2xl border border-horeca-dorado/20 bg-[#111A29] p-6">

                <h3 class="text-lg font-bold">
                    Resumen
                </h3>

                <div class="mt-5 space-y-4 text-sm">


                    <div class="flex justify-between">

                        <span class="text-white/80">
                            Postulaciones
                        </span>

                        <span class="font-bold">
                            {{ $oportunidad->postulaciones->count() }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-white/80">
                            Contrato
                        </span>

                        <span class="font-bold">
                            {{ $oportunidad->tipo_contrato }}
                        </span>

                    </div>


                    @if($oportunidad->fecha_cierre)

                    <div class="flex justify-between">

                        <span class="text-white/80">
                            Cierre
                        </span>

                        <span class="font-bold">
                            {{ $oportunidad->fecha_cierre->format('d/m/Y') }}
                        </span>

                    </div>

                    @endif


                    @if($oportunidad->mostrar_salario)

                    <div class="flex justify-between">

                        <span class="text-white/80">
                            Salario
                        </span>

                        <span class="font-bold text-horeca-dorado">

                            S/
                            {{ number_format($oportunidad->salario_min, 2) }}

                            @if($oportunidad->salario_max)
                            - S/ {{ number_format($oportunidad->salario_max, 2) }}
                            @endif

                        </span>

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- POSTULANTES --}}

    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-xl font-bold">
                    Profesionales postulantes
                </h3>

                <p class="mt-1 text-sm text-white/80">
                    Revisa los profesionales que se han postulado.
                </p>

            </div>


            <span class="rounded-full bg-horeca-dorado/10 px-4 py-2 text-sm font-bold text-horeca-dorado">

                {{ $oportunidad->postulaciones->count() }}

                postulantes

            </span>

        </div>


        @if($oportunidad->postulaciones->count())


        <div class="mt-6 space-y-3">


            @foreach($oportunidad->postulaciones as $postulacion)

            @php
            $profesional = $postulacion->profesional;
            @endphp


            <div class="rounded-xl border border-white/5 bg-[#182337] p-5">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center">


                    {{-- PERFIL --}}

                    <div class="flex flex-1 items-center gap-4">


                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-horeca-dorado text-lg font-black text-black">

                            {{ strtoupper(
                                        substr($profesional->nombres, 0, 1) .
                                        substr($profesional->apellidos, 0, 1)
                                    ) }}

                        </div>


                        <div>

                            <h4 class="font-bold">

                                {{ $profesional->nombres }}
                                {{ $profesional->apellidos }}

                            </h4>


                            <p class="mt-1 text-sm text-white/80">

                                {{ $profesional->especialidad }}

                                @if($profesional->subespecialidad)
                                · {{ $profesional->subespecialidad }}
                                @endif

                            </p>


                            <p class="mt-1 text-xs text-white/70">

                                {{ $profesional->ciudad }}

                                @if($profesional->distrito)
                                · {{ $profesional->distrito }}
                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- EXPERIENCIA --}}

                    <div class="text-sm">

                        <p class="text-xs text-white/70">
                            Experiencia
                        </p>

                        <p class="mt-1 font-bold">
                            {{ $profesional->experiencia ?? 'No especificada' }}
                        </p>

                    </div>


                    {{-- ESTADO --}}

                    <div>

                        @if($postulacion->estado === 'pendiente')

                        <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                            Pendiente
                        </span>

                        @elseif($postulacion->estado === 'en_revision')

                        <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-bold text-blue-400">
                            En revisión
                        </span>

                        @elseif($postulacion->estado === 'entrevista')

                        <span class="rounded-full bg-purple-500/10 px-3 py-1 text-xs font-bold text-purple-400">
                            Entrevista
                        </span>

                        @elseif($postulacion->estado === 'seleccionado')

                        <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-400">
                            Seleccionado
                        </span>

                        @elseif($postulacion->estado === 'descartado')

                        <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                            Descartado
                        </span>

                        @endif

                    </div>


                    {{-- ACCIONES --}}

                    <div>

                        <a
                            href="{{ route('empresa.postulaciones.profesional', $postulacion) }}"
                            class="rounded-lg border border-horeca-dorado/30 px-4 py-2 text-xs font-bold text-horeca-dorado transition hover:bg-horeca-dorado hover:text-[#07111F]">
                            Ver perfil
                        </a>
                    </div>

                </div>

            </div>

            @endforeach


        </div>


        @else

        <div class="mt-6 rounded-xl border border-dashed border-white/10 p-10 text-center">

            <div class="text-3xl">
                👥
            </div>

            <p class="mt-3 font-bold">
                Aún no hay postulantes
            </p>

            <p class="mt-1 text-sm text-white/80">
                Los profesionales que se postulen aparecerán aquí.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection