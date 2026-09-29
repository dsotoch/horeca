@extends('layouts.dashboard')

@section('title', 'Perfil profesional')

@section('header-title', 'Perfil profesional')


@section('content')

<div class="mx-auto max-w-5xl space-y-6">


    {{-- =========================================================
         VOLVER
    ========================================================== --}}

    <div>

        <a
            href="{{ route('profesionales.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-white/80 transition hover:text-horeca-dorado">
            ← Volver a profesionales
        </a>

    </div>



    {{-- =========================================================
         CABECERA
    ========================================================== --}}

    <section class="overflow-hidden rounded-3xl border border-white/10 bg-[#111A29]">


        <div class="h-32 bg-gradient-to-r from-[#26364D] to-[#172334]"></div>


        <div class="px-6 pb-7 sm:px-8">


            <div class="-mt-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">


                {{-- PERFIL --}}

                <div class="flex flex-col gap-4 sm:flex-row sm:items-end">


                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl border-4 border-[#111A29] bg-horeca-dorado text-2xl font-black uppercase text-black">

                        {{ strtoupper(substr($profesional->nombres ?: 'P', 0, 1)) }}

                    </div>


                    <div>

                        <h1 class="text-2xl font-black">

                            {{ $profesional->nombres }}
                            {{ $profesional->apellidos }}

                        </h1>


                        @if($profesional->especialidad)

                        <p class="mt-1 font-bold text-horeca-dorado">

                            {{ $profesional->especialidad }}

                        </p>

                        @endif


                        @if($profesional->subespecialidad)

                        <p class="mt-1 text-sm text-white/80">

                            {{ $profesional->subespecialidad }}

                        </p>

                        @endif

                    </div>

                </div>



                {{-- VALIDACIÓN --}}

                @if($profesional->estado_validacion === 'validado')

                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-bold text-emerald-400">

                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                    Profesional validado

                </span>

                @endif

            </div>

        </div>

    </section>



    {{-- =========================================================
         INFORMACIÓN
    ========================================================== --}}

    <div class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">


        {{-- =====================================================
             PERFIL PROFESIONAL
        ====================================================== --}}

        <section class="rounded-2xl border border-white/10 bg-[#111A29] p-6">


            <h2 class="text-lg font-black">
                Perfil profesional
            </h2>


            @if($profesional->descripcion)

            <div class="mt-5">

                <p class="text-sm leading-7 text-white/60">

                    {{ $profesional->descripcion }}

                </p>

            </div>

            @endif



            {{-- HABILIDADES --}}

            @if($profesional->habilidades)

            <div class="mt-7 border-t border-white/10 pt-6">

                <h3 class="text-sm font-bold">
                    Habilidades
                </h3>

                <p class="mt-3 text-sm leading-7 text-white/70">

                    {{ $profesional->habilidades }}

                </p>

            </div>

            @endif



            {{-- EXPERIENCIA --}}

            @if($profesional->experiencia !== null && $profesional->experiencia !== '')

            <div class="mt-7 border-t border-white/10 pt-6">

                <h3 class="text-sm font-bold">
                    Experiencia
                </h3>

                <div class="mt-3 inline-flex rounded-xl bg-white/5 px-4 py-3">

                    <span class="text-sm font-bold text-horeca-dorado">

                        ⭐ {{ $profesional->experiencia }}

                        @if((int) $profesional->experiencia === 1)
                        año
                        @else
                        años
                        @endif

                    </span>

                </div>

            </div>

            @endif

        </section>



        {{-- =====================================================
             INFORMACIÓN
        ====================================================== --}}

        <section class="rounded-2xl border border-white/10 bg-[#111A29] p-6">


            <h2 class="text-lg font-black">
                Información
            </h2>


            <div class="mt-5 space-y-5">


                {{-- ESPECIALIDAD --}}

                @if($profesional->especialidad)

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/30">
                        Especialidad
                    </p>

                    <p class="mt-1 text-sm font-bold">
                        {{ $profesional->especialidad }}
                    </p>

                </div>

                @endif



                {{-- SUBESPECIALIDAD --}}

                @if($profesional->subespecialidad)

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/30">
                        Subespecialidad
                    </p>

                    <p class="mt-1 text-sm font-bold">
                        {{ $profesional->subespecialidad }}
                    </p>

                </div>

                @endif



                {{-- MODALIDAD --}}

                @if($profesional->modalidad)

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/30">
                        Modalidad
                    </p>

                    <p class="mt-1 text-sm font-bold capitalize">
                        {{ $profesional->modalidad }}
                    </p>

                </div>

                @endif



                {{-- UBICACIÓN --}}

                @if($profesional->ciudad || $profesional->distrito)

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/30">
                        Ubicación
                    </p>

                    <p class="mt-1 text-sm font-bold">

                        @if($profesional->ciudad)
                        {{ $profesional->ciudad }}
                        @endif

                        @if($profesional->ciudad && $profesional->distrito)
                        ,
                        @endif

                        @if($profesional->distrito)
                        {{ $profesional->distrito }}
                        @endif

                    </p>

                </div>

                @endif



                {{-- VIDEO --}}

                @if($profesional->video_presentacion)

                <div class="border-t border-white/10 pt-5">

                    <a
                        href="/storage/{{ $profesional->video_presentacion }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center rounded-xl border border-horeca-dorado/30 px-4 py-3 text-sm font-bold text-horeca-dorado transition hover:bg-horeca-dorado/10">
                        ▶ Ver presentación
                    </a>

                </div>

                @endif



                {{-- CV --}}

                @if($profesional->cv)

                <div>

                    <a
                        href="{{ asset('storage/' . $profesional->cv) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center rounded-xl bg-horeca-dorado px-4 py-3 text-sm font-black text-black transition hover:opacity-90">
                        📄 Ver CV
                    </a>

                </div>

                @endif

            </div>

        </section>

    </div>



    {{-- =========================================================
         ACCIONES
    ========================================================== --}}

    <section class="rounded-2xl border border-horeca-dorado/20 bg-[#111A29] p-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="font-black">
                    ¿Te interesa este profesional?
                </h2>

                <p class="mt-1 text-sm text-white/80">
                    Puedes contactarlo o invitarlo a una de tus oportunidades.
                </p>

            </div>


            <div class="flex flex-wrap gap-3">




                <a
                    href="https://wa.me/{{ preg_replace('/\D+/', '', $profesional->celular) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-xl bg-[#25D366] px-5 py-3 text-sm font-black text-white transition hover:opacity-90">
                    💬 Contactar
                </a>

            </div>

        </div>

    </section>

</div>

@endsection