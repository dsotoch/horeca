@extends('layouts.dashboard')

@section('title', 'Detalle del profesional')

@section('header-title', 'Detalle del profesional')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- VOLVER --}}
    <div>
        <a
            href="{{ route('admin.profesionales.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-white/70 transition hover:text-horeca-dorado"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Volver a profesionales
        </a>
    </div>


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


    {{-- =========================================================
         CABECERA
    ========================================================== --}}
    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

            {{-- IDENTIDAD --}}
            <div class="flex items-center gap-5">

                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-horeca-dorado/10 text-horeca-dorado">

                    <i class="fa-solid fa-user-doctor text-3xl"></i>

                </div>


                <div>

                    <div class="flex flex-wrap items-center gap-3">

                        <h1 class="text-2xl font-black text-white">
                            {{ $nombre }}
                        </h1>


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

                    </div>


                    @if($profesional->especialidad)

                        <p class="mt-2 text-sm font-semibold text-horeca-dorado">
                            {{ $profesional->especialidad }}
                        </p>

                    @endif

                </div>

            </div>


            {{-- CAMBIAR ESTADO --}}
            <div>

                <form
                    method="POST"
                    action="{{ route('admin.profesionales.estado', $profesional) }}"
                >

                    @csrf
                    @method('PATCH')


                    @if($estado === 'activo')

                        <button
                            type="submit"
                            onclick="return confirm('¿Deseas inhabilitar a este profesional?')"
                            class="inline-flex items-center rounded-xl bg-red-500/10 px-5 py-3 text-sm font-bold text-red-400 transition hover:bg-red-500/20"
                        >

                            <i class="fa-solid fa-ban mr-2"></i>

                            Inhabilitar profesional

                        </button>

                    @else

                        <button
                            type="submit"
                            onclick="return confirm('¿Deseas habilitar a este profesional?')"
                            class="inline-flex items-center rounded-xl bg-green-500/10 px-5 py-3 text-sm font-bold text-green-400 transition hover:bg-green-500/20"
                        >

                            <i class="fa-solid fa-check mr-2"></i>

                            Habilitar profesional

                        </button>

                    @endif

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         INFORMACIÓN PRINCIPAL
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


        {{-- INFORMACIÓN PERSONAL --}}
        <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-horeca-dorado/10 text-horeca-dorado">

                    <i class="fa-solid fa-id-card"></i>

                </div>

                <div>

                    <h2 class="font-black text-white">
                        Información personal
                    </h2>

                    <p class="text-sm text-white/50">
                        Datos registrados del profesional
                    </p>

                </div>

            </div>


            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- NOMBRES --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Nombres
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->nombres ?: '—' }}
                    </p>

                </div>


                {{-- APELLIDOS --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Apellidos
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->apellidos ?: '—' }}
                    </p>

                </div>


                {{-- DOCUMENTO --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Documento
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->numero_documento ?: '—' }}
                    </p>

                </div>


                {{-- ESPECIALIDAD --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Especialidad
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->especialidad ?: '—' }}
                    </p>

                </div>


                {{-- ID --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        ID profesional
                    </p>

                    <p class="mt-1 font-mono text-sm text-white">
                        #{{ $profesional->id }}
                    </p>

                </div>


                {{-- FECHA --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Registrado
                    </p>

                    <p class="mt-1 text-sm text-white">

                        @if($profesional->created_at)

                            {{ $profesional->created_at->format('d/m/Y H:i') }}

                        @else

                            —

                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- CUENTA --}}
        <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div>

                    <h2 class="font-black text-white">
                        Cuenta de usuario
                    </h2>

                    <p class="text-sm text-white/50">
                        Información de acceso
                    </p>

                </div>

            </div>


            <div class="mt-6 space-y-5">

                {{-- USUARIO --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Usuario
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->user?->name ?: '—' }}
                    </p>

                </div>


                {{-- EMAIL --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Correo electrónico
                    </p>

                    <p class="mt-1 break-all text-sm text-white">
                        {{ $profesional->user?->email ?: '—' }}
                    </p>

                </div>


                {{-- ESTADO --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Estado de cuenta
                    </p>

                    <div class="mt-2">

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

                    </div>

                </div>


                {{-- ROL --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Rol
                    </p>

                    <p class="mt-1 text-sm text-white">
                        {{ $profesional->user?->rol ?? 'profesional' }}
                    </p>

                </div>


                {{-- FECHA CUENTA --}}
                <div>

                    <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                        Cuenta creada
                    </p>

                    <p class="mt-1 text-sm text-white">

                        @if($profesional->user?->created_at)

                            {{ $profesional->user->created_at->format('d/m/Y H:i') }}

                        @else

                            —

                        @endif

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CV
    ========================================================== --}}
    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-500/10 text-red-400">

                    <i class="fa-solid fa-file-pdf text-xl"></i>

                </div>

                <div>

                    <h2 class="font-black text-white">
                        Currículum Vitae
                    </h2>

                    <p class="text-sm text-white/50">
                        Documento profesional registrado
                    </p>

                </div>

            </div>


            @if(!empty($profesional->cv))

                <div class="flex flex-wrap gap-3">

                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        target="_blank"
                        class="inline-flex items-center rounded-xl bg-horeca-dorado px-5 py-3 text-sm font-black text-black transition hover:opacity-90"
                    >

                        <i class="fa-solid fa-eye mr-2"></i>

                        Ver CV

                    </a>


                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        download
                        class="inline-flex items-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/10"
                    >

                        <i class="fa-solid fa-download mr-2"></i>

                        Descargar

                    </a>

                </div>

            @else

                <span class="rounded-full bg-white/5 px-4 py-2 text-sm font-bold text-white/40">

                    <i class="fa-solid fa-file-circle-xmark mr-2"></i>

                    CV no registrado

                </span>

            @endif

        </div>


        @if(!empty($profesional->cv))

            <div class="mt-5 overflow-hidden rounded-2xl border border-white/10 bg-[#0B1220]">

                <iframe
                    src="{{ asset('storage/' . $profesional->cv) }}"
                    class="h-[700px] w-full"
                    title="Currículum Vitae"
                ></iframe>

            </div>

        @endif

    </div>


    {{-- =========================================================
         VIDEO DE PRESENTACIÓN
    ========================================================== --}}
    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex items-center gap-3">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-video text-xl"></i>

            </div>

            <div>

                <h2 class="font-black text-white">
                    Video de presentación
                </h2>

                <p class="text-sm text-white/50">
                    Presentación profesional del candidato
                </p>

            </div>

        </div>


        @if(!empty($profesional->video_presentacion))

            <div class="mt-6 overflow-hidden rounded-2xl border border-white/10 bg-black">

                <video
                    controls
                    preload="metadata"
                    playsinline
                    class="aspect-video w-full object-contain"
                >

                    <source
                        src="{{ asset('storage/' . $profesional->video_presentacion) }}"
                        type="video/mp4"
                    >

                    Tu navegador no soporta la reproducción de video.

                </video>

            </div>

        @else

            <div class="mt-6 flex flex-col items-center justify-center rounded-2xl border border-dashed border-white/10 bg-white/[0.02] py-16">

                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 text-white/20">

                    <i class="fa-solid fa-video-slash text-2xl"></i>

                </div>

                <p class="mt-4 font-bold text-white">
                    No hay video de presentación
                </p>

                <p class="mt-1 text-sm text-white/40">
                    Este profesional todavía no ha registrado un video.
                </p>

            </div>

        @endif

    </div>


    {{-- =========================================================
         INFORMACIÓN ADICIONAL
    ========================================================== --}}
    <div class="rounded-3xl border border-white/10 bg-[#111A29] p-6">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10 text-purple-400">

                <i class="fa-solid fa-circle-info"></i>

            </div>

            <div>

                <h2 class="font-black text-white">
                    Información adicional
                </h2>

                <p class="text-sm text-white/50">
                    Información disponible del profesional
                </p>

            </div>

        </div>


        <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">


            <div class="rounded-2xl border border-white/5 bg-white/[0.02] p-4">

                <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                    Profesional
                </p>

                <p class="mt-2 text-sm font-bold text-white">
                    #{{ $profesional->id }}
                </p>

            </div>


            <div class="rounded-2xl border border-white/5 bg-white/[0.02] p-4">

                <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                    Estado
                </p>

                <p class="mt-2 text-sm font-bold {{ $estado === 'activo' ? 'text-green-400' : 'text-red-400' }}">
                    {{ ucfirst($estado) }}
                </p>

            </div>


            <div class="rounded-2xl border border-white/5 bg-white/[0.02] p-4">

                <p class="text-sm font-bold uppercase tracking-wider text-white/50">
                    Especialidad
                </p>

                <p class="mt-2 text-sm font-bold text-white">
                    {{ $profesional->especialidad ?: 'No especificada' }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection