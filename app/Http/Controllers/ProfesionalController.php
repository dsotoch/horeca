<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalController extends Controller
{
    /**
     * Buscar profesionales
     */
    public function index(Request $request)

    {
        $usuario=Auth::user();
        $buscar = trim($request->input('buscar', ''));

        $especialidad = $request->input('especialidad');

        $ciudad = $request->input('ciudad');

        $modalidad = $request->input('modalidad');


        /*
        |--------------------------------------------------------------------------
        | PROFESIONALES
        |--------------------------------------------------------------------------
        */

        $profesionales = Profesional::query()

            ->with('user')

            /*
            |--------------------------------------------------------------------------
            | SOLO PROFESIONALES VALIDADOS
            |--------------------------------------------------------------------------
            */

            ->where('estado_validacion', 'aprobado')


            /*
            |--------------------------------------------------------------------------
            | BUSCADOR
            |--------------------------------------------------------------------------
            */

            ->when($buscar !== '', function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {

                    $q->where('nombres', 'like', "%{$buscar}%")

                        ->orWhere('apellidos', 'like', "%{$buscar}%")

                        ->orWhere('especialidad', 'like', "%{$buscar}%")

                        ->orWhere('subespecialidad', 'like', "%{$buscar}%")

                        ->orWhere('descripcion', 'like', "%{$buscar}%")

                        ->orWhere('habilidades', 'like', "%{$buscar}%");

                });

            })


            /*
            |--------------------------------------------------------------------------
            | ESPECIALIDAD
            |--------------------------------------------------------------------------
            */

            ->when($especialidad, function ($query) use ($especialidad) {

                $query->where('especialidad', $especialidad);

            })


            /*
            |--------------------------------------------------------------------------
            | CIUDAD
            |--------------------------------------------------------------------------
            */

            ->when($ciudad, function ($query) use ($ciudad) {

                $query->where('ciudad', $ciudad);

            })


            /*
            |--------------------------------------------------------------------------
            | MODALIDAD
            |--------------------------------------------------------------------------
            */

            ->when($modalidad, function ($query) use ($modalidad) {

                $query->where('modalidad', $modalidad);

            })


            ->orderBy('nombres')

            ->orderBy('apellidos')

            ->paginate(12)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | ESPECIALIDADES
        |--------------------------------------------------------------------------
        */

        $especialidades = Profesional::query()

            ->where('estado_validacion', 'aprobado')

            ->whereNotNull('especialidad')

            ->where('especialidad', '<>', '')

            ->distinct()

            ->orderBy('especialidad')

            ->pluck('especialidad');


        /*
        |--------------------------------------------------------------------------
        | CIUDADES
        |--------------------------------------------------------------------------
        */

        $ciudades = Profesional::query()

            ->where('estado_validacion', 'aprobado')

            ->whereNotNull('ciudad')

            ->where('ciudad', '<>', '')

            ->distinct()

            ->orderBy('ciudad')

            ->pluck('ciudad');


        /*
        |--------------------------------------------------------------------------
        | MODALIDADES
        |--------------------------------------------------------------------------
        */

        $modalidades = Profesional::query()

            ->where('estado_validacion', 'aprobado')

            ->whereNotNull('modalidad')

            ->where('modalidad', '<>', '')

            ->distinct()

            ->orderBy('modalidad')

            ->pluck('modalidad');


        return view(
            'profesionales.index',
            compact(
                'profesionales',
                'especialidades',
                'ciudades',
                'modalidades',
                'buscar',
                'especialidad',
                'ciudad',
                'modalidad',
                'usuario'
            )
        );
    }


    /**
     * Perfil del profesional
     */
    public function show(Profesional $profesional)
    {
        $profesional->load('user');
        $usuario=Auth::user();

        abort_unless(
            $profesional->estado_validacion === 'aprobado',
            404
        );

        return view(
            'profesionales.show',
            compact('profesional','usuario')
        );
    }
}