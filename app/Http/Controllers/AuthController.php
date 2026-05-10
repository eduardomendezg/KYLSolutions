<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\AttemptToAuthenticate;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login'); //vista
    }

public function login(Request $request)
{
    //  Validaciones básicas
    $credentials = $request->validate([
        'codigo' => ['required', 'numeric', 'digits:6'],
        'password' => ['required'],
    ]);

    // Intenta el inicio de sesión
    if (Auth::attempt($credentials)) {
        $usuarioLog = Auth::user();
        
        // Obtiene el rol seleccionado 
        $rolSeleccionado = $request->query('rol');

        //  Valida si el rol coincide
        // Compara el rol del usuario en la BD con el seleccionado en la interfaz
        if ($rolSeleccionado && $usuarioLog->roles->nombre_rol !== $rolSeleccionado) {
            
            // Si no coincide, cerramos la sesión inmediatamente y mandamos error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'codigo' => "Acceso denegado. Usted no tiene privilegios de $rolSeleccionado.",
            ])->withInput();
        }

        //  Si todo va bien, regenerar sesión y redireccionar
        $request->session()->regenerate();

        return match($usuarioLog->roles->nombre_rol) {
            'Administrador' => redirect()->intended('/admin/dashboard'),
            'Gerente'       => redirect()->route('gerente.dashboard'),
            'Vendedor'      => redirect()->intended('punto-venta'),
            default         => redirect('/'),
        };
    }

    // Error de credenciales incorrectas
    return back()->withErrors([
        'codigo' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('codigo');
}

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
