<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\PerfilProfesional;
use App\Models\Proyecto;

class PublicController extends Controller
{
    public function index(Request $request){
        $emailDueño = config('app.portfolio_owner', env('PORTFOLIO_OWNER_EMAIL'));

        $usuario = Usuario::where('correo', $emailDueño)->first();

        if (!$usuario || !$usuario->perfil) {
            abort(404, 'Perfil del dueño no configurado');
        }

        $perfil = $usuario->perfil->load('proyectos', 'habilidades');

        return view('welcome', compact('perfil'));
    }

    public function verPerfil(Request $request){

    }

    public function verProyectos(Request $request){
        
    }

    public function detalleProyecto(Request $request){
        
    }

    public function descargarCV(Request $request){
        
    }
}
