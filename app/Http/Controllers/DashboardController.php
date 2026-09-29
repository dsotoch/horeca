<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Oportunidad;
use App\Models\Postulacion;
use App\Models\Profesional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{

    public function actualizarEmpresa(Request $request)
    {
        $usuario = auth()->user();

        $empresa = Empresa::where('user_id', $usuario->id)->firstOrFail();

        $validated = $request->validate([
            'razon_social' => [
                'required',
                'string',
                'max:255',
            ],

            'nombre_comercial' => [
                'nullable',
                'string',
                'max:255',
            ],

            'ruc' => [
                'required',
                'string',
                'max:20',
                Rule::unique('empresas', 'ruc')->ignore($empresa->id),
            ],

            'tipo_empresa' => [
                'required',
                'string',
                'max:100',
            ],

            'sitio_web' => [
                'nullable',
                'url',
                'max:255',
            ],

            'red_social' => [
                'nullable',
                'string',
                'max:255',
            ],

            'contacto_nombres' => [
                'required',
                'string',
                'max:100',
            ],

            'contacto_apellidos' => [
                'required',
                'string',
                'max:100',
            ],

            'cargo' => [
                'nullable',
                'string',
                'max:150',
            ],

            'celular' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'departamento' => [
                'nullable',
                'string',
                'max:100',
            ],

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

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'perfiles_busca' => [
                'nullable',
                'string',
            ],

            'tipo_contratacion' => [
                'nullable',
                'string',
                'max:100',
            ],

            'cantidad_profesionales' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'video_presentacion' => [
                'nullable',
                'file',
                'mimes:mp4,mov,avi,webm',
                'max:51200',
            ],
        ]);

        /*
    |--------------------------------------------------------------------------
    | Actualizar datos de la empresa
    |--------------------------------------------------------------------------
    */

        $empresa->razon_social = $validated['razon_social'];
        $empresa->nombre_comercial = $validated['nombre_comercial'] ?? null;
        $empresa->ruc = $validated['ruc'];
        $empresa->tipo_empresa = $validated['tipo_empresa'];
        $empresa->sitio_web = $validated['sitio_web'] ?? null;
        $empresa->red_social = $validated['red_social'] ?? null;

        $empresa->contacto_nombres = $validated['contacto_nombres'];
        $empresa->contacto_apellidos = $validated['contacto_apellidos'];
        $empresa->cargo = $validated['cargo'] ?? null;
        $empresa->celular = $validated['celular'];

        $empresa->departamento = $validated['departamento'] ?? null;
        $empresa->ciudad = $validated['ciudad'] ?? null;
        $empresa->distrito = $validated['distrito'] ?? null;
        $empresa->direccion = $validated['direccion'] ?? null;

        $empresa->perfiles_busca = $validated['perfiles_busca'] ?? null;
        $empresa->tipo_contratacion = $validated['tipo_contratacion'] ?? null;
        $empresa->cantidad_profesionales = $validated['cantidad_profesionales'] ?? null;

        $empresa->descripcion = $validated['descripcion'] ?? null;

        /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    */

        if (!empty($validated['email'])) {
            $empresa->email = $validated['email'];
        }

        /*
    |--------------------------------------------------------------------------
    | Video de presentación
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('video_presentacion')) {

            // Eliminar video anterior
            if (!empty($empresa->video_presentacion)) {
                Storage::disk('public')->delete(
                    $empresa->video_presentacion
                );
            }

            // Guardar nuevo video
            $empresa->video_presentacion = $request
                ->file('video_presentacion')
                ->store('empresas/videos', 'public');
        }

        $empresa->save();

        return redirect()
            ->back()
            ->with('success', 'El perfil de la empresa se actualizó correctamente.');
    }


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

        $actividadesRecientes = null;
        if ($usuario->rol == 'profesional') {
            $actividadesRecientes = Postulacion::with('oportunidad.empresa')
                ->where('profesional_id', $profesional->id)
                ->latest('fecha_postulacion')
                ->take(5)
                ->get()
                ->map(function ($postulacion) {

                    $empresa = $postulacion->oportunidad->empresa;

                    $nombreEmpresa = $empresa->nombre_comercial
                        ?? $empresa->razon_social
                        ?? 'Empresa';

                    return (object) [
                        'icono' => match ($postulacion->estado) {
                            'pendiente' => 'fa-solid fa-paper-plane',
                            'en_revision' => 'fa-solid fa-eye',
                            'entrevista' => 'fa-solid fa-calendar-check',
                            'seleccionado' => 'fa-solid fa-circle-check',
                            'descartado' => 'fa-solid fa-circle-xmark',
                            default => 'fa-solid fa-clock',
                        },

                        'titulo' => match ($postulacion->estado) {
                            'pendiente' => 'Postulación enviada',
                            'en_revision' => 'Postulación en revisión',
                            'entrevista' => 'Entrevista programada',
                            'seleccionado' => '¡Has sido seleccionado!',
                            'descartado' => 'Postulación finalizada',
                            default => 'Actividad de postulación',
                        },

                        'descripcion' => match ($postulacion->estado) {
                            'pendiente' =>
                            'Postulaste a "' . $postulacion->oportunidad->titulo .
                                '" en ' . $nombreEmpresa . '.',

                            'en_revision' =>
                            'Tu postulación a "' . $postulacion->oportunidad->titulo .
                                '" está siendo revisada.',

                            'entrevista' =>
                            'Tu postulación a "' . $postulacion->oportunidad->titulo .
                                '" pasó a etapa de entrevista.',

                            'seleccionado' =>
                            'Fuiste seleccionado para "' .
                                $postulacion->oportunidad->titulo . '".',

                            'descartado' =>
                            'La postulación a "' .
                                $postulacion->oportunidad->titulo .
                                '" ha finalizado.',

                            default =>
                            'Actualización de tu postulación a "' .
                                $postulacion->oportunidad->titulo . '".',
                        },

                        'fecha' => $postulacion->fecha_postulacion,
                    ];
                });
        }
        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */
        if ($usuario->rol == "profesional") {
            return view('dashboard.profesional', compact(
                'usuario',
                'profesional',
                'membresia',
                'porcentajePerfil',
                'iniciales',
                'estadoValidacion',
                'estadisticas',
                'actividadesRecientes'
            ));
        } else {
            if ($usuario->rol == "empresa") {

                $empresa = $usuario->empresa;

                if (!$empresa) {
                    abort(403, 'El usuario no tiene una empresa registrada.');
                }

                // Todas las oportunidades de la empresa
                $oportunidades = $empresa->oportunidades()
                    ->withCount('postulaciones')
                    ->latest()
                    ->get();

                // Oportunidades activas
                $oportunidadesActivas = $empresa->oportunidades()
                    ->where('estado', 'publicada')
                    ->count();

                // Total de postulaciones
                $totalPostulaciones = $empresa->oportunidades()
                    ->withCount('postulaciones')
                    ->get()
                    ->sum('postulaciones_count');

                // Contrataciones
                $totalContrataciones = $empresa->oportunidades()
                    ->withCount([
                        'postulaciones as contrataciones_count' => function ($query) {
                            $query->where('estado', 'seleccionado');
                        }
                    ])
                    ->get()
                    ->sum('contrataciones_count');

                return view('dashboard.empresa', compact(
                    'usuario',
                    'empresa',
                    'oportunidades',
                    'oportunidadesActivas',
                    'totalPostulaciones',
                    'totalContrataciones'
                ));
            } else {
               return redirect()->route('admin.dashboard');
            }
        }
    }

    public function admin()
    {
        /*
        |--------------------------------------------------------------------------
        | Totales
        |--------------------------------------------------------------------------
        */

        $totalUsuarios = User::count();

        $totalEmpresas = Empresa::count();

        $empresasValidadas = Empresa::where(
            'estado_validacion',
            'validado'
        )->count();

        $empresasPendientes = Empresa::where(
            'estado_validacion',
            'pendiente'
        )->count();

        $totalProfesionales = Profesional::count();

        $totalOportunidades = Oportunidad::count();

        $oportunidadesPublicadas = Oportunidad::where(
            'estado',
            'publicada'
        )->count();

        $totalPostulaciones = Postulacion::count();

        $postulacionesPendientes = Postulacion::where(
            'estado',
            'pendiente'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Actividades recientes
        |--------------------------------------------------------------------------
        */

        $actividadesRecientes = collect();


        // Empresas registradas
        Empresa::latest()
            ->take(5)
            ->get()
            ->each(function ($empresa) use ($actividadesRecientes) {

                $nombre = $empresa->nombre_comercial
                    ?? $empresa->razon_social
                    ?? 'Empresa';

                $actividadesRecientes->push((object) [
                    'tipo' => 'empresa',
                    'icono' => 'fa-solid fa-building',
                    'titulo' => 'Nueva empresa registrada',
                    'descripcion' => $nombre,
                    'fecha' => $empresa->created_at,
                ]);
            });


        // Profesionales registrados
        Profesional::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->each(function ($profesional) use ($actividadesRecientes) {

                $nombre = $profesional->user->name
                    ?? 'Profesional';

                $actividadesRecientes->push((object) [
                    'tipo' => 'profesional',
                    'icono' => 'fa-solid fa-user-doctor',
                    'titulo' => 'Nuevo profesional registrado',
                    'descripcion' => $nombre,
                    'fecha' => $profesional->created_at,
                ]);
            });


        // Oportunidades
        Oportunidad::with('empresa')
            ->latest()
            ->take(5)
            ->get()
            ->each(function ($oportunidad) use ($actividadesRecientes) {

                $empresa = $oportunidad->empresa;

                $nombreEmpresa = $empresa->nombre_comercial
                    ?? $empresa->razon_social
                    ?? 'Empresa';

                $actividadesRecientes->push((object) [
                    'tipo' => 'oportunidad',
                    'icono' => 'fa-solid fa-briefcase',
                    'titulo' => 'Nueva oportunidad publicada',
                    'descripcion' =>
                    $oportunidad->titulo .
                        ' · ' .
                        $nombreEmpresa,
                    'fecha' => $oportunidad->created_at,
                ]);
            });


        // Postulaciones
        Postulacion::with([
            'profesional.user',
            'oportunidad.empresa',
        ])
            ->latest('fecha_postulacion')
            ->take(5)
            ->get()
            ->each(function ($postulacion) use ($actividadesRecientes) {

                $profesional = $postulacion->profesional;

                $nombreProfesional =
                    $profesional?->user?->name
                    ?? 'Profesional';

                $titulo =
                    $postulacion->oportunidad?->titulo
                    ?? 'Oportunidad';

                $actividadesRecientes->push((object) [
                    'tipo' => 'postulacion',
                    'icono' => 'fa-solid fa-paper-plane',
                    'titulo' => 'Nueva postulación',
                    'descripcion' =>
                    $nombreProfesional .
                        ' postuló a "' .
                        $titulo .
                        '"',
                    'fecha' => $postulacion->fecha_postulacion,
                ]);
            });


        $actividadesRecientes = $actividadesRecientes
            ->sortByDesc('fecha')
            ->take(10)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Empresas pendientes de validación
        |--------------------------------------------------------------------------
        */

        $empresasPorValidar = Empresa::where(
            'estado_validacion',
            'pendiente'
        )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Últimas postulaciones
        |--------------------------------------------------------------------------
        */

        $ultimasPostulaciones = Postulacion::with([
            'profesional.user',
            'oportunidad.empresa',
        ])
            ->latest('fecha_postulacion')
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Datos para gráfico
        |--------------------------------------------------------------------------
        */

        $postulacionesPorEstado = Postulacion::select(
            'estado',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('estado')
            ->pluck('total', 'estado');

      $usuario=Auth::user();
        return view(
            'dashboard.admin',
            compact(
                'totalUsuarios',
                'totalEmpresas',
                'empresasValidadas',
                'empresasPendientes',
                'totalProfesionales',
                'totalOportunidades',
                'oportunidadesPublicadas',
                'totalPostulaciones',
                'postulacionesPendientes',
                'actividadesRecientes',
                'empresasPorValidar',
                'ultimasPostulaciones',
                'postulacionesPorEstado',
                'usuario'
            )
        );
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
    public function perfilEmpresa()
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        return view('dashboard.perfil-empresa', compact(
            'usuario',
            'empresa'
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
