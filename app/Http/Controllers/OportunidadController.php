<?php

namespace App\Http\Controllers;

use App\Models\Oportunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OportunidadController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        $oportunidades = Oportunidad::where('empresa_id', $empresa->id)
            ->withCount('postulaciones')
            ->latest()
            ->paginate(10);

        return view('oportunidades.index', compact(
            'usuario',
            'empresa',
            'oportunidades'
        ));
    }


    public function create()
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        return view('oportunidades.create', compact(
            'usuario',
            'empresa'
        ));
    }


    public function store(Request $request)
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        $datos = $request->validate([
            'titulo' => 'required|string|max:150',

            'area' => 'nullable|string|max:100',

            'descripcion' => 'required|string',

            'requisitos' => 'nullable|string',

            'funciones' => 'nullable|string',

            'tipo_contrato' => 'required|string|max:100',

            'modalidad' => 'required|string|max:100',

            'ubicacion' => 'nullable|string|max:150',

            'salario_min' => 'nullable|numeric|min:0',

            'salario_max' => 'nullable|numeric|min:0|gte:salario_min',

            'mostrar_salario' => 'nullable|boolean',

            'fecha_cierre' => 'nullable|date|after_or_equal:today',
        ]);

        $datos['empresa_id'] = $empresa->id;

        $datos['mostrar_salario'] =
            $request->boolean('mostrar_salario');

        /*
         * La oportunidad inicialmente queda pendiente
         * para revisión de M&M CLUB.
         */
        $datos['estado'] = 'pendiente';

        Oportunidad::create($datos);

        return redirect()
            ->route('oportunidades.index')
            ->with(
                'success',
                'La oportunidad fue publicada y quedó pendiente de revisión.'
            );
    }


    public function show(Oportunidad $oportunidad)
    {
        $this->verificarEmpresa($oportunidad);
        $usuario=Auth::user();

        $oportunidad->load([
            'empresa',
            'postulaciones.profesional'
        ]);

        return view(
            'oportunidades.show',
            compact('oportunidad','usuario')
        );
    }

    public function edit(Oportunidad $oportunidad)
    {
        $this->verificarEmpresa($oportunidad);
        $usuario=Auth::user();

        return view(
            'oportunidades.edit',
            compact('oportunidad','usuario')
        );
    }


    public function update(
        Request $request,
        Oportunidad $oportunidad
    ) {
        $this->verificarEmpresa($oportunidad);

        $datos = $request->validate([
            'titulo' => 'required|string|max:150',

            'area' => 'nullable|string|max:100',

            'descripcion' => 'required|string',

            'requisitos' => 'nullable|string',

            'funciones' => 'nullable|string',

            'tipo_contrato' => 'required|string|max:100',

            'modalidad' => 'required|string|max:100',

            'ubicacion' => 'nullable|string|max:150',

            'salario_min' => 'nullable|numeric|min:0',

            'salario_max' => 'nullable|numeric|min:0|gte:salario_min',

            'mostrar_salario' => 'nullable|boolean',

            'fecha_cierre' => 'nullable|date',
        ]);

        $datos['mostrar_salario'] =
            $request->boolean('mostrar_salario');

        /*
         * Si una oportunidad ya fue publicada,
         * al modificarla puede volver a revisión.
         */
        if ($oportunidad->estado === 'publicada') {
            $datos['estado'] = 'pendiente';
        }

        $oportunidad->update($datos);

        return redirect()
            ->route('oportunidades.index')
            ->with(
                'success',
                'La oportunidad fue actualizada correctamente.'
            );
    }


    public function destroy(Oportunidad $oportunidad)
    {
        $this->verificarEmpresa($oportunidad);

        $oportunidad->delete();

        return redirect()
            ->route('oportunidades.index')
            ->with(
                'success',
                'La oportunidad fue eliminada correctamente.'
            );
    }


    private function verificarEmpresa(Oportunidad $oportunidad)
    {
        $empresa = Auth::user()->empresa;


        abort_unless(
            $empresa &&
                $oportunidad->empresa_id == $empresa->id,
            403
        );
    }
}
