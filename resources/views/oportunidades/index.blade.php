@extends('layouts.dashboard')

@section('title', 'Oportunidades')

@section('header-title', 'Oportunidades')



@section('content')

<div>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-xs font-bold tracking-[0.25em] text-horeca-dorado">
                HORECA PRO
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Mis oportunidades
            </h2>

            <p class="mt-1 text-sm text-white/70">
                Gestiona las oportunidades publicadas por tu empresa.
            </p>

        </div>


        <a
            href="{{ route('oportunidades.create') }}"
            class="rounded-xl bg-horeca-dorado px-5 py-3 text-center text-sm font-black text-black"
        >
            + Publicar oportunidad
        </a>

    </div>





    @if($oportunidades->count())

        <div class="mt-8 space-y-4">

            @foreach($oportunidades as $oportunidad)

                <div class="rounded-2xl border border-white/10 bg-[#111A29] p-6">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div>

                            <div class="flex flex-wrap items-center gap-3">

                                <h3 class="text-lg font-bold">
                                    {{ $oportunidad->titulo }}
                                </h3>


                                @if($oportunidad->estado === 'publicada')

                                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-400">
                                        Publicada
                                    </span>

                                @elseif($oportunidad->estado === 'pendiente')

                                    <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-400">
                                        Pendiente
                                    </span>

                                @elseif($oportunidad->estado === 'cerrada')

                                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-white/70">
                                        Cerrada
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-400">
                                        {{ ucfirst($oportunidad->estado) }}
                                    </span>

                                @endif

                            </div>


                            <p class="mt-2 text-sm text-white/40">

                                {{ $oportunidad->area ?? 'Área no especificada' }}

                                @if($oportunidad->ubicacion)
                                    · {{ $oportunidad->ubicacion }}
                                @endif

                            </p>


                            <p class="mt-3 text-xs text-white/40">

                                {{ $oportunidad->postulaciones_count }}
                                postulaciones

                            </p>

                        </div>


                        <div class="flex flex-wrap gap-2">

                            <a
                                href="{{ route('oportunidades.show', $oportunidad) }}"
                                class="rounded-lg border border-white/10 px-4 py-2 text-xs font-bold hover:bg-white/5"
                            >
                                Ver
                            </a>

                            <a
                                href="{{ route('oportunidades.edit', $oportunidad) }}"
                                class="rounded-lg border border-horeca-dorado/30 px-4 py-2 text-xs font-bold text-horeca-dorado"
                            >
                                Editar
                            </a>

                            <form
                                action="{{ route('oportunidades.destroy', $oportunidad) }}"
                                method="POST"
                                onsubmit="return confirm('¿Deseas eliminar esta oportunidad?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-500/10"
                                >
                                    Eliminar
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        <div class="mt-6">

            {{ $oportunidades->links() }}

        </div>

    @else

        <div class="mt-8 rounded-2xl border border-dashed border-white/10 bg-[#111A29] p-12 text-center">

            <div class="text-4xl">
                💼
            </div>

            <h3 class="mt-4 text-lg font-bold">
                Aún no tienes oportunidades
            </h3>

            <p class="mt-2 text-sm text-white/40">
                Publica tu primera oportunidad y comienza a encontrar talento HORECA.
            </p>

            <a
                href="{{ route('oportunidades.create') }}"
                class="mt-6 inline-block rounded-xl bg-horeca-dorado px-6 py-3 text-sm font-black text-black"
            >
                Publicar oportunidad
            </a>

        </div>

    @endif

</div>

@endsection