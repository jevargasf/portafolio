<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function formCrearProyecto(Request $request){
        return view('portafolio.proyectos.crear-proyecto');
    }

    public function crearProyecto(Request $request){
        $validated = $request->validate([
            'nombre'            => 'required|string|max:200',
            'descripcion'       => 'nullable|string',
            'fecha_realizacion' => 'nullable|date',
            'horas_trabajo'     => 'nullable|integer|min:0',
            'url_repositorio'   => 'nullable|url|max:255',
            'url_produccion'    => 'nullable|url|max:255',
            'estado'            => 'required|integer|in:0,1',
        ], [
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'url_repositorio.url' => 'El formato del enlace al repositorio no es válido.',
        ]);

        /** @var \App\Models\Usuario $user */
        $user = Auth::user();
        
        // Verificación de seguridad: ¿El usuario tiene un perfil creado?
        
        if (!$user->perfil) {
            $user->perfil()->create(['estado' => 1]);
            $user->refresh();
        }

        Proyecto::create([
            'perfil_id'         => $user->perfil->id,
            'nombre'            => $validated['nombre'],
            'descripcion'       => $validated['descripcion'],
            'fecha_realizacion' => $validated['fecha_realizacion'],
            'horas_trabajo'     => $validated['horas_trabajo'],
            'url_repositorio'   => $validated['url_repositorio'],
            'url_produccion'    => $validated['url_produccion'],
            'estado'            => $validated['estado'],
        ]);

        return redirect()
            ->route('panel.proyectos.listar')
            ->with('success', 'El proyecto ha sido creado exitosamente.');
    }

    public function listarProyectos(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $proyectos = Proyecto::orderBy('id', 'desc')->paginate($perPage);

        return view('portafolio.proyectos.listar-proyectos', compact('proyectos'));
    }
}
