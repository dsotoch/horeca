<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfesionalController extends Controller
{
    /**
     * Listado de profesionales
     */
    public function index(Request $request)
    {
        $usuario = Auth::user();

        $buscar = $request->input('buscar');

        $profesionales = Profesional::with('user')
            ->when($buscar, function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {

                    $q->where('nombres', 'like', "%{$buscar}%")
                        ->orWhere('apellidos', 'like', "%{$buscar}%")
                        ->orWhere('numero_documento', 'like', "%{$buscar}%")
                        ->orWhere('especialidad', 'like', "%{$buscar}%");

                });

            })
            ->latest()
            ->paginate(100)
            ->withQueryString();

        $totalProfesionales = Profesional::count();

        return view(
            'admin.profesionales.index',
            compact(
                'profesionales',
                'buscar',
                'totalProfesionales',
                'usuario'
            )
        );
    }


    /**
     * Ver detalle del profesional
     */
    public function show(Profesional $profesional)
    {
        $usuario=Auth::user();
        $profesional->load('user');

        return view(
            'admin.profesionales.show',
            compact('profesional','usuario')
        );
    }


    /**
     * Activar / desactivar profesional
     */
    public function cambiarEstado(Profesional $profesional)
    {
        $usuario = $profesional->user;

        if (!$usuario) {

            return back()->with(
                'error',
                'El profesional no tiene un usuario asociado.'
            );
        }

        $nuevoEstado = $usuario->estado === 'activo'
            ? 'inactivo'
            : 'activo';

        $usuario->update([
            'estado' => $nuevoEstado,
        ]);

        return back()->with(
            'success',
            $nuevoEstado === 'activo'
                ? 'El profesional ha sido habilitado correctamente.'
                : 'El profesional ha sido inhabilitado correctamente.'
        );
    }
}