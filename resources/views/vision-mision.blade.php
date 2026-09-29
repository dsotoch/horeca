<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Nuestra Misión-Visión | CLUB HORECA PRO
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-horeca-fondo py-6 px-4 md:py-10 md:px-6">


    <section class="max-w-6xl mx-auto min-h-[calc(100vh-3rem)] 
                    bg-[#02060D] rounded-2xl overflow-hidden shadow-2xl
                    border border-white/10 flex">


        <!-- Franja lateral -->
        <div class="hidden md:flex w-24 lg:w-28 bg-[#07345F] relative overflow-hidden
                    items-center justify-center">

            <div class="absolute inset-0 bg-gradient-to-b
                        from-[#07345F] via-[#0a416f] to-[#02060D]">
            </div>

        </div>


        <!-- Contenido -->
        <div class="flex-1 relative px-6 py-8 md:px-10 md:py-10 lg:px-14">


            <!-- Botón volver -->
            <a
                href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2
                       text-sm text-white/70
                       hover:text-horeca-dorado
                       transition-colors duration-300 mb-8">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />

                </svg>

                Volver

            </a>


            <!-- Logo -->
            <div class="flex justify-center mb-7">

                <div class="relative group">

                    <!-- Resplandor -->
                    <div class="absolute inset-0
                                bg-horeca-dorado/20
                                blur-2xl
                                rounded-full
                                scale-110">
                    </div>

                    <div class="relative bg-white/5
                                border border-horeca-dorado/30
                                rounded-2xl
                                px-6 py-4
                                shadow-xl">

                        <img
                            src="{{ asset('images/hor.png') }}"
                            alt="Club HORECA PRO"
                            class="h-16 md:h-20 w-auto object-contain">

                    </div>

                </div>

            </div>


            <!-- Encabezado -->
            <div class="text-center mb-8">

                <h1 class="text-2xl md:text-3xl
                           font-serif italic
                           font-semibold
                           text-horeca-titulos
                           tracking-wide">

                    CLUB HORECA - PRO

                </h1>

                <h2 class="text-xl md:text-2xl
                           font-serif
                           font-bold
                           text-white
                           mt-1">

                    MISIÓN Y VISIÓN

                </h2>

            </div>


            <!-- Contenido -->
            <div class="max-w-3xl mx-auto space-y-7">


                <!-- Misión -->
                <div>

                    <h3 class="text-lg md:text-xl
                               font-serif
                               italic
                               text-horeca-dorado
                               mb-2">

                        Misión

                    </h3>

                    <p class="text-base md:text-lg
                              font-serif
                              leading-relaxed
                              text-white/85">

                        Somos un club Pro de trabajo y desarrollo,
                        formado para impulsar el crecimiento de
                        profesionales y empresarios líderes del
                        escenario HORECA.

                    </p>

                </div>


                <!-- Línea decorativa -->
                <div class="h-px bg-gradient-to-r
                            from-transparent
                            via-horeca-dorado/40
                            to-transparent">
                </div>


                <!-- Visión -->
                <div>

                    <h3 class="text-lg md:text-xl
                               font-serif
                               italic
                               text-horeca-dorado
                               mb-2">

                        Visión

                    </h3>

                    <p class="text-base md:text-lg
                              font-serif
                              leading-relaxed
                              text-white/85">

                        Ser uno de los clubes HORECA Pro más
                        reconocidos por promover el desarrollo
                        y crecimiento de profesionales y
                        empresarios líderes del escenario HORECA.

                    </p>

                </div>

            </div>


            <!-- Pie -->
            <div class="text-center mt-10">

                <a
                    href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center
                           px-6 py-2.5
                           rounded-full
                           border border-horeca-dorado/50
                           text-sm
                           text-horeca-dorado
                           hover:bg-horeca-dorado
                           hover:text-[#02060D]
                           transition-all duration-300">

                    ← Volver

                </a>

            </div>


        </div>

    </section>


</body>

</html>