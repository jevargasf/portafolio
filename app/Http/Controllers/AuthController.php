<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin(Request $request){
        return view('auth.login');
    }

    public function login(Request $request){
        // VALIDAR
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        // AUTENTICAR
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // return view('admin.inicio');
            return redirect()->intended(route('admin.inicio'));
        }

        // FALLA
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
