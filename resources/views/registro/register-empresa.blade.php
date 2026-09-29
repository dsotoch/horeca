<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Registro Empresa | CLUB HORECA PRO</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<style>
    input,
    textarea {
        color: white;
    }
</style>


<body class="min-h-screen bg-horeca-fondo font-sans text-gray-900">


    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-4xl">


            {{-- ========================================= --}}
            {{-- LOGO --}}
            {{-- ========================================= --}}

            <div class="text-center mb-8">

                <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center justify-center
                           w-24 h-24
                           rounded-2xl
                           border border-horeca-dorado/50
                           bg-horeca-dorado/10
                           shadow-lg shadow-horeca-dorado/10">

                    <img
                        src="{{ asset('images/hor.png') }}"
                        alt="M&M CLUB HORECA PRO"
                        class="h-auto w-auto object-contain">

                </a>


                <h1 class="mt-5 text-2xl md:text-3xl text-horeca-titulos font-bold ">
                    CLUB HORECA PRO
                </h1>


                <p class="mt-2 text-horeca-gray text-base">
                    Registro de empresa
                </p>

            </div>



            {{-- ========================================= --}}
            {{-- CARD --}}
            {{-- ========================================= --}}

            <div class="bg-white/5 rounded-xl shadow-2xl p-6 sm:p-8 md:p-10">


                {{-- CABECERA --}}

                <div class="mb-8">

                    <h2 class="text-2xl md:text-3xl font-bold text-horeca-dorado">
                        Registra tu empresa
                    </h2>

                    <p class="mt-2 text-white/80 text-base">
                        Conecta tu empresa con profesionales seleccionados
                        del sector HORECA.
                    </p>

                </div>



                {{-- ========================================= --}}
                {{-- INDICADOR DE PASOS --}}
                {{-- ========================================= --}}

                <div class="flex items-center mb-10">

                    {{-- PASO 1 --}}

                    <div class="flex items-center">

                        <div class="w-9 h-9 rounded-full
                                    bg-horeca-dorado
                                    text-white/80
                                    flex items-center justify-center
                                    font-bold">
                            1
                        </div>

                        <span class="ml-2 text-[14px] font-normal text-horeca-dorado">
                            Empresa
                        </span>

                    </div>


                    <div class="flex-1 h-px bg-gray-200 mx-3"></div>


                    {{-- PASO 2 --}}

                    <div class="flex items-center">

                        <div class="w-9 h-9 rounded-full
                                    bg-gray-100
                                    text-gray-400
                                    flex items-center justify-center
                                    font-bold">
                            2
                        </div>

                        <span class="ml-2 text-sm text-gray-400">
                            Contacto
                        </span>

                    </div>


                    <div class="flex-1 h-px bg-gray-200 mx-3"></div>


                    {{-- PASO 3 --}}

                    <div class="flex items-center">

                        <div class="w-9 h-9 rounded-full
                                    bg-gray-100
                                    text-gray-400
                                    flex items-center justify-center
                                    font-bold">
                            3
                        </div>

                        <span class="ml-2 text-sm text-gray-400">
                            Finalizar
                        </span>

                    </div>

                </div>



                <form
                    method="POST"
                    action="{{ route('register.empresa.store') }}"
                    enctype="multipart/form-data">

                    @csrf



                    {{-- ========================================= --}}
                    {{-- INFORMACIÓN DE LA EMPRESA --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">


                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1" />

                                </svg>

                            </div>


                            <div>

                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Información de la empresa
                                </h3>

                                <p class="text-sm text-white/80">
                                    Datos principales de tu empresa.
                                </p>

                            </div>

                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- RUC --}}

                            <div>

                                <label
                                    for="ruc"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    RUC

                                </label>

                                <input
                                    type="text"
                                    id="ruc"
                                    name="ruc"
                                    value="{{ old('ruc') }}"
                                    required
                                    maxlength="11"
                                    inputmode="numeric"
                                    placeholder="Ej. 20123456789"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- RAZÓN SOCIAL --}}

                            <div>

                                <label
                                    for="razon_social"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Razón social

                                </label>

                                <input
                                    type="text"
                                    id="razon_social"
                                    name="razon_social"
                                    value="{{ old('razon_social') }}"
                                    required
                                    placeholder="Nombre legal de la empresa"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- NOMBRE COMERCIAL --}}

                            <div>

                                <label
                                    for="nombre_comercial"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Nombre comercial

                                </label>

                                <input
                                    type="text"
                                    id="nombre_comercial"
                                    name="nombre_comercial"
                                    value="{{ old('nombre_comercial') }}"
                                    required
                                    placeholder="Ej. Restaurante El Buen Sabor"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- TIPO DE EMPRESA --}}

                            <div>

                                <label
                                    for="tipo_empresa"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Tipo de empresa

                                </label>

                                <select
                                    id="tipo_empresa"
                                    name="tipo_empresa"
                                    required
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-horeca-fondo
                                           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    <option value="restaurante">
                                        Restaurante
                                    </option>

                                    <option value="hotel">
                                        Hotel
                                    </option>

                                    <option value="bar">
                                        Bar
                                    </option>

                                    <option value="cafeteria">
                                        Cafetería
                                    </option>

                                    <option value="catering">
                                        Catering
                                    </option>

                                    <option value="discoteca">
                                        Discoteca
                                    </option>

                                    <option value="panaderia">
                                        Panadería / Pastelería
                                    </option>

                                    <option value="eventos">
                                        Eventos
                                    </option>

                                    <option value="otro">
                                        Otro
                                    </option>

                                </select>

                            </div>



                            {{-- SITIO WEB --}}

                            <div>

                                <label
                                    for="sitio_web"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Sitio web

                                    <span class="text-gray-400">
                                        (opcional)
                                    </span>

                                </label>

                                <input
                                    type="url"
                                    id="sitio_web"
                                    name="sitio_web"
                                    value="{{ old('sitio_web') }}"
                                    placeholder="https://www.tuempresa.com"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- RED SOCIAL --}}

                            <div>

                                <label
                                    for="red_social"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Red social principal

                                    <span class="text-gray-400">
                                        (opcional)
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="red_social"
                                    name="red_social"
                                    value="{{ old('red_social') }}"
                                    placeholder="Instagram, Facebook, etc."
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>

                        </div>

                    </div>



                    {{-- ========================================= --}}
                    {{-- PERSONA DE CONTACTO --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">


                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                </svg>

                            </div>


                            <div>

                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Persona de contacto
                                </h3>

                                <p class="text-sm text-white/80">
                                    Responsable de la relación con CLUB HORECA PRO.
                                </p>

                            </div>

                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- NOMBRES --}}

                            <div>

                                <label
                                    for="contacto_nombres"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Nombres

                                </label>

                                <input
                                    type="text"
                                    id="contacto_nombres"
                                    name="contacto_nombres"
                                    value="{{ old('contacto_nombres') }}"
                                    required
                                    placeholder="Nombres del responsable"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- APELLIDOS --}}

                            <div>

                                <label
                                    for="contacto_apellidos"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Apellidos

                                </label>

                                <input
                                    type="text"
                                    id="contacto_apellidos"
                                    name="contacto_apellidos"
                                    value="{{ old('contacto_apellidos') }}"
                                    required
                                    placeholder="Apellidos del responsable"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- CARGO --}}

                            <div>

                                <label
                                    for="cargo"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Cargo

                                </label>

                                <select
                                    id="cargo"
                                    name="cargo"
                                    required
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-horeca-fondo
                                           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    <option value="gerente">
                                        Gerente
                                    </option>

                                    <option value="administrador">
                                        Administrador
                                    </option>

                                    <option value="recursos_humanos">
                                        Recursos Humanos
                                    </option>

                                    <option value="propietario">
                                        Propietario
                                    </option>

                                    <option value="jefe_operaciones">
                                        Jefe de Operaciones
                                    </option>

                                    <option value="otro">
                                        Otro
                                    </option>

                                </select>

                            </div>



                            {{-- CELULAR --}}

                            <div>

                                <label
                                    for="celular"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Celular

                                </label>

                                <input
                                    type="tel"
                                    id="celular"
                                    name="celular"
                                    value="{{ old('celular') }}"
                                    required
                                    autocomplete="tel"
                                    placeholder="999 999 999"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- CORREO --}}

                            <div class="md:col-span-2">

                                <label
                                    for="email"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Correo electrónico empresarial

                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="contacto@empresa.com"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>

                        </div>

                    </div>



                    {{-- ========================================= --}}
                    {{-- UBICACIÓN --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">


                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.343a8 8 0 1111.314 0z" />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                </svg>

                            </div>


                            <div>

                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Ubicación
                                </h3>

                                <p class="text-sm text-white/80">
                                    Indica dónde opera tu empresa.
                                </p>

                            </div>

                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- DEPARTAMENTO --}}

                            <div>

                                <label
                                    for="departamento"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Departamento

                                </label>

                                <input
                                    type="text"
                                    id="departamento"
                                    name="departamento"
                                    value="{{ old('departamento') }}"
                                    required
                                    placeholder="Ej. La Libertad"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- CIUDAD --}}

                            <div>

                                <label
                                    for="ciudad"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Ciudad

                                </label>

                                <input
                                    type="text"
                                    id="ciudad"
                                    name="ciudad"
                                    value="{{ old('ciudad') }}"
                                    required
                                    placeholder="Ej. Trujillo"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- DISTRITO --}}

                            <div>

                                <label
                                    for="distrito"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Distrito

                                </label>

                                <input
                                    type="text"
                                    id="distrito"
                                    name="distrito"
                                    value="{{ old('distrito') }}"
                                    required
                                    placeholder="Ej. Víctor Larco"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- DIRECCIÓN --}}

                            <div>

                                <label
                                    for="direccion"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Dirección

                                </label>

                                <input
                                    type="text"
                                    id="direccion"
                                    name="direccion"
                                    value="{{ old('direccion') }}"
                                    required
                                    placeholder="Dirección del establecimiento"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>

                        </div>

                    </div>



                    {{-- ========================================= --}}
                    {{-- NECESIDADES DE LA EMPRESA --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">


                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg
                                    class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />

                                </svg>

                            </div>


                            <div>

                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Necesidades de contratación
                                </h3>

                                <p class="text-sm text-white/80">
                                    Cuéntanos qué perfiles profesionales buscas.
                                </p>

                            </div>

                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- PERFILES --}}

                            <div class="md:col-span-2">

                                <label
                                    for="perfiles_busca"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Perfiles profesionales que buscas

                                </label>

                                <input
                                    type="text"
                                    id="perfiles_busca"
                                    name="perfiles_busca"
                                    value="{{ old('perfiles_busca') }}"
                                    placeholder="Ej. Chef, bartender, administrador, mozo..."
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                <p class="mt-2 text-xs text-gray-400">
                                    Puedes separar los perfiles con comas.
                                </p>

                            </div>



                            {{-- TIPO DE CONTRATACIÓN --}}

                            <div>

                                <label
                                    for="tipo_contratacion"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Tipo de contratación

                                </label>

                                <select
                                    id="tipo_contratacion"
                                    name="tipo_contratacion"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-horeca-fondo
                                           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                    <option value="">
                                        Seleccionar
                                    </option>

                                    <option value="tiempo_completo">
                                        Tiempo completo
                                    </option>

                                    <option value="medio_tiempo">
                                        Medio tiempo
                                    </option>

                                    <option value="eventual">
                                        Eventual
                                    </option>

                                    <option value="por_evento">
                                        Por evento
                                    </option>

                                    <option value="freelance">
                                        Freelance
                                    </option>

                                    <option value="varios">
                                        Varios
                                    </option>

                                </select>

                            </div>



                            {{-- CANTIDAD --}}

                            <div>

                                <label
                                    for="cantidad_profesionales"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Cantidad aproximada de profesionales

                                </label>

                                <input
                                    type="number"
                                    id="cantidad_profesionales"
                                    name="cantidad_profesionales"
                                    value="{{ old('cantidad_profesionales') }}"
                                    min="1"
                                    placeholder="Ej. 5"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- DESCRIPCIÓN --}}

                            <div class="md:col-span-2">

                                <label
                                    for="descripcion"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Sobre la empresa y sus necesidades

                                </label>

                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    rows="5"
                                    placeholder="Cuéntanos brevemente sobre tu empresa, el tipo de servicios que brinda y qué profesionales necesitas incorporar..."
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           resize-none
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">{{ old('descripcion') }}</textarea>

                            </div>

                        </div>

                    </div>



                    {{-- ========================================= --}}
                    {{-- CONTRASEÑA --}}
                    {{-- ========================================= --}}

                    <div class="mb-8">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                            {{-- PASSWORD --}}

                            <div>

                                <label
                                    for="password"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Contraseña

                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Mínimo 8 caracteres"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>



                            {{-- CONFIRMAR --}}

                            <div>

                                <label
                                    for="password_confirmation"
                                    class="block text-[14px] font-normal text-white/80 mb-2">

                                    Confirmar contraseña

                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Repite tu contraseña"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           bg-transparent
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>

                        </div>

                    </div>



                    {{-- ========================================= --}}
                    {{-- TÉRMINOS --}}
                    {{-- ========================================= --}}

                    <div class="mb-7">

                        <label class="flex items-start gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="terminos"
                                required
                                class="mt-1 w-4 h-4 accent-[#EDA100]">

                            <span class="text-sm text-white/80">

                                Acepto los términos y condiciones y autorizo
                                el tratamiento de los datos de mi empresa
                                para la gestión de nuestra membresía en
                                 CLUB HORECA PRO.

                            </span>

                        </label>

                    </div>



                    {{-- ========================================= --}}
                    {{-- BOTÓN --}}
                    {{-- ========================================= --}}

                    <button
                        type="submit"
                        class="w-full py-3.5 rounded-xl
                               bg-gradient-to-r
                               from-[#B87900]
                               via-[#EDA100]
                               to-[#FBEC5D]
                               text-black
                               text-base
                               font-semibold
                               shadow-lg shadow-horeca-dorado/20
                               hover:brightness-105
                               hover:shadow-horeca-dorado/40
                               transition-all duration-300">

                        Registrar empresa

                    </button>


                </form>



                {{-- ========================================= --}}
                {{-- LOGIN --}}
                {{-- ========================================= --}}

                <div class="text-center mt-8 pt-7 border-t border-gray-200">

                    <p class="text-white/80 text-base">

                        ¿Ya tienes una cuenta?

                        <a
                            href="{{ route('login') }}"
                            class="ml-1 text-horeca-dorado font-bold
                                   hover:text-horeca-dorado2
                                   transition-colors">

                            Iniciar sesión

                        </a>

                    </p>

                </div>


            </div>



            {{-- ========================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================= --}}

            <p class="text-center text-sm text-white/80 mt-6">

                CLUB HORECA PRO · Conectando empresas y profesionales HORECA

            </p>


        </div>

    </div>


</body>

</html>