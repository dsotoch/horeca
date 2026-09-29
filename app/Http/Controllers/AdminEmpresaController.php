<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminEmpresaController extends Controller
{
    /**
     * Listado de empresas.
     */
    public function index(Request $request)
    {
        $usuario=auth()->user();
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');

        $empresas = Empresa::query()
            ->with('usuario')
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('razon_social', 'like', "%{$buscar}%")
                        ->orWhere('nombre_comercial', 'like', "%{$buscar}%")
                        ->orWhere('ruc', 'like', "%{$buscar}%")
                        ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado_validacion', $estado);
            })
            ->latest()
            ->paginate(50)
            ->withQueryString();

        $totalEmpresas = Empresa::count();

        $pendientes = Empresa::where(
            'estado_validacion',
            'pendiente'
        )->count();

        $validadas = Empresa::where(
            'estado_validacion',
            'aprobado'
        )->count();

        $observadas = Empresa::where(
            'estado_validacion',
            'observado'
        )->count();

        return view(
            'admin.empresas.index',
            compact(
                'empresas',
                'buscar',
                'estado',
                'totalEmpresas',
                'pendientes',
                'validadas',
                'observadas',
                'usuario'
            )
        );
    }


    /**
     * Ver detalle de una empresa.
     */
    public function show(Empresa $empresa)
    {
        $usuario=Auth::user();
        $empresa->load([
            'usuario',
            'oportunidades' => function ($query) {
                $query->latest();
            },
        ]);

        return view(
            'admin.empresas.show',
            compact('empresa','usuario')
        );
    }


    /**
     * Validar empresa.
     */
    public function validar(Empresa $empresa)
    {
        $empresa->update([
            'estado_validacion' => 'aprobado',
            'fecha_validacion' => now(),
        ]);

        return back()->with(
            'success',
            'La empresa ha sido validada correctamente.'
        );
    }


    /**
     * Observar empresa.
     */
    public function observar(Request $request, Empresa $empresa)
    {
        $request->validate([
            'observacion' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        /*
         * Si todavía no tienes una columna observacion,
         * por ahora solo cambiamos el estado.
         */
        $empresa->update([
            'estado_validacion' => 'rechazado',
        ]);

        return back()->with(
            'success',
            'La empresa ha sido marcada como observada.'
        );
    }


    /**
     * Activar / desactivar empresa.
     */
    public function cambiarEstado(Empresa $empresa)
    {
        $nuevoEstado = $empresa->usuario?->estado === 'activo'
            ? 'inactivo'
            : 'activo';

        if ($empresa->usuario) {
            $empresa->usuario->update([
                'estado' => $nuevoEstado,
            ]);
        }

        return back()->with(
            'success',
            $nuevoEstado === 'activo'
                ? 'La empresa ha sido activada.'
                : 'La empresa ha sido desactivada.'
        );
    }
}