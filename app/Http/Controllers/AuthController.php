<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Procesar login
     */
    public function loginStore(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $recordar = $request->boolean('recordar');

        if (!Auth::attempt($credenciales, $recordar)) {

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'El correo electrónico o la contraseña son incorrectos.',
                ]);
        }

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Bienvenido a CLUB HORECA PRO.'
            );
    }
    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Has cerrado sesión correctamente.'
            );
    }
}
