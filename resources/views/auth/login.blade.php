<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión | M&M CLUB HORECA PRO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-horeca-fondo flex items-center justify-center p-6">

    <div class="w-full max-w-md">

        {{-- LOGO / MARCA --}}
        <div class="text-center mb-8">

            <div class="inline-flex items-center justify-center w-24 h-24
            rounded-2xl border border-horeca-dorado/50
            bg-horeca-dorado/10 mb-5">

                <img
                    src="{{ asset('images/hor.png') }}"
                    alt="M&M"
                    class="h-auto w-auto object-contain">

            </div>



            <p class="text-horeca-titulos font-semibold tracking-[0.2em] text-xl mt-1">
                CLUB HORECA PRO
            </p>

            <p class="text-[#D9D9D9] text-base mt-4">
                Conectando talento, empresas y oportunidades.
                INGRESAS A UN LUGAR DONDE SOLO ENCUENTRAS PROFESIONALES
            </p>

        </div>


        {{-- CARD LOGIN --}}
        <div class="bg-white/5 rounded-2xl shadow-2xl p-8">

            <div class="mb-7">

                <h2 class="text-2xl font-bold text-horeca-dorado">
                    Bienvenido
                </h2>

                <p class="text-white text-base mt-1">
                    Ingresa a tu cuenta para continuar
                </p>

            </div>
            @if (session('success'))
            <div class="msj mb-4 rounded-lg bg-green-500/10 border border-green-500/30 p-4 text-green-400">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="msj mb-4 rounded-lg bg-red-500/10 border border-red-500/30 p-4 text-red-400">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">

                @csrf


                {{-- EMAIL --}}
                <div>

                    <label
                        for="email"
                        class="block text-base font-semibold text-horeca-dorado mb-2">
                        Correo electrónico
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="correo@ejemplo.com"
                        class="w-full px-4 py-3 rounded-xl border border-white/20 text-white/80
                               focus:border-[#C9A44D]
                               focus:ring-2 focus:ring-[#C9A44D]/20
                               outline-none transition">

                   

                </div>


                {{-- PASSWORD --}}
                <div>

                    <div class="flex justify-between items-center mb-2">

                        <label
                            for="password"
                            class="text-base font-semibold text-horeca-dorado">
                            Contraseña
                        </label>

                        @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-xs text-[#C9A44D] hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                        @endif

                    </div>

                    <input
                        id="password"

                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="text-white/80 w-full px-4 py-3 rounded-xl border border-white/20
                               focus:border-[#C9A44D]
                               focus:ring-2 focus:ring-[#C9A44D]/20
                               outline-none transition">

                    @error('password')
                    <p class="text-red-600 text-base mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- RECORDAR --}}
                <div class="flex items-center">

                    <input
                        id="remember"
                        type="checkbox"
                        name="recordar"
                        class="w-4 h-4 rounded border-gray-300
                               text-[#C9A44D]
                               focus:ring-[#C9A44D]">

                    <label
                        for="recordar"
                        class="ml-2 text-base text-white">
                        Mantener sesión iniciada
                    </label>

                </div>


                {{-- BOTÓN --}}
                <button
                    type="submit"
                    class="w-full py-3.5 rounded-xl
           bg-gradient-to-r
           from-horeca-dorado
           to-horeca-dorado2
           text-base
           font-semibold
           transition-all duration-300
           shadow-lg shadow-horeca-dorado/25
           hover:shadow-horeca-dorado/40
           hover:brightness-105">
                    Iniciar sesión
                </button>
            </form>


            {{-- REGISTRO --}}
            <div class="relative my-7">

                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>

                <div class="relative flex justify-center">
                    <span class="bg-horeca-fondo px-4 text-sm text-white">
                        Forma parte del club
                    </span>
                </div>

            </div>


            <a
                href="{{ route('register') }}"
                class="block w-full py-3 text-center rounded-xl
                       border-2 border-[#0C1C3C]
                       text-horeca-dorado
                       font-semibold
                       hover:bg-[#0C1C3C]
                       hover:text-white
                       transition">
                Crear una cuenta
            </a>

        </div>


        <p class="text-center text-xs text-[#D9D9D9]/60 mt-6">
            © {{ date('Y') }} CLUB HORECA PRO
        </p>

    </div>
<script>
    const msj=document.querySelector(".msj");
    if(msj){
        setTimeout(() => {
            msj.classList.add("hidden");
        }, 3000);
    }
</script>
</body>

</html>