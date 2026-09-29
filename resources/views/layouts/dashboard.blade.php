<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>
        @yield('title', 'Dashboard') | CLUB HORECA PRO
    </title>
    <style>
        button {
            cursor: pointer;
        }
    </style>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>


<body class="min-h-screen bg-horeca-fondo text-white">

    <div class="min-h-screen flex">


        {{-- ========================================================= --}}
        {{-- OVERLAY PARA MÓVIL --}}
        {{-- ========================================================= --}}

        <div
            id="sidebarOverlay"
            class="fixed inset-0 z-40 hidden bg-black/70 backdrop-blur-[2px] lg:hidden"
            onclick="cerrarSidebar()">
        </div>


        {{-- ========================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================================= --}}

        <aside
            id="sidebar"
            class="
                fixed
                inset-y-0
                left-0
                z-50
                w-[280px]
                shrink-0
                bg-[#080D16]
                border-r
                border-white/10
                transform
                -translate-x-full
                transition-transform
                duration-300
                ease-in-out

                lg:relative
                lg:translate-x-0
                lg:z-auto
            ">

            <div class="h-full flex flex-col overflow-y-auto">


                {{-- ================================================= --}}
                {{-- LOGO --}}
                {{-- ================================================= --}}

                <div class="px-6 py-6">

                    <div class="flex items-center justify-between">

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex items-center gap-3">

                            <div
                                class="w-11 h-11 rounded-full border border-horeca-dorado/50 flex items-center justify-center">

                                <img
                                    src="{{ asset('images/hor.png') }}"
                                    alt="M&M"
                                    class="h-auto w-auto object-cover">

                            </div>

                            <div class="leading-none">

                                <div
                                    class="text-[11px] tracking-[0.25em] text-white/70">
                                    CLUB
                                </div>

                                <div
                                    class="text-xl font-black tracking-wide">

                                    HORECA

                                    <span class="text-horeca-titulos">
                                        PRO
                                    </span>

                                </div>

                            </div>

                        </a>


                        {{-- BOTÓN CERRAR EN MÓVIL --}}

                        <button
                            type="button"
                            onclick="cerrarSidebar()"
                            class="
                                lg:hidden
                                h-9
                                w-9
                                rounded-xl
                                border
                                border-white/10
                                bg-[#111A29]
                                text-white/60
                                hover:text-white
                                hover:bg-white/10
                                transition
                            ">

                            <i class="fa-solid fa-xmark"></i>

                        </button>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- USUARIO / MEMBRESÍA --}}
                {{-- ================================================= --}}

                <div class="px-5 pb-6">

                    <div
                        class="
                            rounded-2xl
                            border
                            border-white/10
                            bg-[#111A29]
                            p-4
                        ">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span
                                    class="w-2 h-2 rounded-full bg-emerald-400">
                                </span>

                                <span
                                    class="text-xs font-bold text-horeca-titulos">

                                    {{ $usuario->rol === 'profesional'
                                        ? 'TALENTO PRO'
                                        : 'EMPRESA PRO' }}

                                </span>

                            </div>


                            <span
                                class="
                                    rounded-full
                                    bg-horeca-dorado/20
                                    px-3
                                    py-1
                                    text-[10px]
                                    font-bold
                                    text-horeca-titulos
                                ">

                                Nivel I

                            </span>

                        </div>


                        <p class="mt-2 text-xs text-white/50">
                            Membresía PRO Activa
                        </p>


                        <div class="flex gap-2 mt-4">

                            <a
                                href="#"
                                class="
                                    flex-1
                                    rounded-xl
                                    bg-[#182337]
                                    px-3
                                    py-2
                                    text-center
                                    text-xs
                                    font-semibold
                                    hover:bg-white/10
                                    transition
                                ">

                                Mi Cuenta

                            </a>


                            <a
                                href="#"
                                class="
                                    rounded-xl
                                    bg-horeca-dorado
                                    px-4
                                    py-2
                                    text-xs
                                    font-bold
                                    text-black
                                    hover:opacity-90
                                    transition
                                ">

                                ★ Pagar

                            </a>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- MENU --}}
                {{-- ================================================= --}}

                <div class="px-5">

                    <p
                        class="
                            mb-3
                            px-2
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-[0.2em]
                            text-white/40
                        ">

                        Plataforma principal

                    </p>


                    <nav class="space-y-1.5">

                        {{-- ========================================================= --}}
                        {{-- INICIO --}}
                        {{-- ========================================================= --}}

                        <a
                            href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'bg-horeca-dorado text-black shadow-lg shadow-horeca-dorado/10 font-bold' : '' }} text-white/60 font-semibold   group flex items-center justify-between rounded-xl  px-4 py-3 text-sm  transition hover:bg-white/5 hover:text-white ">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-house w-5 text-center"></i>
                                <span>Inicio</span>
                            </span>

                            @if(request()->routeIs('dashboard'))
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                            @endif


                        </a>


                        {{-- ========================================================= --}}
                        {{-- OPORTUNIDADES --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center justify-between rounded-xl px-4 py-3 flex items-center justify-between text-sm font-semibold text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-briefcase w-5 text-center"></i>
                                <span>Oportunidades</span>
                            </span>

                            @if(($estadisticas['oportunidades'] ?? 0) > 0)
                            <span class="rounded-full bg-red-500/80 px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $estadisticas['oportunidades'] }}
                            </span>
                            @endif

                        </a>


                        {{-- ========================================================= --}}
                        {{-- POSTULACIONES --}}
                        {{-- ========================================================= --}}

                        <a
                            href="{{route('postulaciones.index')}}"
                            class="{{ request()->routeIs('postulaciones.index') ? 'bg-horeca-dorado text-black shadow-lg shadow-horeca-dorado/10 font-bold' : '' }} group flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold flex items-center justify-between  text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-file-signature w-5 text-center"></i>
                                <span>Mis postulaciones</span>
                            </span>
                            

                            @if(($estadisticas['postulaciones'] ?? 0) > 0)
                            <span class="rounded-full bg-horeca-dorado/20 px-2 py-0.5 text-[10px] font-bold text-horeca-dorado">
                                {{ $estadisticas['postulaciones'] }}
                            </span>
                            @endif

                        </a>


                        {{-- ========================================================= --}}
                        {{-- DIRECTORIO --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center rounded-xl px-4 py-3 text-sm font-semibold flex items-center justify-between text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-users w-5 text-center"></i>
                                <span>Directorio PRO</span>
                            </span>
                        </a>


                        {{-- ========================================================= --}}
                        {{-- ACADEMIA --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center justify-between rounded-xl px-4 py-3 flex items-center justify-between text-sm font-semibold text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-graduation-cap w-5 text-center"></i>
                                <span>Academia PRO</span>
                            </span>

                            @if(($estadisticas['academia_pendiente'] ?? 0) > 0)
                            <span class="rounded-full bg-red-500/80 px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $estadisticas['academia_pendiente'] }}
                            </span>
                            @endif

                        </a>


                        {{-- ========================================================= --}}
                        {{-- CERTIFICACIONES --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center rounded-xl px-4 py-3 text-sm font-semibold flex items-center justify-between text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-award w-5 text-center"></i>
                                <span>Certificaciones</span>
                            </span>
                        </a>


                        {{-- ========================================================= --}}
                        {{-- SEPARADOR --}}
                        {{-- ========================================================= --}}

                        <div class="my-4 border-t border-white/10"></div>


                        {{-- ========================================================= --}}
                        {{-- PERFIL --}}
                        {{-- ========================================================= --}}

                        <a
                            href="{{ route('perfil.profesional') }}"
                            class="{{ request()->routeIs('perfil.profesional') ? 'bg-horeca-dorado text-black shadow-lg shadow-horeca-dorado/10 font-bold' : '' }} group flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-user w-5 text-center"></i>
                                <span>Mi perfil</span>
                            </span>

                             @if(request()->routeIs('perfil.profesional'))
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                            @endif
                        </a>


                        {{-- ========================================================= --}}
                        {{-- MEMBRESÍA --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-white/60 flex items-center justify-between transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-crown w-5 text-center"></i>
                                <span>Mi membresía</span>
                            </span>
                        </a>


                        {{-- ========================================================= --}}
                        {{-- NOTIFICACIONES --}}
                        {{-- ========================================================= --}}

                        <a
                            href="#"
                            class="group flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold flex items-center justify-between text-white/60 transition hover:bg-white/5 hover:text-white">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-bell w-5 text-center"></i>
                                <span>Notificaciones</span>
                            </span>

                            @if(($estadisticas['notificaciones'] ?? 0) > 0)
                            <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 text-[9px] font-bold text-white">
                                {{ $estadisticas['notificaciones'] }}
                            </span>
                            @endif

                        </a>

                    </nav>


                </div>



                {{-- ================================================= --}}
                {{-- USUARIO INFERIOR --}}
                {{-- ================================================= --}}

                <div class="mt-auto p-5">

                    <div
                        class="
                            rounded-2xl
                            border
                            border-white/10
                            bg-[#111A29]
                            p-4
                        ">

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    h-10
                                    w-10
                                    shrink-0
                                    rounded-full
                                    bg-horeca-dorado
                                    text-black
                                    flex
                                    items-center
                                    justify-center
                                    font-bold
                                ">

                                {{ strtoupper(substr($usuario->name, 0, 2)) }}

                            </div>


                            <div class="min-w-0">

                                <p
                                    class="
                                        text-sm
                                        font-bold
                                        truncate
                                    ">

                                    {{ $usuario->name }}

                                </p>


                                <p class="text-[11px] text-white/50">

                                    {{ ucfirst($usuario->rol) }}

                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="mt-4">

                            @csrf

                            <button
                                type="submit"
                                class="
                                    w-full
                                    rounded-xl
                                    bg-[#182337]
                                    px-3
                                    py-2
                                    text-xs
                                    font-semibold
                                    text-white/80
                                    hover:bg-white/10
                                    transition
                                ">

                                <i class="fa-solid fa-right-from-bracket mr-2"></i>

                                Cerrar sesión

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </aside>



        {{-- ========================================================= --}}
        {{-- CONTENIDO PRINCIPAL --}}
        {{-- ========================================================= --}}

        <div class="flex-1 min-w-0 w-full">


            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <header
                class="
                    min-h-[78px]
                    border-b
                    border-white/10
                    bg-[#0D1420]
                ">

                <div
                    class="
                        min-h-[78px]
                        px-4
                        sm:px-6
                        lg:px-8
                        py-3
                        flex
                        items-center
                        justify-between
                        gap-4
                    ">


                    {{-- IZQUIERDA --}}

                    <div class="flex items-center gap-3 min-w-0">


                        {{-- BOTÓN MENU MÓVIL --}}

                        <button
                            id="btnAbrirSidebar"
                            type="button"
                            onclick="abrirSidebar()"
                            class="
                                lg:hidden
                                h-10
                                w-10
                                shrink-0
                                rounded-xl
                                border
                                border-white/10
                                bg-[#111A29]
                                text-white/70
                                hover:text-white
                                hover:bg-white/10
                                transition
                            ">

                            <i class="fa-solid fa-bars"></i>

                        </button>


                        <div class="min-w-0">

                            <p
                                class="
                                    hidden
                                    sm:block
                                    text-[10px]
                                    font-bold
                                    tracking-[0.25em]
                                    text-horeca-titulos
                                    truncate
                                ">

                                CLUB HORECA PRO · PLATAFORMA OFICIAL

                            </p>


                            <h1
                                class="
                                    text-lg
                                    sm:text-2xl
                                    font-black
                                    truncate
                                ">

                                @yield(
                                'header-title',
                                'Panel principal'
                                )

                            </h1>

                        </div>

                    </div>



                    {{-- DERECHA --}}

                    <div
                        class="
                            flex
                            items-center
                            gap-2
                            sm:gap-3
                        ">


                        {{-- AYUDA --}}

                        <button
                            type="button"
                            class="
                                hidden
                                sm:flex
                                h-10
                                w-10
                                rounded-xl
                                border
                                border-white/10
                                bg-[#111A29]
                                text-white/60
                                items-center
                                justify-center
                                hover:text-white
                                hover:bg-white/10
                                transition
                            ">

                            <i class="fa-solid fa-question"></i>

                        </button>


                        {{-- NOTIFICACIONES --}}

                        <button
                            type="button"
                            class="
                                h-10
                                w-10
                                rounded-xl
                                border
                                border-white/10
                                bg-[#111A29]
                                text-white/60
                                flex
                                items-center
                                justify-center
                                hover:text-white
                                hover:bg-white/10
                                transition
                            ">

                            <i class="fa-regular fa-bell"></i>

                        </button>


                        {{-- USUARIO HEADER --}}
                        {{-- USUARIO / SUBMENÚ --}}
                        <div class="relative">

                            {{-- BOTÓN USUARIO --}}
                            <button
                                id="btnUsuario"
                                type="button"
                                class="
            flex
            items-center
            gap-2
            sm:gap-3
            rounded-xl
            border
            border-white/10
            bg-[#111A29]
            px-2
            sm:px-3
            py-2
            hover:bg-white/10
            transition
        ">

                                <div
                                    class="
                h-8
                w-8
                shrink-0
                rounded-full
                bg-horeca-dorado
                text-black
                flex
                items-center
                justify-center
                text-xs
                font-black
            ">
                                    {{ strtoupper(substr($usuario->name, 0, 2)) }}
                                </div>


                                <div class="hidden lg:block text-left">

                                    <p class="text-xs font-bold">
                                        {{ $usuario->name }}
                                    </p>

                                    <p class="text-[10px] text-white/40">
                                        {{ ucfirst($usuario->rol) }}
                                    </p>

                                </div>


                                <i
                                    id="flechaUsuario"
                                    class="
                hidden
                sm:block
                fa-solid
                fa-chevron-down
                text-[10px]
                text-white/40
                transition-transform
                duration-200
            ">
                                </i>

                            </button>


                            {{-- SUBMENÚ --}}
                            <div
                                id="menuUsuario"
                                class="
            absolute
            right-0
            top-full
            mt-2
            w-56
            rounded-2xl
            border
            border-white/10
            bg-[#111A29]
            shadow-2xl
            shadow-black/40
            overflow-hidden
            opacity-0
            invisible
            translate-y-2
            transition-all
            duration-200
            z-[100]
        ">

                                {{-- INFORMACIÓN --}}
                                <div class="px-4 py-3 border-b border-white/10">

                                    <p class="text-sm font-bold truncate">
                                        {{ $usuario->name }}
                                    </p>

                                    <p class="text-[11px] text-white/40 truncate">
                                        {{ $usuario->email }}
                                    </p>

                                </div>


                                {{-- MI PERFIL --}}
                                <a
                                    href="{{ $usuario->rol === 'profesional'
                ? route('perfil.profesional')
                : '#' }}"
                                    class="
                flex
                items-center
                gap-3
                px-4
                py-3
                text-sm
                text-white/80
                hover:bg-white/5
                hover:text-white
                transition
            ">

                                    <i class="fa-regular fa-user w-4 text-center text-horeca-titulos"></i>

                                    <span>
                                        Mi perfil
                                    </span>

                                </a>



                                {{-- CERRAR SESIÓN --}}
                                <div class="border-t border-white/10">

                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="
                        w-full
                        flex
                        items-center
                        gap-3
                        px-4
                        py-3
                        text-sm
                        text-red-400
                        hover:bg-red-500/10
                        transition
                    ">

                                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>

                                            <span>
                                                Cerrar sesión
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </header>



            {{-- ===================================================== --}}
            {{-- CONTENIDO --}}
            {{-- ===================================================== --}}

            <main
                class="
                    p-4
                    sm:p-6
                    lg:p-8
                ">


                {{-- MENSAJE SUCCESS --}}

                @if(session('success'))

                <div
                    class="
                            msj
                            mb-6
                            rounded-xl
                            border
                            border-emerald-400/20
                            bg-emerald-400/10
                            px-5
                            py-4
                            text-sm
                            text-emerald-300
                        ">

                    <div class="flex items-center gap-3">

                        <i class="fa-solid fa-circle-check"></i>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

                @endif


                @yield('content')

            </main>

        </div>

    </div>



    {{-- ============================================================= --}}
    {{-- JAVASCRIPT SIDEBAR --}}
    {{-- ============================================================= --}}

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function abrirSidebar() {

            sidebar.classList.remove('-translate-x-full');

            sidebar.classList.add('translate-x-0');

            sidebarOverlay.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }


        function cerrarSidebar() {

            sidebar.classList.remove('translate-x-0');

            sidebar.classList.add('-translate-x-full');

            sidebarOverlay.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        // Cerrar con ESC

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                cerrarSidebar();

            }

        });


        // Cerrar sidebar al hacer clic en un enlace del menú en móvil

        document.querySelectorAll('#sidebar a').forEach(function(enlace) {

            enlace.addEventListener('click', function() {

                if (window.innerWidth < 1024) {

                    cerrarSidebar();

                }

            });

        });


        // Si cambia de móvil a desktop, limpiar estados

        window.addEventListener('resize', function() {

            if (window.innerWidth >= 1024) {

                sidebar.classList.remove('-translate-x-full');

                sidebar.classList.add('translate-x-0');

                sidebarOverlay.classList.add('hidden');

                document.body.classList.remove('overflow-hidden');

            } else {

                sidebar.classList.remove('translate-x-0');

                sidebar.classList.add('-translate-x-full');

            }

        });


        // =========================================================
        // MENSAJE SUCCESS
        // =========================================================

        const msj = document.querySelector('.msj');

        if (msj) {

            setTimeout(() => {

                msj.style.transition = 'opacity 0.4s ease';

                msj.style.opacity = '0';

                setTimeout(() => {

                    msj.remove();

                }, 400);

            }, 3000);

        }
    </script>
    <script>
        const btnUsuario = document.getElementById('btnUsuario');
        const menuUsuario = document.getElementById('menuUsuario');
        const flechaUsuario = document.getElementById('flechaUsuario');

        btnUsuario?.addEventListener('click', function(event) {

            event.stopPropagation();

            const abierto = !menuUsuario.classList.contains('invisible');

            if (abierto) {

                cerrarMenuUsuario();

            } else {

                abrirMenuUsuario();

            }

        });


        function abrirMenuUsuario() {

            menuUsuario.classList.remove(
                'opacity-0',
                'invisible',
                'translate-y-2'
            );

            menuUsuario.classList.add(
                'opacity-100',
                'visible',
                'translate-y-0'
            );

            flechaUsuario?.classList.add('rotate-180');

        }


        function cerrarMenuUsuario() {

            menuUsuario.classList.add(
                'opacity-0',
                'invisible',
                'translate-y-2'
            );

            menuUsuario.classList.remove(
                'opacity-100',
                'visible',
                'translate-y-0'
            );

            flechaUsuario?.classList.remove('rotate-180');

        }


        // Cerrar haciendo clic fuera
        document.addEventListener('click', function(event) {

            if (
                menuUsuario &&
                !menuUsuario.contains(event.target) &&
                !btnUsuario.contains(event.target)
            ) {

                cerrarMenuUsuario();

            }

        });
    </script>

</body>

</html>