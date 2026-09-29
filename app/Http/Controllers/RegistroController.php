<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profesional;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RegistroController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORMULARIO PROFESIONAL
    |--------------------------------------------------------------------------
    */

    public function profesional()
    {
        return view('registro.register-profesional');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTRAR PROFESIONAL
    |--------------------------------------------------------------------------
    */

    public function profesionalStore(Request $request)
    {
        $datos = $request->validate([

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
                Rule::in(['DNI', 'CE']),
            ],

            'numero_documento' => [
                'required',
                'string',
                'max:20',
                'unique:profesionales,numero_documento',
            ],

            'celular' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

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
                'string',
            ],

            'modalidad' => [
                'required',
                Rule::in([
                    'presencial',
                    'remoto',
                    'hibrido'
                ]),
            ],

            'ciudad' => [
                'required',
                'string',
                'max:100',
            ],

            'distrito' => [
                'required',
                'string',
                'max:100',
            ],

            'descripcion' => [
                'required',
                'string',
                'max:3000',
            ],

            'habilidades' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'video_presentacion' => [
                'nullable',
                'file',
                'mimes:mp4,mov,avi,webm',
                'max:51200',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'terminos' => [
                'accepted',
            ],

        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CREAR USUARIO
            |--------------------------------------------------------------------------
            */

            $user = User::create([

                'name' =>
                    $datos['nombres'] . ' ' .
                    $datos['apellidos'],

                'email' => $datos['email'],

                'password' => Hash::make(
                    $datos['password']
                ),

                'rol' => 'profesional',

                'estado' => 'activo',

            ]);


            /*
            |--------------------------------------------------------------------------
            | VIDEO
            |--------------------------------------------------------------------------
            */

            $video = null;

            if ($request->hasFile('video_presentacion')) {

                $video = $request
                    ->file('video_presentacion')
                    ->store(
                        'profesionales/videos',
                        'public'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | CREAR PERFIL PROFESIONAL
            |--------------------------------------------------------------------------
            */

            Profesional::create([

                'user_id' => $user->id,

                'nombres' => $datos['nombres'],

                'apellidos' => $datos['apellidos'],

                'tipo_documento' =>
                    $datos['tipo_documento'],

                'numero_documento' =>
                    $datos['numero_documento'],

                'celular' =>
                    $datos['celular'],

                'especialidad' =>
                    $datos['especialidad'],

                'subespecialidad' =>
                    $datos['subespecialidad'] ?? null,

                'experiencia' =>
                    $datos['experiencia'],

                'modalidad' =>
                    $datos['modalidad'],

                'ciudad' =>
                    $datos['ciudad'],

                'distrito' =>
                    $datos['distrito'],

                'descripcion' =>
                    $datos['descripcion'],

                'habilidades' =>
                    $datos['habilidades'] ?? null,

                'video_presentacion' =>
                    $video,

                'estado_validacion' =>
                    'pendiente',

            ]);


            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | LOGIN AUTOMÁTICO
            |--------------------------------------------------------------------------
            */

            auth()->login($user);


            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Tu registro profesional fue creado correctamente. Tu perfil será revisado por CLUB HORECA PRO.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            if (!empty($video)) {
                Storage::disk('public')->delete($video);
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No se pudo completar el registro. Inténtalo nuevamente.'
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULARIO EMPRESA
    |--------------------------------------------------------------------------
    */

    public function empresa()
    {
        return view('registro.register-empresa');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTRAR EMPRESA
    |--------------------------------------------------------------------------
    */

    public function empresaStore(Request $request)
    {
        $datos = $request->validate([

            'ruc' => [
                'required',
                'digits:11',
                'unique:empresas,ruc',
            ],

            'razon_social' => [
                'required',
                'string',
                'max:255',
            ],

            'nombre_comercial' => [
                'required',
                'string',
                'max:255',
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
                'required',
                'string',
                'max:100',
            ],

            'celular' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'departamento' => [
                'required',
                'string',
                'max:100',
            ],

            'ciudad' => [
                'required',
                'string',
                'max:100',
            ],

            'distrito' => [
                'required',
                'string',
                'max:100',
            ],

            'direccion' => [
                'required',
                'string',
                'max:255',
            ],

            'perfiles_busca' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'tipo_contratacion' => [
                'nullable',
                'string',
                'max:100',
            ],

            'cantidad_profesionales' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:3000',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'terminos' => [
                'accepted',
            ],

        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | USUARIO
            |--------------------------------------------------------------------------
            */

            $user = User::create([

                'name' =>
                    $datos['nombre_comercial'],

                'email' =>
                    $datos['email'],

                'password' =>
                    Hash::make($datos['password']),

                'rol' =>
                    'empresa',

                'estado' =>
                    'activo',

            ]);


            /*
            |--------------------------------------------------------------------------
            | EMPRESA
            |--------------------------------------------------------------------------
            */

            Empresa::create([

                'user_id' =>
                    $user->id,

                'ruc' =>
                    $datos['ruc'],

                'razon_social' =>
                    $datos['razon_social'],

                'nombre_comercial' =>
                    $datos['nombre_comercial'],

                'tipo_empresa' =>
                    $datos['tipo_empresa'],

                'sitio_web' =>
                    $datos['sitio_web'] ?? null,

                'red_social' =>
                    $datos['red_social'] ?? null,

                'contacto_nombres' =>
                    $datos['contacto_nombres'],

                'contacto_apellidos' =>
                    $datos['contacto_apellidos'],

                'cargo' =>
                    $datos['cargo'],

                'celular' =>
                    $datos['celular'],

                'email' =>
                    $datos['email'],

                'departamento' =>
                    $datos['departamento'],

                'ciudad' =>
                    $datos['ciudad'],

                'distrito' =>
                    $datos['distrito'],

                'direccion' =>
                    $datos['direccion'],

                'perfiles_busca' =>
                    $datos['perfiles_busca'] ?? null,

                'tipo_contratacion' =>
                    $datos['tipo_contratacion'] ?? null,

                'cantidad_profesionales' =>
                    $datos['cantidad_profesionales'] ?? null,

                'descripcion' =>
                    $datos['descripcion'] ?? null,

                'estado_validacion' =>
                    'pendiente',

            ]);


            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | LOGIN AUTOMÁTICO
            |--------------------------------------------------------------------------
            */

            auth()->login($user);


            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Tu empresa fue registrada correctamente. CLUB HORECA PRO revisará la información antes de habilitarla.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No se pudo completar el registro de la empresa. Inténtalo nuevamente.'
                );
        }
    }
}