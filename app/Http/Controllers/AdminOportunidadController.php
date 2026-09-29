<?php

namespace App\Http\Controllers;

use App\Models\Oportunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOportunidadController extends Controller
{
    /**
     * Listado de oportunidades.
     */
    public function index(Request $request)
    {
        $usuario=Auth::user();
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');

        $oportunidades = Oportunidad::query()
            ->with('empresa')
            ->withCount('postulaciones')

            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {

                    $q->where('titulo', 'like', "%{$buscar}%")
                        ->orWhere('area', 'like', "%{$buscar}%")
                        ->orWhere('ubicacion', 'like', "%{$buscar}%")

                        ->orWhereHas('empresa', function ($empresa) use ($buscar) {
                            $empresa
                                ->where('razon_social', 'like', "%{$buscar}%")
                                ->orWhere('nombre_comercial', 'like', "%{$buscar}%");
                        });
                });
            })

            ->when($estado, function ($query) use ($estado) {
                $query->where('estado', $estado);
            })

            ->latest()
            ->paginate(100)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | ESTADÍSTICAS
        |--------------------------------------------------------------------------
        */

        $totalOportunidades = Oportunidad::count();

        $publicadas = Oportunidad::where(
            'estado',
            'publicada'
        )->count();

        $cerradas = Oportunidad::where(
            'estado',
            'cerrada'
        )->count();

        $totalPostulaciones = \App\Models\Postulacion::count();

        return view('admin.oportunidades.index', compact(
            'oportunidades',
            'buscar',
            'estado',
            'totalOportunidades',
            'publicadas',
            'cerradas',
            'totalPostulaciones',
            'usuario'
        ));
    }

    /**
     * Detalle de una oportunidad.
     */
    public function show(Oportunidad $oportunidad)
    {
        $usuario=Auth::user();
        $oportunidad->load([
            'empresa',
            'postulaciones.profesional.user',
        ]);

        return view(
            'admin.oportunidades.show',
            compact('oportunidad','usuario')
        );
    }

    /**
     * Cambiar estado publicada / cerrada.
     */
    public function cambiarEstado(Oportunidad $oportunidad)
    {
        $nuevoEstado = $oportunidad->estado === 'publicada'
            ? 'cerrada'
            : 'publicada';

        $oportunidad->update([
            'estado' => $nuevoEstado,
        ]);

        return back()->with(
            'success',
            $nuevoEstado === 'publicada'
                ? 'La oportunidad ha sido publicada correctamente.'
                : 'La oportunidad ha sido cerrada correctamente.'
        );
    }
}