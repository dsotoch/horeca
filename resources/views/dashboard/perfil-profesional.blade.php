@extends('layouts.dashboard')

@section('title', 'Mi perfil')

@section('header-title', 'Mi perfil profesional')

@section('content')

@php

/*
|--------------------------------------------------------------------------
| DATOS
|--------------------------------------------------------------------------
*/

$nombreCompleto = trim(
($profesional->nombres ?? '') . ' ' .
($profesional->apellidos ?? '')
);

if ($nombreCompleto === '') {
$nombreCompleto = $usuario->name ?? 'Profesional';
}

/*
|--------------------------------------------------------------------------
| PORCENTAJE DEL PERFIL
|--------------------------------------------------------------------------
*/

$camposPerfil = [
'nombres',
'apellidos',
'tipo_documento',
'numero_documento',
'celular',
'especialidad',
'subespecialidad',
'experiencia',
'modalidad',
'ciudad',
'distrito',
'descripcion',
'habilidades',
'cv'
];

$completados = 0;

foreach ($camposPerfil as $campo) {

if (
isset($profesional->{$campo}) &&
$profesional->{$campo} !== null &&
$profesional->{$campo} !== ''
) {
$completados++;
}
}

$porcentaje = count($camposPerfil) > 0
? round(($completados / count($camposPerfil)) * 100)
: 0;

/*
|--------------------------------------------------------------------------
| INICIALES
|--------------------------------------------------------------------------
*/

$iniciales = collect(
preg_split('/\s+/', $nombreCompleto)
)
->filter()
->take(2)
->map(function ($nombre) {
return strtoupper(substr($nombre, 0, 1));
})
->implode('');

@endphp


<div class="max-w-6xl mx-auto space-y-6">


    {{-- ========================================================= --}}
    {{-- ERRORES --}}
    {{-- ========================================================= --}}

    @if($errors->any())

    <div class="msj p-4 rounded-xl bg-red-200 border border-red-200">

        <div class="flex items-center gap-2 text-red-700 font-semibold mb-2">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                Revisa los siguientes campos:
            </span>

        </div>

        <ul class="text-sm text-red-600 list-disc pl-5 space-y-1">

            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif


    {{-- ========================================================= --}}
    {{-- CABECERA DEL PERFIL --}}
    {{-- ========================================================= --}}

    <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8 overflow-hidden">

        <div class="p-6">

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between gap-5">

                {{-- IDENTIDAD --}}

                <div class="flex items-center gap-4">

                    {{-- Avatar --}}

                    <div class="w-20 h-20 rounded-2xl
                                bg-[#0C1C3C]
                                flex items-center justify-center
                                text-white text-2xl font-bold
                                shadow-sm">

                        {{ $iniciales ?: 'P' }}

                    </div>


                    <div>

                        <h2 class="text-2xl font-bold text-horeca-titulos">
                            {{ $nombreCompleto }}
                        </h2>

                        <p class="text-gray-500 mt-1">
                            {{ $profesional->especialidad ?? 'Profesional HORECA' }}
                        </p>

                        <div class="flex items-center gap-2 mt-2">

                            <span class="inline-flex items-center gap-1
                                         px-3 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-green-50 text-green-700">

                                <i class="fa-solid fa-circle text-[7px]"></i>

                                Perfil activo

                            </span>

                        </div>

                    </div>

                </div>


                {{-- PORCENTAJE --}}

                <div class="w-full md:w-64">

                    <div class="flex justify-between items-center mb-2">

                        <span class="text-sm  text-white">
                            Perfil completado
                        </span>

                        <span class="text-sm font-bold text-[#C9A44D]">
                            {{ $porcentaje }}%
                        </span>

                    </div>

                    <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">

                        <div
                            class="h-full bg-[#C9A44D] rounded-full transition-all duration-500"
                            style="width: {{ $porcentaje }}%;">
                        </div>

                    </div>

                    @if($porcentaje < 100)

                        <p class="text-xs text-gray-500 mt-2">
                        Completa tu información para mejorar tu perfil.
                        </p>

                        @else

                        <p class="text-xs text-green-600 mt-2">
                            ¡Tu perfil está completo!
                        </p>

                        @endif

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FORMULARIO --}}
    {{-- ========================================================= --}}

    <form
        action="{{ route('perfil.profesional.actualizar') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        @method('PUT')


        {{-- ===================================================== --}}
        {{-- INFORMACIÓN PERSONAL --}}
        {{-- ===================================================== --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#0C1C3C]/10
                                flex items-center justify-center">

                        <i class="fa-solid fa-user text-color-horeca-titulos"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">
                            Información personal
                        </h3>

                        <p class="text-sm text-gray-500">
                            Información básica de tu perfil profesional.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- NOMBRES --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Nombres
                    </label>

                    <input
                        type="text"
                        name="nombres"
                        value="{{ old('nombres', $profesional->nombres ?? '') }}"
                        class="w-full rounded-xl  border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('nombres')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- APELLIDOS --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Apellidos
                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        value="{{ old('apellidos', $profesional->apellidos ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('apellidos')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- TIPO DE DOCUMENTO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Tipo de documento
                    </label>

                    <select
                        name="tipo_documento"
                        class="w-full rounded-xl border-gray-600 p-2 border bg-horeca-fondo
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                        <option value="">
                            Seleccionar
                        </option>

                        <option
                            value="DNI"
                            @selected(old('tipo_documento', $profesional->tipo_documento ?? '') === 'DNI')
                            >
                            DNI
                        </option>

                        <option
                            value="CE"
                            @selected(old('tipo_documento', $profesional->tipo_documento ?? '') === 'CE')
                            >
                            Carné de Extranjería
                        </option>

                        <option
                            value="PASAPORTE"
                            @selected(old('tipo_documento', $profesional->tipo_documento ?? '') === 'PASAPORTE')
                            >
                            Pasaporte
                        </option>

                    </select>

                    @error('tipo_documento')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- NÚMERO DOCUMENTO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Número de documento
                    </label>

                    <input
                        type="text"
                        name="numero_documento"
                        value="{{ old('numero_documento', $profesional->numero_documento ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('numero_documento')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- CELULAR --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Celular
                    </label>

                    <input
                        type="text"
                        name="celular"
                        value="{{ old('celular', $profesional->celular ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('celular')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- EMAIL --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        value="{{ $usuario->email }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               bg-white/8 text-gray-500"
                        disabled>

                    <p class="text-xs text-gray-400 mt-1">
                        El correo pertenece a tu cuenta.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMACIÓN PROFESIONAL --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#C9A44D]/15
                                flex items-center justify-center">

                        <i class="fa-solid fa-briefcase text-[#C9A44D]"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">
                            Información profesional
                        </h3>

                        <p class="text-sm text-gray-500">
                            Cuéntanos sobre tu experiencia y especialización.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- ESPECIALIDAD --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Especialidad
                    </label>

                    <input
                        type="text"
                        name="especialidad"
                        value="{{ old('especialidad', $profesional->especialidad ?? '') }}"
                        placeholder="Ej. Chef Ejecutivo"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('especialidad')

                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- SUBESPECIALIDAD --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Subespecialidad
                    </label>

                    <input
                        type="text"
                        name="subespecialidad"
                        value="{{ old('subespecialidad', $profesional->subespecialidad ?? '') }}"
                        placeholder="Ej. Alta cocina"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                </div>


                {{-- EXPERIENCIA --}}

                <div>
                    <label
                        for="experiencia"
                        class="block text-sm font-semibold text-gray-400 mb-2">
                        Años de experiencia
                    </label>

                    <select
                        id="experiencia"
                        name="experiencia"
                        required
                        class="w-full rounded-xl border border-gray-600 p-2
               bg-horeca-fondo text-white
               focus:border-[#C9A44D]
               focus:ring-[#C9A44D]">
                        <option value="">Seleccionar</option>

                        <option
                            value="0-1"
                            @selected(old('experiencia', $profesional->experiencia ?? '') === '0-1')
                            >
                            Menos de 1 año
                        </option>

                        <option
                            value="1-3"
                            @selected(old('experiencia', $profesional->experiencia ?? '') === '1-3')
                            >
                            1 a 3 años
                        </option>

                        <option
                            value="3-5"
                            @selected(old('experiencia', $profesional->experiencia ?? '') === '3-5')
                            >
                            3 a 5 años
                        </option>

                        <option
                            value="5-10"
                            @selected(old('experiencia', $profesional->experiencia ?? '') === '5-10')
                            >
                            5 a 10 años
                        </option>

                        <option
                            value="10+"
                            @selected(old('experiencia', $profesional->experiencia ?? '') === '10+')
                            >
                            Más de 10 años
                        </option>
                    </select>

                    @error('experiencia')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>


                {{-- MODALIDAD --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Modalidad
                    </label>

                    <select
                        name="modalidad"
                        class="w-full rounded-xl border-gray-600 p-2 border bg-horeca-fondo
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                        <option value="">
                            Seleccionar modalidad
                        </option>

                        <option
                            value="presencial"
                            @selected(old('modalidad', $profesional->modalidad ?? '') == 'presencial')
                            >
                            Presencial
                        </option>

                        <option
                            value="remoto"
                            @selected(old('modalidad', $profesional->modalidad ?? '') == 'remoto')
                            >
                            Remoto
                        </option>

                        <option
                            value="hibrido"
                            @selected(old('modalidad', $profesional->modalidad ?? '') == 'hibrido')
                            >
                            Híbrido
                        </option>

                    </select>

                </div>


                {{-- DESCRIPCIÓN --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Descripción profesional
                    </label>

                    <textarea
                        name="descripcion"
                        rows="5"
                        maxlength="2000"
                        placeholder="Cuéntanos sobre tu trayectoria, experiencia y fortalezas profesionales..."
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">{{ old('descripcion', $profesional->descripcion ?? '') }}</textarea>

                </div>


                {{-- HABILIDADES --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Habilidades
                    </label>

                    <textarea
                        name="habilidades"
                        rows="3"
                        maxlength="1000"
                        placeholder="Ej. Liderazgo, gestión de equipos, costos, servicio al cliente..."
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">{{ old('habilidades', $profesional->habilidades ?? '') }}</textarea>

                    <p class="text-xs text-gray-400 mt-1">
                        Puedes separar tus habilidades utilizando comas.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- UBICACIÓN --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#0C1C3C]/10
                                flex items-center justify-center">

                        <i class="fa-solid fa-location-dot text-color-horeca-titulos"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">
                            Ubicación
                        </h3>

                        <p class="text-sm text-gray-500">
                            Indica dónde desarrollas principalmente tu actividad profesional.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- CIUDAD --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Ciudad
                    </label>

                    <input
                        type="text"
                        name="ciudad"
                        value="{{ old('ciudad', $profesional->ciudad ?? '') }}"
                        placeholder="Ej. Lima"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                </div>


                {{-- DISTRITO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">
                        Distrito
                    </label>

                    <input
                        type="text"
                        name="distrito"
                        value="{{ old('distrito', $profesional->distrito ?? '') }}"
                        placeholder="Ej. Miraflores"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- VIDEO DE PRESENTACIÓN --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#C9A44D]/15
                                flex items-center justify-center">

                        <i class="fa-solid fa-video text-[#C9A44D]"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">
                            Video de presentación
                        </h3>

                        <p class="text-sm text-gray-500">
                            Presenta brevemente tu experiencia profesional.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <label class="block text-sm font-semibold text-gray-400 mb-2">
                    Subir video
                </label>

                <input
                    type="file"
                    name="video_presentacion"
                    accept="video/mp4,video/mov,video/avi,video/webm"
                    class="w-full rounded-xl border border-gray-600 p-2 border
                           p-3 text-sm
                           file:mr-4
                           file:py-2
                           file:px-4
                           file:rounded-lg
                           file:border-0
                           file:bg-[#0C1C3C]
                           file:text-white">

                <p class="text-xs text-gray-400 mt-2">
                    Formatos permitidos: MP4, MOV, AVI y WEBM. Máximo 50 MB.
                </p>


                @if(!empty($profesional->video_presentacion))

                <div class="mt-5">

                    <p class="text-sm font-semibold text-gray-400 mb-2">
                        Video actual
                    </p>

                    <video
                        controls
                        class="w-full max-w-2xl rounded-xl bg-black">

                        <source
                            src="{{ asset('storage/' . $profesional->video_presentacion) }}">

                        Tu navegador no soporta la reproducción de video.

                    </video>

                </div>

                @endif

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- CURRÍCULUM VITAE --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                        bg-[#0C1C3C]/10
                        flex items-center justify-center">

                        <i class="fa-solid fa-file-pdf text-[#C9A44D]"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">
                            Currículum Vitae
                        </h3>

                        <p class="text-sm text-gray-500">
                            Adjunta tu CV para complementar tu perfil profesional.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <label class="block text-sm font-semibold text-gray-400 mb-2">
                    Adjuntar CV
                </label>

                <input
                    type="file"
                    name="cv"
                    accept=".pdf,.doc,.docx"
                    class="w-full rounded-xl border border-gray-600
                   p-3 text-sm text-gray-300

                   file:mr-4
                   file:py-2
                   file:px-4
                   file:rounded-lg
                   file:border-0
                   file:bg-[#0C1C3C]
                   file:text-white
                   file:font-semibold
                   file:cursor-pointer">

                <p class="text-xs text-gray-400 mt-2">
                    Formatos permitidos: PDF, DOC y DOCX. Máximo 5 MB.
                </p>


                @if(!empty($profesional->cv))

                <div class="mt-5 flex flex-col sm:flex-row
                        sm:items-center sm:justify-between
                        gap-4 p-4 rounded-xl
                        bg-gray-50 border border-gray-200">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-lg
                                bg-red-50
                                flex items-center justify-center">

                            <i class="fa-solid fa-file-pdf
                                  text-red-600 text-xl"></i>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-gray-700">
                                CV actual
                            </p>

                            <p class="text-xs text-black">
                                Documento adjunto
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        target="_blank"
                        class="inline-flex items-center justify-center
                           gap-2 px-4 py-2 rounded-lg
                           bg-horeca-dorado
                           text-black text-sm font-semibold
                           hover:bg-horeca-dorado2
                           transition">

                        <i class="fa-solid fa-eye"></i>

                        Ver CV

                    </a>

                </div>

                @endif

            </div>

        </div>
        {{-- ========================================================= --}}
        {{-- BOTONES --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col sm:flex-row justify-end gap-3">

            <a
                href="{{ route('dashboard') }}"
                class="px-6 py-3 rounded-xl
                       border border-gray-600 p-2 border
                       text-gray-600
                       font-semibold
                       text-center
                       hover:bg-gray-50
                       transition">
                Cancelar
            </a>

            <button
                type="submit"
                class="px-7 py-3 rounded-xl
                       bg-horeca-dorado
                       text-black
                       font-semibold
                       hover:bg-horeca-dorado2
                       transition
                       flex items-center
                       justify-center gap-2">

                <i class="fa-solid fa-floppy-disk"></i>

                Guardar cambios

            </button>

        </div>

    </form>

</div>

@endsection