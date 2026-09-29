<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{

    
    public function index()
    {
        $usuario = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | PERFIL PROFESIONAL
        |--------------------------------------------------------------------------
        */

        $profesional = $usuario->profesional;

        /*
        |--------------------------------------------------------------------------
        | PORCENTAJE DE PERFIL
        |--------------------------------------------------------------------------
        */

        $camposPerfil = [
            'nombres',
            'apellidos',
            'tipo_documento',
            'numero_documento',
            'celular',
            'especialidad',
            'subespecialidad',
            'experiencia',
            'modalidad',
            'ciudad',
            'distrito',
            'descripcion',
            'habilidades',
            'video_presentacion',
            'cv'
        ];

        $completados = 0;
        $totalCampos = count($camposPerfil);

        if ($profesional) {

            foreach ($camposPerfil as $campo) {

                if (
                    isset($profesional->{$campo}) &&
                    trim((string) $profesional->{$campo}) !== ''
                ) {
                    $completados++;
                }
            }
        }

        $porcentajePerfil = $totalCampos > 0
            ? round(($completados / $totalCampos) * 100)
            : 0;


        /*
        |--------------------------------------------------------------------------
        | MEMBRESÍA ACTUAL
        |--------------------------------------------------------------------------
        */
        $membresia = null;
        /* $membresia = DB::table('membresias_usuarios')
            ->join(
                'membresias',
                'membresias.id',
                '=',
                'membresias_usuarios.membresia_id'
            )
            ->where('membresias_usuarios.user_id', $usuario->id)
            ->where('membresias_usuarios.estado', 'activo')
            ->orderByDesc('membresias_usuarios.fecha_inicio')
            ->select(
                'membresias.id',
                'membresias.nombre',
                'membresias.descripcion',
                'membresias.precio',
                'membresias.duracion',
                'membresias_usuarios.fecha_inicio',
                'membresias_usuarios.fecha_fin',
                'membresias_usuarios.estado'
            )
            ->first();
*/

        /*
        |--------------------------------------------------------------------------
        | DATOS DEL PERFIL
        |--------------------------------------------------------------------------
        */

        $nombre = $usuario->name;

        $iniciales = collect(
            preg_split('/\s+/', trim($nombre))
        )
            ->filter()
            ->take(2)
            ->map(fn($nombre) => strtoupper(substr($nombre, 0, 1)))
            ->implode('');


        /*
        |--------------------------------------------------------------------------
        | ESTADO DEL PROFESIONAL
        |--------------------------------------------------------------------------
        */

        $estadoValidacion = $profesional?->estado_validacion ?? 'pendiente';


        /*
        |--------------------------------------------------------------------------
        | DATOS DEL DASHBOARD
        |--------------------------------------------------------------------------
        */

        $estadisticas = [

            'perfil' => $porcentajePerfil,

            /*
             * Estos se conectarán posteriormente
             * con Oportunidad / Postulacion.
             */
            'oportunidades' => 0,

            'postulaciones' => 0,

            'certificaciones' => 0,

            'certificaciones_pendientes' => 0,
        ];


        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        return view('dashboard.profesional', compact(
            'usuario',
            'profesional',
            'membresia',
            'porcentajePerfil',
            'iniciales',
            'estadoValidacion',
            'estadisticas'
        ));
    }
    public function perfil()
    {
        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        return view('dashboard.perfil-profesional', compact(
            'usuario',
            'profesional'
        ));
    }


    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $profesional = $usuario->profesional;

        if (!$profesional) {
            abort(404, 'No se encontró el perfil profesional.');
        }

        $validated = $request->validate([
            /*
    |--------------------------------------------------------------------------
    | INFORMACIÓN PERSONAL
    |--------------------------------------------------------------------------
    */

            'nombres' => [
                'required',
                'string',
                'max:100',
            ],

            'apellidos' => [
                'required',
                'string',
                'max:100',
            ],

            'tipo_documento' => [
                'required',
                'string',
                'in:DNI,CE,PASAPORTE',
            ],

            'numero_documento' => [
                'required',
                'string',
                'max:30',
                Rule::unique('profesionales', 'numero_documento')
                    ->ignore($profesional->id),
            ],

            'celular' => [
                'required',
                'string',
                'max:30',
                Rule::unique('profesionales', 'celular')
                    ->ignore($profesional->id),
            ],

            /*
    |--------------------------------------------------------------------------
    | INFORMACIÓN PROFESIONAL
    |--------------------------------------------------------------------------
    */

            'especialidad' => [
                'required',
                'string',
                'max:150',
            ],

            'subespecialidad' => [
                'nullable',
                'string',
                'max:150',
            ],

            'experiencia' => [
                'required',
                'in:0-1,1-3,3-5,5-10,10+',
            ],

            'modalidad' => [
                'required',
                'in:presencial,remoto,hibrido',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'habilidades' => [
                'nullable',
                'string',
                'max:1000',
            ],

            /*
    |--------------------------------------------------------------------------
    | UBICACIÓN
    |--------------------------------------------------------------------------
    */

            'ciudad' => [
                'nullable',
                'string',
                'max:100',
            ],

            'distrito' => [
                'nullable',
                'string',
                'max:100',
            ],

            /*
    |--------------------------------------------------------------------------
    | VIDEO
    |--------------------------------------------------------------------------
    */

            'video_presentacion' => [
                'nullable',
                'file',
                'mimes:mp4,mov,avi,webm',
                'max:51200',
            ],

            /*
    |--------------------------------------------------------------------------
    | CV
    |--------------------------------------------------------------------------
    */

            'cv' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ]);

        /*
    |--------------------------------------------------------------------------
    | VIDEO
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('video_presentacion')) {

            $video = $request->file('video_presentacion');

            $nombreVideo = time() . '_' . uniqid() . '.' .
                $video->getClientOriginalExtension();

            $video->storeAs(
                'profesionales/videos',
                $nombreVideo,
                'public'
            );

            $validated['video_presentacion'] =
                'profesionales/videos/' . $nombreVideo;
        }
        if ($request->hasFile('cv')) {

            if (!empty($profesional->cv)) {
                Storage::disk('public')->delete($profesional->cv);
            }

            $cv = $request->file('cv');

            $nombreCv = time()
                . '_'
                . uniqid()
                . '.'
                . $cv->getClientOriginalExtension();

            $rutaCv = $cv->storeAs(
                'profesionales/cv',
                $nombreCv,
                'public'
            );

            $validated['cv'] = $rutaCv;
        }
        /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR PERFIL
    |--------------------------------------------------------------------------
    */

        $profesional->update($validated);

        return redirect()
            ->route('perfil.profesional')
            ->with('success', 'Tu perfil profesional se actualizó correctamente.');
    }
}
