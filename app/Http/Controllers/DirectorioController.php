<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectorioController extends Controller
{
    public function empresas(Request $request)
    {
        $usuario = Auth::user();
        $buscar = $request->input('buscar');
        $ciudad = $request->input('ciudad');

        $empresas = Empresa::query()
            ->where('estado_validacion', 'aprobado')
            ->with('oportunidades')
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('razon_social', 'like', "%{$buscar}%")
                        ->orWhere('nombre_comercial', 'like', "%{$buscar}%")
                        ->orWhere('tipo_empresa', 'like', "%{$buscar}%");
                });
            })
            ->when($ciudad, function ($query) use ($ciudad) {
                $query->where('ciudad', $ciudad);
            })
            ->latest()
            ->paginate(100)
            ->withQueryString();


        $ciudades = Empresa::query()
            ->where('estado_validacion', 'aprobado')
            ->whereNotNull('ciudad')
            ->where('ciudad', '!=', '')
            ->distinct()
            ->orderBy('ciudad')
            ->pluck('ciudad');

        return view(
            'directorio.empresas.index',
            compact(
                'empresas',
                'ciudades',
                'buscar',
                'ciudad',
                'usuario'
            )
        );
    }

    public function empresa(Empresa $empresa)
    {
        $usuario=Auth::user();
        abort_unless(
            $empresa->estado_validacion === 'aprobado',
            404
        );

        $empresa->load([
            'oportunidades' => function ($query) {
                $query
                    ->where('estado', 'publicada')
                    ->latest();
            }
        ]);

        return view(
            'directorio.empresas.show',
            compact('empresa','usuario')
        );
    }
}
