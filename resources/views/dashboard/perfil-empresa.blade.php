@extends('layouts.dashboard')

@section('title', 'Mi perfil')

@section('header-title', 'Mi perfil de empresa')

@section('content')

@php

/*
|--------------------------------------------------------------------------
| DATOS
|--------------------------------------------------------------------------
*/

$nombreEmpresa = trim(
    $empresa->nombre_comercial
    ?? $empresa->razon_social
    ?? ''
);

if ($nombreEmpresa === '') {
    $nombreEmpresa = 'Mi empresa';
}


/*
|--------------------------------------------------------------------------
| PORCENTAJE DEL PERFIL
|--------------------------------------------------------------------------
*/

$camposPerfil = [
    'ruc',
    'razon_social',
    'nombre_comercial',
    'tipo_empresa',
    'sitio_web',
    'red_social',
    'contacto_nombres',
    'contacto_apellidos',
    'cargo',
    'celular',
    'email',
    'departamento',
    'ciudad',
    'distrito',
    'direccion',
    'perfiles_busca',
    'tipo_contratacion',
    'cantidad_profesionales',
    'descripcion',
    'video_presentacion',
];

$completados = 0;

foreach ($camposPerfil as $campo) {

    if (
        isset($empresa->{$campo}) &&
        $empresa->{$campo} !== null &&
        $empresa->{$campo} !== ''
    ) {
        $completados++;
    }

}

$porcentaje = count($camposPerfil) > 0
    ? round(($completados / count($camposPerfil)) * 100)
    : 0;


/*
|--------------------------------------------------------------------------
| INICIAL
|--------------------------------------------------------------------------
*/

$inicial = strtoupper(
    substr(
        $nombreEmpresa,
        0,
        1
    )
);

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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif




    {{-- ========================================================= --}}
    {{-- CABECERA DEL PERFIL --}}
    {{-- ========================================================= --}}

    <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8 overflow-hidden">

        <div class="p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">


                {{-- IDENTIDAD --}}

                <div class="flex items-center gap-4">

                    {{-- LOGO / AVATAR --}}

                    <div class="w-20 h-20 rounded-2xl
                                bg-[#0C1C3C]
                                flex items-center justify-center
                                text-white text-2xl font-bold
                                shadow-sm">

                        {{ $inicial ?: 'E' }}

                    </div>


                    {{-- DATOS --}}

                    <div>

                        <h2 class="text-2xl font-bold text-horeca-titulos">

                            {{ $nombreEmpresa }}

                        </h2>


                        @if($empresa->razon_social)

                            <p class="text-gray-500 mt-1">

                                {{ $empresa->razon_social }}

                            </p>

                        @endif


                        @if($empresa->tipo_empresa)

                            <p class="text-[#C9A44D] font-semibold mt-1">

                                {{ $empresa->tipo_empresa }}

                            </p>

                        @else

                            <p class="text-gray-500 mt-1">

                                Empresa HORECA

                            </p>

                        @endif


                        <div class="flex items-center gap-2 mt-2">

                            <span class="inline-flex items-center gap-1
                                         px-3 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-green-50 text-green-700">

                                <i class="fa-solid fa-circle text-[7px]"></i>

                                Perfil de empresa

                            </span>

                        </div>

                    </div>

                </div>


                {{-- PORCENTAJE --}}

                <div class="w-full md:w-64">

                    <div class="flex justify-between items-center mb-2">

                        <span class="text-sm text-white">
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

                            Completa la información de tu empresa para mejorar su presencia en HORECA PRO.

                        </p>

                    @else

                        <p class="text-xs text-green-600 mt-2">

                            ¡El perfil de tu empresa está completo!

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
        action="{{ route('perfil.empresa.actualizar') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        @method('PUT')


        {{-- ===================================================== --}}
        {{-- INFORMACIÓN DE LA EMPRESA --}}
        {{-- ===================================================== --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#0C1C3C]/10
                                flex items-center justify-center">

                        <i class="fa-solid fa-building text-color-horeca-titulos"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">

                            Información de la empresa

                        </h3>

                        <p class="text-sm text-gray-500">

                            Información principal de tu empresa.

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- RAZÓN SOCIAL --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Razón social

                    </label>

                    <input
                        type="text"
                        name="razon_social"
                        value="{{ old('razon_social', $empresa->razon_social ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('razon_social')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- NOMBRE COMERCIAL --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Nombre comercial

                    </label>

                    <input
                        type="text"
                        name="nombre_comercial"
                        value="{{ old('nombre_comercial', $empresa->nombre_comercial ?? '') }}"
                        placeholder="Ej. Hotel Los Portales"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('nombre_comercial')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- RUC --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        RUC

                    </label>

                    <input
                        type="text"
                        name="ruc"
                        value="{{ old('ruc', $empresa->ruc ?? '') }}"
                        maxlength="11"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]"
                        required>

                    @error('ruc')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- TIPO EMPRESA --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Tipo de empresa

                    </label>

                    <select
                        name="tipo_empresa"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               bg-horeca-fondo
                               text-white
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                        <option value="">
                            Seleccionar
                        </option>

                        <option
                            value="hotel"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'hotel')>
                            Hotel
                        </option>

                        <option
                            value="restaurante"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'restaurante')>
                            Restaurante
                        </option>

                        <option
                            value="cafeteria"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'cafeteria')>
                            Cafetería
                        </option>

                        <option
                            value="bar"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'bar')>
                            Bar
                        </option>

                        <option
                            value="catering"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'catering')>
                            Catering
                        </option>

                        <option
                            value="panaderia"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'panaderia')>
                            Panadería
                        </option>

                        <option
                            value="pasteleria"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'pasteleria')>
                            Pastelería
                        </option>

                        <option
                            value="otro"
                            @selected(old('tipo_empresa', $empresa->tipo_empresa ?? '') === 'otro')>
                            Otro
                        </option>

                    </select>

                    @error('tipo_empresa')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SITIO WEB --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Sitio web

                    </label>

                    <input
                        type="text"
                        name="sitio_web"
                        value="{{ old('sitio_web', $empresa->sitio_web ?? '') }}"
                        placeholder="https://www.miempresa.com"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('sitio_web')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- RED SOCIAL --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Red social

                    </label>

                    <input
                        type="text"
                        name="red_social"
                        value="{{ old('red_social', $empresa->red_social ?? '') }}"
                        placeholder="https://instagram.com/miempresa"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('red_social')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- DESCRIPCIÓN --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Descripción de la empresa

                    </label>

                    <textarea
                        name="descripcion"
                        rows="5"
                        maxlength="3000"
                        placeholder="Cuéntanos sobre tu empresa, servicios, trayectoria, propuesta de valor y características principales..."
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">{{ old('descripcion', $empresa->descripcion ?? '') }}</textarea>

                    @error('descripcion')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- PERSONA DE CONTACTO --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#C9A44D]/15
                                flex items-center justify-center">

                        <i class="fa-solid fa-address-card text-[#C9A44D]"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">

                            Persona de contacto

                        </h3>

                        <p class="text-sm text-gray-500">

                            Datos de la persona responsable de la empresa.

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- NOMBRES CONTACTO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Nombres

                    </label>

                    <input
                        type="text"
                        name="contacto_nombres"
                        value="{{ old('contacto_nombres', $empresa->contacto_nombres ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('contacto_nombres')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- APELLIDOS CONTACTO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Apellidos

                    </label>

                    <input
                        type="text"
                        name="contacto_apellidos"
                        value="{{ old('contacto_apellidos', $empresa->contacto_apellidos ?? '') }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('contacto_apellidos')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- CARGO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Cargo

                    </label>

                    <input
                        type="text"
                        name="cargo"
                        value="{{ old('cargo', $empresa->cargo ?? '') }}"
                        placeholder="Ej. Gerente de Recursos Humanos"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('cargo')

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
                        value="{{ old('celular', $empresa->celular ?? '') }}"
                        maxlength="20"
                        placeholder="Ej. 999999999"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

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
                        value="{{ $empresa->email ?? $usuario->email ?? '' }}"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               bg-white/8 text-gray-500"
                        disabled>

                    <p class="text-xs text-gray-400 mt-1">

                        Correo utilizado como contacto de la empresa.

                    </p>

                </div>


                {{-- CANTIDAD PROFESIONALES --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Cantidad aproximada de profesionales

                    </label>

                    <input
                        type="number"
                        name="cantidad_profesionales"
                        min="0"
                        value="{{ old('cantidad_profesionales', $empresa->cantidad_profesionales ?? '') }}"
                        placeholder="Ej. 25"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('cantidad_profesionales')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

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

                            Indica dónde se encuentra principalmente tu empresa.

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- DEPARTAMENTO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Departamento

                    </label>

                    <input
                        type="text"
                        name="departamento"
                        value="{{ old('departamento', $empresa->departamento ?? '') }}"
                        placeholder="Ej. La Libertad"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('departamento')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- CIUDAD --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Ciudad

                    </label>

                    <input
                        type="text"
                        name="ciudad"
                        value="{{ old('ciudad', $empresa->ciudad ?? '') }}"
                        placeholder="Ej. Trujillo"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('ciudad')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- DISTRITO --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Distrito

                    </label>

                    <input
                        type="text"
                        name="distrito"
                        value="{{ old('distrito', $empresa->distrito ?? '') }}"
                        placeholder="Ej. Víctor Larco"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('distrito')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- DIRECCIÓN --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Dirección

                    </label>

                    <input
                        type="text"
                        name="direccion"
                        value="{{ old('direccion', $empresa->direccion ?? '') }}"
                        placeholder="Ej. Av. España 123"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    @error('direccion')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMACIÓN LABORAL --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#C9A44D]/15
                                flex items-center justify-center">

                        <i class="fa-solid fa-users text-[#C9A44D]"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">

                            Información de contratación

                        </h3>

                        <p class="text-sm text-gray-500">

                            Cuéntales a los profesionales qué perfiles buscas.

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- TIPO CONTRATACIÓN --}}

                <div>

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Tipo de contratación

                    </label>

                    <select
                        name="tipo_contratacion"
                        class="w-full rounded-xl border-gray-600 p-2 border
                               bg-horeca-fondo
                               text-white
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">

                        <option value="">
                            Seleccionar
                        </option>

                        <option
                            value="Tiempo completo"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Tiempo completo')>
                            Tiempo completo
                        </option>

                        <option
                            value="Medio tiempo"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Medio tiempo')>
                            Medio tiempo
                        </option>

                        <option
                            value="Por proyecto"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Por proyecto')>
                            Por proyecto
                        </option>

                        <option
                            value="Temporal"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Temporal')>
                            Temporal
                        </option>

                        <option
                            value="Prácticas"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Prácticas')>
                            Prácticas
                        </option>

                        <option
                            value="Otro"
                            @selected(old('tipo_contratacion', $empresa->tipo_contratacion ?? '') === 'Otro')>
                            Otro
                        </option>

                    </select>

                    @error('tipo_contratacion')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- PERFILES QUE BUSCA --}}

                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-gray-400 mb-2">

                        Perfiles que busca

                    </label>

                    <textarea
                        name="perfiles_busca"
                        rows="4"
                        maxlength="2000"
                        placeholder="Ej. Chefs, cocineros, bartenders, mozos, administradores, recepcionistas..."
                        class="w-full rounded-xl border-gray-600 p-2 border
                               focus:border-[#C9A44D]
                               focus:ring-[#C9A44D]">{{ old('perfiles_busca', $empresa->perfiles_busca ?? '') }}</textarea>

                    @error('perfiles_busca')

                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                    <p class="text-xs text-gray-400 mt-1">

                        Describe los perfiles profesionales que normalmente requiere tu empresa.

                    </p>

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

                            Presenta tu empresa y muestra lo que la hace especial.

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

                    Formatos permitidos: MP4, MOV, AVI y WEBM. Máximo 50 MB.

                </p>


                @error('video_presentacion')

                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>

                @enderror


                @if(!empty($empresa->video_presentacion))

                    <div class="mt-6">

                        <div class="flex items-center justify-between mb-3">

                            <p class="text-sm font-semibold text-gray-400">

                                Video actual

                            </p>

                            <span class="text-xs text-green-500 font-semibold">

                                Video cargado

                            </span>

                        </div>


                        <div class="max-w-3xl overflow-hidden rounded-2xl border border-white/10 bg-black">

                            <video
                                controls
                                preload="metadata"
                                playsinline
                                class="aspect-video w-full object-contain">

                                <source
                                    src="{{ asset('storage/' . $empresa->video_presentacion) }}"
                                    type="video/mp4">

                                Tu navegador no soporta la reproducción de video.

                            </video>

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMACIÓN PÚBLICA --}}
        {{-- ========================================================= --}}

        <div class="bg-white/5 rounded-2xl shadow-sm border border-white/8">

            <div class="px-6 py-5 border-b border-white/9">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-[#0C1C3C]/10
                                flex items-center justify-center">

                        <i class="fa-solid fa-eye text-color-horeca-titulos"></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-color-horeca-titulos">

                            Presencia en Directorio PRO

                        </h3>

                        <p class="text-sm text-gray-500">

                            Esta información podrá mostrarse en el perfil público de tu empresa.

                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="rounded-xl border border-horeca-dorado/20 bg-horeca-dorado/[0.04] p-4">

                    <div class="flex items-start gap-3">

                        <i class="fa-solid fa-circle-info text-horeca-dorado mt-1"></i>

                        <div>

                            <p class="text-sm font-semibold text-white">

                                Tu empresa en HORECA PRO

                            </p>

                            <p class="mt-1 text-sm leading-6 text-white/50">

                                Completa tu información, descripción y video de presentación
                                para que los profesionales puedan conocer mejor tu empresa
                                desde el Directorio PRO.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BOTONES --}}
        {{-- ========================================================= --}}

        <div class="flex flex-col sm:flex-row justify-end gap-3">

            <a
                href="{{ route('dashboard') }}"
                class="px-6 py-3 rounded-xl
                       border border-gray-600
                       text-gray-300
                       font-semibold
                       text-center
                       hover:bg-white/5
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