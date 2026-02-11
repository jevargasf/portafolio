<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\PerfilProfesional;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;

class PublicPortfolioController extends Controller
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

    public function verPerfil()
    {
    // 1. Obtener los datos (puedes filtrar por 'visible' si quieres ocultar algunos)

        $perfil = PerfilProfesional::where('estado', 1)
            ->with([
                'usuario', 
                'documentos',
                'experiencias' => fn($q) => $q->orderBy('es_trabajo_actual', 'desc')->orderBy('fecha_inicio', 'desc'),
                'educacion' => fn($q) => $q->orderBy('fecha_inicio', 'desc'),
                'certificaciones' => fn($q) => $q->orderBy('fecha_inicio', 'desc')
            ])
            ->firstOrFail();
        $experiencias = PerfilProfesional::where('estado', 1)->firstOrFail()->experiencias;
        $educacion    = PerfilProfesional::where('estado', 1)->firstOrFail()->educacion;
        $certificaciones = PerfilProfesional::where('estado', 1)->firstOrFail()->certificaciones;

        // 2. Estandarizar (DTO - Data Transfer Object simplificado)
        // Convertimos todo a un formato común: 'fecha', 'titulo', 'subtitulo', 'tipo'
        
        $timeline = collect();

        // Mapear Experiencia
        $timeline = $timeline->merge($experiencias->map(function($item) {
            return [
                'fecha' => $item->fecha_inicio, // Usamos Carbon para ordenar
                'fecha_fin' => $item->fecha_fin,
                'titulo' => $item->cargo,
                'subtitulo' => $item->empresa,
                'descripcion' => $item->descripcion,
                'tipo' => 'WORK', // Para el ícono y color
                'es_hito' => true // Esto decide si va grande o pequeño
            ];
        }));

        // Mapear Educación
        $timeline = $timeline->merge($educacion->map(function($item) {
            return [
                'fecha' => $item->fecha_inicio,
                'fecha_fin' => $item->fecha_fin,
                'titulo' => $item->titulo,
                'subtitulo' => $item->institucion,
                'descripcion' => $item->descripcion, // Tesis, logros
                'tipo' => 'ACADEMIC',
                'es_hito' => true
            ];
        }));

        // Mapear Certificaciones (Aquí está el truco)
        $timeline = $timeline->merge($certificaciones->map(function($item) {
            return [
                'fecha' => $item->fecha_obtencion,
                'fecha_fin' => null, // Las certs son puntuales
                'titulo' => $item->nombre,
                'subtitulo' => $item->plataforma, // Udemy, Coursera, AWS
                'descripcion' => null, // Generalmente no necesitamos descripción larga
                'tipo' => 'CERT',
                'es_hito' => false // <--- ESTO ES CLAVE. No es un hito mayor.
            ];
        }));

        // 3. Ordenar cronológicamente descendente (Lo más nuevo primero)
        $timeline = $timeline->sortByDesc('fecha');

        return view('public.perfil', compact('perfil', 'timeline'));
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

    public function detalleProyecto(Proyecto $proyecto){
        $proyecto->load('tecnologias', 'documentos');

        return view('public.detalle-proyecto', compact('proyecto'));
    }

    public function descargarCV(Request $request){
        
    }

    public function verBlog(Request $request){
        
    }
}
