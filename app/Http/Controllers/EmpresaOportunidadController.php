<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Oportunidad;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaOportunidadController extends Controller
{
    /**
     * Ver las postulaciones recibidas
     * para una oportunidad de la empresa.
     */
    public function postulaciones(Oportunidad $oportunidad)
    {
        return redirect()->route('oportunidades.show', ['oportunidad' => $oportunidad]);
    }
    public function verPerfilProfesional(Postulacion $postulacion)
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        abort_unless(
            $empresa,
            403,
            'El usuario no tiene un perfil de empresa registrado.'
        );

        $postulacion->load([
            'oportunidad',
            'profesional.user',
        ]);

        abort_unless(
            $postulacion->oportunidad &&
                $postulacion->oportunidad->empresa_id === $empresa->id,
            403,
            'No tienes permiso para ver este perfil.'
        );

        abort_unless(
            $postulacion->profesional,
            404,
            'El profesional no existe.'
        );

        return view(
            'empresa.postulaciones.profesional',
            compact(
                'empresa',
                'postulacion',
                'usuario'
            )
        );
    }

    /**
     * Actualizar estado de una postulación.
     */
    public function actualizarEstadoPostulacion(
        Request $request,
        Postulacion $postulacion
    ) {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        abort_unless(
            $empresa,
            403,
            'El usuario no tiene un perfil de empresa registrado.'
        );

        // Cargamos la oportunidad relacionada.
        $postulacion->load('oportunidad');

        // Seguridad:
        // La postulación debe pertenecer a una oportunidad
        // publicada por esta empresa.
        abort_unless(
            $postulacion->oportunidad &&
                $postulacion->oportunidad->empresa_id === $empresa->id,
            403,
            'No tienes permiso para modificar esta postulación.'
        );

        $datos = $request->validate([
            'estado' => [
                'required',
                'in:pendiente,en_revision,entrevista,seleccionado,descartado',
            ],

            'observaciones' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ]);

        $postulacion->update([
            'estado' => $datos['estado'],
            'observaciones' => $datos['observaciones'] ?? null,
        ]);

        return back()->with(
            'success',
            'La postulación fue actualizada correctamente.'
        );
    }
    public function todasPostulaciones()
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        abort_unless(
            $empresa,
            403,
            'El usuario no tiene un perfil de empresa registrado.'
        );

        $postulaciones = Postulacion::query()
            ->whereHas('oportunidad', function ($query) use ($empresa) {
                $query->where('empresa_id', $empresa->id);
            })
            ->with([
                'oportunidad',
                'profesional.user',
            ])
            ->latest('fecha_postulacion')
            ->paginate(15);

        return view(
            'empresa.postulaciones.index',
            compact(
                'empresa',
                'postulaciones',
                'usuario'
            )
        );
    }
}
