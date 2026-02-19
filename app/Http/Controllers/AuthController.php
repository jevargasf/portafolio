<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialAcceso;

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
            $rol = (int) Auth::user()->rol_id; 

            $rutaDestino = match ($rol) {
                1 => 'auth.form-seleccionar-perfil', // ID 1 = Admin
                2 => 'panel.inicio', // ID 2 = Funcionario
            };

            HistorialAcceso::create([
                'usuario_id'  => Auth::id(),
                'fecha'       => now(),
                'tipo_accion' => 1 // Login
            ]);

            return redirect()->intended(route($rutaDestino));
        }

        // FALLA
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden'
        ]);
    }

    public function formSeleccionarPerfil(Request $request){
        if ((int) Auth::user()->rol_id !== 1) {
            return redirect()->route('panel.inicio');
        }
        return view('auth.profile');
    }

    public function seleccionarPerfil(Request $request){
        $validated = $request->validate([
            'perfilId' => 'required|integer'
        ]);
        
        $rutaDestino = match (intval($validated['perfilId'])) {
            1 => 'admin.dashboard', // CORREGIDO: Debe coincidir con web.php
            2 => 'panel.inicio',    
        };

        return redirect()->intended(route($rutaDestino));
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('public.inicio');
    }
}
