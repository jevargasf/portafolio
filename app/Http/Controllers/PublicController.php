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

        $perfil = $usuario->perfil->load('proyectos');

        return view('public.index', compact('perfil'));
    }

    public function verPerfil(Request $request){

    }

    public function verProyectos(Request $request)
    {
        $query = Proyecto::where('estado', 1)->with(['tecnologias', 'documentos']);

        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->has('tech') && $request->tech != '') {
            $query->whereHas('tecnologias', function($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->tech . '%');
            });
        }

        $proyectos = $query->orderBy('fecha_realizacion', 'desc')->paginate(5);

        return view('public.proyectos', compact('proyectos'));
    }

    public function detalleProyecto(Request $request){
        
    }

    public function descargarCV(Request $request){
        
    }
}
