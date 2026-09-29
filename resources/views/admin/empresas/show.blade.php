@extends('layouts.dashboard')

@section('title', 'Detalle de empresa')

@section('header-title', 'Detalle de empresa')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- CABECERA --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div class="flex items-center gap-4">

            <a
                href="{{ route('admin.empresas.index') }}"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-white/60 transition hover:bg-white/10 hover:text-white"
            >
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>

                <p class="text-xs font-bold uppercase tracking-wider text-horeca-dorado">
                    Empresa
                </p>

                <h1 class="mt-1 text-2xl font-black text-white">
                    {{ $empresa->nombre_comercial ?: $empresa->razon_social }}
                </h1>

                @if($empresa->nombre_comercial && $empresa->razon_social)
                    <p class="mt-1 text-sm text-white/40">
                        {{ $empresa->razon_social }}
                    </p>
                @endif

            </div>

        </div>


        {{-- ESTADO --}}
        <div>

            @if($empresa->estado_validacion === 'aprobado')

                <span class="inline-flex items-center gap-2 rounded-full bg-green-500/10 px-4 py-2 text-sm font-bold text-green-400">
                    <span class="h-2 w-2 rounded-full bg-green-400"></span>
                    Empresa validada
                </span>

            @elseif($empresa->estado_validacion === 'rechazado')

                <span class="inline-flex items-center gap-2 rounded-full bg-red-500/10 px-4 py-2 text-sm font-bold text-red-400">
                    <span class="h-2 w-2 rounded-full bg-red-400"></span>
                    Empresa observada
                </span>

            @else

                <span class="inline-flex items-center gap-2 rounded-full bg-yellow-500/10 px-4 py-2 text-sm font-bold text-yellow-400">
                    <span class="h-2 w-2 rounded-full bg-yellow-400"></span>
                    Pendiente de validación
                </span>

            @endif

        </div>

    </div>


    {{-- ACCIONES --}}
    <div class="rounded-2xl border border-white/10 bg-[#111A29] p-5">

        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">

            @if($empresa->estado_validacion !== 'aprobado')

                <form
                    method="POST"
                    action="{{ route('admin.empresas.validar', $empresa) }}"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-xl bg-green-500 px-5 py-3 text-sm font-black text-white transition hover:bg-green-400"
                    >
                        <i class="fa-solid fa-check mr-2"></i>
                        Validar empresa
                    </button>

                </form>

            @endif


            @if($empresa->estado_validacion !== 'rechazado')

                <form
                    method="POST"
                    action="{{ route('admin.empresas.observar', $empresa) }}"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="observacion"
                        value="Requiere revisión administrativa."
                    >

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-xl bg-red-500/10 px-5 py-3 text-sm font-bold text-red-400 transition hover:bg-red-500/20"
                    >
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Observar empresa
                    </button>

                </form>

            @endif


            <form
                method="POST"
                action="{{ route('admin.empresas.estado', $empresa) }}"
            >
                @csrf
                @method('PATCH')

                @if($empresa->usuario?->estado === 'activo')

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white"
                    >
                        <i class="fa-solid fa-ban mr-2"></i>
                        Desactivar cuenta
                    </button>

                @else

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white"
                    >
                        <i class="fa-solid fa-circle-check mr-2"></i>
                        Activar cuenta
                    </button>

                @endif

            </form>

        </div>

    </div>


    {{-- CONTENIDO --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- COLUMNA PRINCIPAL --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- INFORMACIÓN --}}
            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <div class="mb-6">

                    <h2 class="text-lg font-black text-white">
                        Información de la empresa
                    </h2>

                    <p class="mt-1 text-sm text-white/40">
                        Datos registrados por la empresa.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Razón social
                        </p>

                        <p class="mt-2 text-sm font-semibold text-white">
                            {{ $empresa->razon_social ?: '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Nombre comercial
                        </p>

                        <p class="mt-2 text-sm font-semibold text-white">
                            {{ $empresa->nombre_comercial ?: '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            RUC
                        </p>

                        <p class="mt-2 text-sm font-semibold text-white">
                            {{ $empresa->ruc ?: '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Tipo de empresa
                        </p>

                        <p class="mt-2 text-sm font-semibold text-white">
                            {{ $empresa->tipo_empresa ?: '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Sitio web
                        </p>

                        @if($empresa->sitio_web)

                            <a
                                href="{{ $empresa->sitio_web }}"
                                target="_blank"
                                class="mt-2 block text-sm font-semibold text-horeca-dorado hover:underline"
                            >
                                {{ $empresa->sitio_web }}
                            </a>

                        @else

                            <p class="mt-2 text-sm text-white/40">
                                —
                            </p>

                        @endif

                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Red social
                        </p>

                        @if($empresa->red_social)

                            <a
                                href="{{ $empresa->red_social }}"
                                target="_blank"
                                class="mt-2 block text-sm font-semibold text-horeca-dorado hover:underline"
                            >
                                Ver perfil
                            </a>

                        @else

                            <p class="mt-2 text-sm text-white/40">
                                —
                            </p>

                        @endif

                    </div>

                </div>


                @if($empresa->descripcion)

                    <div class="mt-6 border-t border-white/10 pt-6">

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Descripción
                        </p>

                        <p class="mt-3 whitespace-pre-line text-sm leading-7 text-white/60">
                            {{ $empresa->descripcion }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- VIDEO --}}
            @if($empresa->video_presentacion)

                <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#111A29]">

                    <div class="border-b border-white/10 p-6">

                        <h2 class="text-lg font-black text-white">
                            Video de presentación
                        </h2>

                    </div>

                    <video
                        controls
                        preload="metadata"
                        playsinline
                        class="aspect-video w-full bg-black object-contain"
                    >
                        <source
                            src="{{ asset('storage/' . $empresa->video_presentacion) }}"
                            type="video/mp4"
                        >

                        Tu navegador no soporta la reproducción de video.

                    </video>

                </div>

            @endif


            {{-- OPORTUNIDADES --}}
            <div class="rounded-2xl border border-white/10 bg-[#111A29]">

                <div class="border-b border-white/10 p-6">

                    <h2 class="text-lg font-black text-white">
                        Oportunidades
                    </h2>

                    <p class="mt-1 text-sm text-white/40">
                        Oportunidades registradas por esta empresa.
                    </p>

                </div>


                <div class="divide-y divide-white/5">

                    @forelse($empresa->oportunidades as $oportunidad)

                        <div class="p-5">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <p class="font-bold text-white">
                                        {{ $oportunidad->titulo }}
                                    </p>

                                    <p class="mt-1 text-xs text-white/40">
                                        {{ $oportunidad->area ?: 'Sin área especificada' }}
                                    </p>

                                </div>


                                @if($oportunidad->estado === 'publicada')

                                    <span class="w-fit rounded-full bg-green-500/10 px-3 py-1 text-xs font-bold text-green-400">
                                        Publicada
                                    </span>

                                @elseif($oportunidad->estado === 'cerrada')

                                    <span class="w-fit rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                                        Cerrada
                                    </span>

                                @else

                                    <span class="w-fit rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                                        {{ ucfirst($oportunidad->estado) }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="p-8 text-center">

                            <i class="fa-solid fa-briefcase text-2xl text-white/10"></i>

                            <p class="mt-3 text-sm font-bold text-white/50">
                                Esta empresa todavía no tiene oportunidades.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- CONTACTO --}}
            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">
                    Contacto
                </h2>


                <div class="mt-5 space-y-4">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Responsable
                        </p>

                        <p class="mt-1 text-sm font-semibold text-white">
                            {{ trim(($empresa->contacto_nombres ?? '') . ' ' . ($empresa->contacto_apellidos ?? '')) ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Cargo
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->cargo ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Celular
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->celular ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Email
                        </p>

                        <p class="mt-1 break-all text-sm text-white/60">
                            {{ $empresa->email ?: $empresa->usuario?->email ?: '—' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- UBICACIÓN --}}
            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">
                    Ubicación
                </h2>


                <div class="mt-5 space-y-4">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Departamento
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->departamento ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Ciudad
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->ciudad ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Distrito
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->distrito ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Dirección
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->direccion ?: '—' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- CUENTA --}}
            <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                <h2 class="text-lg font-black text-white">
                    Cuenta
                </h2>


                <div class="mt-5 space-y-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-white/40">
                            Estado
                        </span>

                        @if($empresa->usuario?->estado === 'activo')

                            <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-bold text-green-400">
                                Activa
                            </span>

                        @else

                            <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                                Inactiva
                            </span>

                        @endif

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Registrada
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->created_at?->format('d/m/Y H:i') ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">
                            Validación
                        </p>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $empresa->fecha_validacion ? \Carbon\Carbon::parse($empresa->fecha_validacion)->format('d/m/Y H:i') : 'Pendiente' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection