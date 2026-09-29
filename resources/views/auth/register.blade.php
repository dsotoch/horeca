<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Crear cuenta | CLUB HORECA PRO
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-horeca-fondo py-10 px-6">


    <div class="max-w-4xl mx-auto">


        {{-- HEADER --}}

        <div class="text-center mb-10">


            <h1 class="text-3xl font-bold text-white">

                Únete a 

            </h1>


            <p class="text-horeca-titulos
                      font-semibold
                      tracking-[0.2em]
                      text-xl
                      mt-2">

              CLUB HORECA PRO

            </p>


            <p class="text-[#D9D9D9] mt-4 text-base">

                Forma parte de una comunidad que conecta
                talento y empresas.

            </p>
            <div class="text-center text-[17px] mx-auto m-2 text-white underline">
                <a href="{{ route('vision-mision') }}" class="hover:text-horeca-dorado  transition-colors">
                    Nuestra Visión y Misión
                </a>
            </div>
        </div>



        {{-- CARD --}}

        <div class="bg-white/5 rounded-xl shadow-2xl p-8 md:p-10">


            <div class="text-center mb-8">

                <h2 class="text-2xl font-bold text-horeca-dorado">

                    ¿Cómo quieres formar parte?

                </h2>

                <p class="text-white text-base mt-2">

                    Selecciona el tipo de cuenta que deseas crear.

                </p>

            </div>


            <div class="grid md:grid-cols-2 gap-6">


                {{-- PROFESIONAL --}}

                <a
                    href="{{ route('register.profesional') }}"
                    class="group
                           border-2
                           border-gray-200
                           rounded-2xl
                           p-7
                           hover:border-horeca-dorado
                           hover:shadow-lg
                           transition">

                    <div class="w-14 h-14
                                rounded-xl
                                bg-[#0C1C3C]
                                flex items-center justify-center
                                mb-5">

                        <svg
                            class="w-7 h-7 text-horeca-dorado"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0
                                   4 4 0 018 0z
                                   M12 14a7 7 0 00-7 7h14
                                   a7 7 0 00-7-7z" />
                        </svg>

                    </div>


                    <h3 class="text-xl font-bold text-horeca-dorado
                               group-hover:text-horeca-dorado">

                        Profesional

                    </h3>


                    <p class="text-white text-base mt-3 text-sm leading-relaxed">

                        Presenta tu experiencia, fortalece tu perfil
                        y encuentra oportunidades de crecimiento
                        profesional con empresas HORECA.

                    </p>


                    <div class="mt-6 text-horeca-dorado font-semibold">

                        Crear cuenta →

                    </div>

                </a>


                {{-- EMPRESA --}}

                <a
                    href="{{ route('register.empresa') }}"
                    class="group
                           border-2
                           border-gray-200
                           rounded-2xl
                           p-7
                           hover:border-horeca-dorado
                           hover:shadow-lg
                           transition">

                    <div class="w-14 h-14
                                rounded-xl
                                bg-[#0C1C3C]
                                flex items-center justify-center
                                mb-5">

                        <svg
                            class="w-7 h-7 text-horeca-dorado"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 21h18
                                   M5 21V7l8-4 6 4v14
                                   M9 21v-6h6v6
                                   M9 10h.01
                                   M13 10h.01
                                   M9 13h.01
                                   M13 13h.01" />
                        </svg>

                    </div>


                    <h3 class="text-xl font-bold text-horeca-dorado
                               group-hover:text-horeca-dorado">

                        Empresa HORECA

                    </h3>


                    <p class="text-white text-base mt-3 text-sm leading-relaxed">

                        Forma parte del club, conecta con profesionales
                        y encuentra el talento que tu empresa necesita.

                    </p>


                    <div class="mt-6 text-horeca-dorado font-semibold">

                        Crear cuenta →

                    </div>

                </a>


            </div>


            {{-- LOGIN --}}

            <div class="text-center mt-10 pt-7 border-t border-gray-200">

                <p class="text-white text-base">
                    Portal para miembros
                    <a
                        href="{{ route('login') }}"
                        class="ml-1 text-horeca-dorado font-bold hover:text-horeca-dorado2 transition-colors">
                        Iniciar sesión
                    </a>
                </p>

            </div>


        </div>


        <p class="text-center text-xs text-[#D9D9D9]/60 mt-6">

            © {{ date('Y') }}  CLUB HORECA PRO

        </p>


    </div>

</body>

</html>