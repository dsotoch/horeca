<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro Profesional | CLUB HORECA PRO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    input {
        color: white;
    }
</style>

<body class="min-h-screen bg-horeca-fondo font-sans text-gray-900">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-4xl">

            {{-- LOGO --}}
            <div class="text-center mb-8">

                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center w-24 h-24
                          rounded-2xl
                          border border-horeca-dorado/50
                          bg-horeca-dorado/10
                          shadow-lg shadow-horeca-dorado/10">

                    <img
                        src="{{ asset('images/hor.png') }}"
                        alt="M&M"
                        class="h-auto w-auto object-contain">

                </a>

                <h1 class="mt-5 text-2xl md:text-3xl  font-bold text-horeca-titulos">
                    CLUB HORECA PRO
                </h1>

                <p class="mt-2 text-horeca-gray text-base">
                    Registro de profesional
                </p>

            </div>


            {{-- CARD --}}
            <div class="bg-white/5 rounded-xl shadow-2xl p-6 sm:p-8 md:p-10">

                {{-- CABECERA --}}
                <div class="mb-8">

                    <h2 class="text-2xl md:text-3xl font-bold text-horeca-dorado">
                        Crea tu perfil profesional
                    </h2>

                    <p class="mt-2 text-white/80 text-base">
                        Forma parte de una comunidad profesional conectada con empresas HORECA.
                    </p>

                </div>


                {{-- INDICADOR DE PASOS --}}
                <div class="flex items-center mb-10">

                    <div class="flex items-center">

                        <div class="w-9 h-9 rounded-full
                                    bg-horeca-dorado
                                    text-white/80
                                    flex items-center justify-center
                                    font-bold">
                            1
                        </div>

                        <span class="ml-2 text-[14px] font-normal text-horeca-dorado">
                            Cuenta
                        </span>

                    </div>

                    <div class="flex-1 h-px bg-gray-200 mx-3"></div>

                    <div class="flex items-center">

                        <div class="w-9 h-9 rounded-full
                                    bg-gray-100
                                    text-gray-400
                                    flex items-center justify-center
                                    font-bold">
                            2
                        </div>

                        <span class="ml-2 text-sm text-gray-400">
                            Perfil
                        </span>

                    </div>

                    <div class="flex-1 h-px bg-gray-200 mx-3"></div>

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
                @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4">
                    <div class="font-bold text-red-400 mb-2">
                        Hay algunos errores en el formulario:
                    </div>

                    <ul class="list-disc list-inside text-sm text-red-300 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST"
                    action="{{ route('register.profesional.store') }}"
                    enctype="multipart/form-data">

                    @csrf


                    {{-- ========================================= --}}
                    {{-- DATOS PERSONALES --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">

                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Datos personales
                                </h3>

                                <p class="text-sm text-white/80">
                                    Información básica para crear tu cuenta.
                                </p>
                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NOMBRES --}}
                            <div>
                                <label for="nombres"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Nombres
                                </label>

                                <input
                                    type="text"
                                    id="nombres"
                                    name="nombres"
                                    value="{{ old('nombres') }}"
                                    required
                                    autocomplete="given-name"
                                    placeholder="Ingresa tus nombres"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- APELLIDOS --}}
                            <div>
                                <label for="apellidos"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Apellidos
                                </label>

                                <input
                                    type="text"
                                    id="apellidos"
                                    name="apellidos"
                                    value="{{ old('apellidos') }}"
                                    required
                                    autocomplete="family-name"
                                    placeholder="Ingresa tus apellidos"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- DOCUMENTO --}}
                            <div>
                                <label for="tipo_documento"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Tipo de documento
                                </label>

                                <select
                                    id="tipo_documento"
                                    name="tipo_documento"
                                    required
                                    class="w-full px-4 py-3 rounded-xl
           border border-gray-300
           bg-horeca-fondo
           text-white/80
           focus:border-horeca-dorado
           focus:ring-2 focus:ring-horeca-dorado/20
           outline-none transition">
                                    <option value="" class="bg-horeca-fondo text-white">
                                        Seleccionar
                                    </option>

                                    <option
                                        value="DNI"
                                        class="bg-horeca-fondo text-white"
                                        {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>
                                        DNI
                                    </option>

                                    <option
                                        value="CE"
                                        class="bg-horeca-fondo text-white"
                                        {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>
                                        Carné de extranjería
                                    </option>
                                </select>
                            </div>


                            {{-- NUMERO DOCUMENTO --}}
                            <div>
                                <label for="numero_documento"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Número de documento
                                </label>

                                <input
                                    type="text"
                                    id="numero_documento"
                                    name="numero_documento"
                                    value="{{ old('numero_documento') }}"
                                    required
                                    placeholder="Número de documento"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- CELULAR --}}
                            <div>
                                <label for="celular"
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
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- CORREO --}}
                            <div>
                                <label for="email"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="correo@ejemplo.com"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- INFORMACIÓN PROFESIONAL --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">

                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5z" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.657-2.686 3-6 3s-6-1.343-6-3c0-.408.062-.804.18-1.178L12 14z" />

                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Perfil profesional
                                </h3>

                                <p class="text-sm text-white/80">
                                    Cuéntanos sobre tu experiencia y especialidad.
                                </p>
                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- ESPECIALIDAD --}}
                            <div>
                                <label for="especialidad"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Especialidad / profesión
                                </label>

                                <input
                                    type="text"
                                    id="especialidad"
                                    name="especialidad"
                                    value="{{ old('especialidad') }}"
                                    required
                                    placeholder="Ej. Chef, Bartender, Administrador"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- SUBESPECIALIDAD --}}
                            <div>
                                <label for="subespecialidad"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Subespecialidad
                                    <span class="font-normal text-gray-400">
                                        (opcional)
                                    </span>
                                </label>

                                <input
                                    type="text"
                                    id="subespecialidad"
                                    name="subespecialidad"
                                    value="{{ old('subespecialidad') }}"
                                    placeholder="Ej. Cocina internacional"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- EXPERIENCIA --}}
                            <div>
                                <label for="experiencia"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Años de experiencia
                                </label>

                                <select
                                    id="experiencia"
                                    name="experiencia"
                                    required
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                            bg-horeca-fondo
           text-white/80
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                    <option value="">Seleccionar</option>
                                    <option value="0-1">Menos de 1 año</option>
                                    <option value="1-3">1 a 3 años</option>
                                    <option value="3-5">3 a 5 años</option>
                                    <option value="5-10">5 a 10 años</option>
                                    <option value="10+">Más de 10 años</option>

                                </select>
                            </div>


                            {{-- MODALIDAD --}}
                            <div>
                                <label for="modalidad"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Modalidad de trabajo
                                </label>

                                <select
                                    id="modalidad"
                                    name="modalidad"
                                    required
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                         
           bg-horeca-fondo
           text-white
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                    <option value="">Seleccionar</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="remoto">Remoto</option>
                                    <option value="hibrido">Híbrido</option>

                                </select>
                            </div>


                            {{-- CIUDAD --}}
                            <div>
                                <label for="ciudad"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Ciudad
                                </label>

                                <input
                                    type="text"
                                    id="ciudad"
                                    name="ciudad"
                                    value="{{ old('ciudad') }}"
                                    required
                                    placeholder="Ej. Lima"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- DISTRITO --}}
                            <div>
                                <label for="distrito"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Distrito
                                </label>

                                <input
                                    type="text"
                                    id="distrito"
                                    name="distrito"
                                    value="{{ old('distrito') }}"
                                    required
                                    placeholder="Ej. Miraflores"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">
                            </div>


                            {{-- DESCRIPCION --}}
                            <div class="md:col-span-2">

                                <label for="descripcion"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Descripción profesional
                                </label>

                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    rows="5"
                                    required
                                    placeholder="Cuéntanos brevemente sobre tu experiencia, fortalezas y trayectoria profesional..."
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           resize-none
                                           text-white
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">{{ old('descripcion') }}</textarea>

                            </div>


                            {{-- HABILIDADES --}}
                            <div class="md:col-span-2">

                                <label for="habilidades"
                                    class="block text-[14px] font-normal text-white/80 mb-2">
                                    Habilidades
                                </label>

                                <input
                                    type="text"
                                    id="habilidades"
                                    name="habilidades"
                                    value="{{ old('habilidades') }}"
                                    placeholder="Ej. Liderazgo, cocina, gestión, atención al cliente"
                                    class="w-full px-4 py-3 rounded-xl
                                           border border-gray-300
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                                <p class="mt-2 text-xs text-gray-400">
                                    Puedes separar las habilidades con comas.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- VIDEO --}}
                    {{-- ========================================= --}}

                    <div class="mb-10">

                        <div class="flex items-center gap-3 mb-6">

                            <div class="w-10 h-10 rounded-xl
                                        bg-horeca-dorado/10
                                        flex items-center justify-center">

                                <svg class="w-5 h-5 text-horeca-dorado"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />

                                </svg>

                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-horeca-dorado">
                                    Video de presentación
                                </h3>

                                <p class="text-sm text-white/80">
                                    Preséntate brevemente ante las empresas.
                                </p>
                            </div>

                        </div>


                        <div class="border-2 border-dashed border-gray-300
                                    rounded-2xl p-6 text-center
                                    hover:border-horeca-dorado/60
                                    transition">

                            <svg class="w-10 h-10 mx-auto text-horeca-dorado mb-3"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />

                            </svg>

                            <p class="font-bold text-horeca-dorado">
                                Sube tu video de presentación
                            </p>

                            <p class="text-sm text-white/80 mt-1">
                                Máximo 1 minuto
                            </p>

                            <input
                                type="file"
                                name="video_presentacion"
                                id="video_presentacion"
                                accept="video/*"
                                class="mt-5 block w-full text-sm text-white/80
                                       file:mr-4 file:py-2.5 file:px-4
                                       file:rounded-lg file:border-0
                                       file:font-bold
                                       file:bg-horeca-dorado/10
                                       file:text-horeca-dorado
                                       hover:file:bg-horeca-dorado/20">

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- CONTRASEÑA --}}
                    {{-- ========================================= --}}

                    <div class="mb-8">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div>

                                <label for="password"
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
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>


                            <div>

                                <label for="password_confirmation"
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
                                           focus:border-horeca-dorado
                                           focus:ring-2 focus:ring-horeca-dorado/20
                                           outline-none transition">

                            </div>

                        </div>

                    </div>


                    {{-- TÉRMINOS --}}
                    <div class="mb-7">

                        <label class="flex items-start gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="terminos"
                                required
                                class="mt-1 w-4 h-4 accent-[#EDA100]">

                            <span class="text-sm text-white/80">
                                Acepto los términos y condiciones y autorizo el tratamiento de mis datos para la gestión de mi membresía en M&M CLUB HORECA PRO.
                            </span>

                        </label>

                    </div>


                    {{-- BOTÓN --}}
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

                        Crear cuenta profesional

                    </button>

                </form>


                {{-- LOGIN --}}
                <div class="text-center mt-8 pt-7 border-t border-gray-200">

                    <p class="text-white/80 text-base">

                        Acceso para miembros

                        <a
                            href="{{ route('login') }}"
                            class="ml-1 text-horeca-dorado font-bold hover:text-horeca-dorado2 transition-colors">
                            Iniciar sesión
                        </a>

                    </p>

                </div>

            </div>


            {{-- FOOTER --}}
            <p class="text-center text-sm text-white/80 mt-6">
                CLUB HORECA PRO · Comunidad profesional HORECA
            </p>

        </div>

    </div>

</body>

</html>