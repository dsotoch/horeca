<?php

namespace App\Http\Controllers;

use App\Models\Oportunidad;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalOportunidadController extends Controller
{
    /**
     * Oportunidades disponibles para profesionales
     */
    public function index(Request $request)
    {
        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        abort_unless(
            $profesional,
            403,
            'El usuario no tiene un perfil profesional registrado.'
        );

        $buscar = trim($request->input('buscar', ''));

        $area = $request->input('area');

        $modalidad = $request->input('modalidad');

        $tipoContrato = $request->input('tipo_contrato');

        $ubicacion = $request->input('ubicacion');


        $oportunidades = Oportunidad::query()

            ->with('empresa')

            ->where('estado', 'publicada')

            ->when($buscar !== '', function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {

                    $q->where('titulo', 'like', "%{$buscar}%")
                        ->orWhere('area', 'like', "%{$buscar}%")
                        ->orWhere('descripcion', 'like', "%{$buscar}%")
                        ->orWhere('requisitos', 'like', "%{$buscar}%")
                        ->orWhere('funciones', 'like', "%{$buscar}%");
                });
            })

            ->when($area, function ($query) use ($area) {

                $query->where('area', $area);
            })

            ->when($modalidad, function ($query) use ($modalidad) {

                $query->where('modalidad', $modalidad);
            })

            ->when($tipoContrato, function ($query) use ($tipoContrato) {

                $query->where('tipo_contrato', $tipoContrato);
            })

            ->when($ubicacion, function ($query) use ($ubicacion) {

                $query->where('ubicacion', 'like', "%{$ubicacion}%");
            })

            /*
             * No mostrar oportunidades vencidas
             */
            ->where(function ($query) {

                $query->whereNull('fecha_cierre')
                    ->orWhereDate(
                        'fecha_cierre',
                        '>=',
                        now()->toDateString()
                    );
            })

            ->latest()

            ->paginate(12)

            ->withQueryString();


        /*
         * Filtros disponibles
         */

        $areas = Oportunidad::query()

            ->where('estado', 'publicada')

            ->whereNotNull('area')

            ->where('area', '<>', '')

            ->distinct()

            ->orderBy('area')

            ->pluck('area');


        $modalidades = Oportunidad::query()

            ->where('estado', 'publicada')

            ->whereNotNull('modalidad')

            ->where('modalidad', '<>', '')

            ->distinct()

            ->orderBy('modalidad')

            ->pluck('modalidad');


        $tiposContrato = Oportunidad::query()

            ->where('estado', 'publicada')

            ->whereNotNull('tipo_contrato')

            ->where('tipo_contrato', '<>', '')

            ->distinct()

            ->orderBy('tipo_contrato')

            ->pluck('tipo_contrato');


        return view(
            'profesional.oportunidades.index',
            compact(
                'oportunidades',
                'areas',
                'modalidades',
                'tiposContrato',
                'buscar',
                'area',
                'modalidad',
                'tipoContrato',
                'ubicacion',
                'usuario'
            )
        );
    }


    /**
     * Detalle de oportunidad
     */
    public function show(Oportunidad $oportunidad)
    {
        $usuario = Auth::user();
        abort_unless(
            $oportunidad->estado === 'publicada',
            404
        );


        /*
         * Si tiene fecha de cierre y ya venció
         */
        if (
            $oportunidad->fecha_cierre &&
            $oportunidad->fecha_cierre->lt(
                now()->startOfDay()
            )
        ) {
            abort(404);
        }


        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        abort_unless(
            $profesional,
            403,
            'El usuario no tiene un perfil profesional registrado.'
        );


        $oportunidad->load('empresa');


        /*
         * Verificar si ya está postulando
         */

        $yaPostulado = $oportunidad
            ->postulaciones()
            ->where(
                'profesional_id',
                $profesional->id
            )
            ->exists();


        return view(
            'profesional.oportunidades.show',
            compact(
                'oportunidad',
                'profesional',
                'yaPostulado',
                'usuario'
            )
        );
    }
    public function postular(
        Request $request,
        Oportunidad $oportunidad
    ) {
        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        abort_unless(
            $profesional,
            403,
            'El usuario no tiene un perfil profesional registrado.'
        );


        /*
     * La oportunidad debe estar publicada
     */
        abort_unless(
            $oportunidad->estado === 'publicada',
            404
        );


        /*
     * Verificar fecha de cierre
     */
        if (
            $oportunidad->fecha_cierre &&
            $oportunidad->fecha_cierre->lt(
                now()->startOfDay()
            )
        ) {
            return back()->with(
                'error',
                'Esta oportunidad ya cerró.'
            );
        }


        /*
     * Validar mensaje
     */
        $datos = $request->validate([
            'mensaje' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);


        /*
     * Verificar si ya existe
     */
        $yaPostulado = $oportunidad
            ->postulaciones()
            ->where(
                'profesional_id',
                $profesional->id
            )
            ->exists();


        if ($yaPostulado) {

            return back()->with(
                'error',
                'Ya te has postulado a esta oportunidad.'
            );
        }


        /*
     * Crear postulación
     */
        $oportunidad->postulaciones()->create([

            'profesional_id' => $profesional->id,

            'estado' => 'pendiente',

            'mensaje' => $datos['mensaje'] ?? null,

            'fecha_postulacion' => now(),

        ]);


        return redirect()
            ->route(
                'profesional.oportunidades.show',
                $oportunidad
            )
            ->with(
                'success',
                'Tu postulación fue enviada correctamente.'
            );
    }
    public function postulaciones()
    {
        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        abort_unless(
            $profesional,
            403,
            'El usuario no tiene un perfil profesional registrado.'
        );

        $postulaciones = $profesional
            ->postulaciones()
            ->with([
                'oportunidad.empresa'
            ])
            ->latest('fecha_postulacion')
            ->paginate(12);

        return view(
            'profesional.postulaciones.index',
            compact('postulaciones', 'usuario')
        );
    }
    
}
