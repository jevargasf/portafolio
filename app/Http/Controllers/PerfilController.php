<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function formEditarPerfil() {
        /** @var \App\Models\Usuario $usuario */
        $usuario = Auth::user();
        
        $perfil = $usuario->perfil()->with(['redesSociales', 'experiencias', 'educacion', 'documentos'])->first();
        
        return view('portafolio.perfil.editar-perfil', compact('usuario', 'perfil'));
    }

    public function editarPerfil(Request $request){

    }
}
