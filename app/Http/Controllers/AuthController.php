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

    public function login(Request $request){
        //validaciones
        $credentials = $request->validate([
            'codigo' => ['required', 'numeric', 'digits:6'],
            'password'=> ['required'],
        ]);

        //inicio de sesion

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $usuarioLog =Auth::user();

            return match($usuarioLog->roles->nombre_rol){
                'Administrador' => redirect()->intended('/admin/dashboard'),
                'Gerente'       => redirect()->intended('/gerente/dashboard'),
                'Vendedor'      => redirect()->intended('/vendedor/ventana'),
                default         => redirect('/'),
            };
        }
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
