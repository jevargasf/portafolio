<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tecnologia;
use Illuminate\Support\Facades\Log;

class ProyectosController extends Controller
{
    public function formCrearProyecto(Request $request){

        $tecnologias = Tecnologia::where('estado', 1)->get();

        return view('portafolio.proyectos.crear-proyecto', compact('tecnologias'));
    }

    public function crearProyecto(Request $request){
        $validated = $request->validate([
            'nombre'            => 'required|string|max:200',
            'descripcion'       => 'nullable|string',
            'desafio'           => 'nullable|string',
            'solucion'          => 'nullable|string',
            'fecha_realizacion' => 'nullable|date',
            'horas_trabajo'     => 'nullable|integer|min:0',
            'url_repositorio'   => 'nullable|url|max:255',
            'url_produccion'    => 'nullable|url|max:255',
            'estado'            => 'required|integer|in:0,1',
            'imagen_portada'    => 'nullable|image|max:2048', 
            'tecnologias'       => 'nullable|array'
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

        DB::transaction(function () use ($validated, $user, $request) {
            $proyecto = Proyecto::create([
                'perfil_id'         => $user->perfil->id,
                'nombre'            => $validated['nombre'],
                'descripcion'       => $validated['descripcion'],
                'desafio'           => $validated['desafio'],
                'solucion'          => $validated['solucion'],
                'fecha_realizacion' => $validated['fecha_realizacion'],
                'horas_trabajo'     => $validated['horas_trabajo'],
                'url_repositorio'   => $validated['url_repositorio'],
                'url_produccion'    => $validated['url_produccion'],
                'estado'            => $validated['estado'],
            ]);

            // if ($request->hasFile('imagen_portada')) {
            //         // Aquí iría tu lógica de subir archivo a DocumentosProyectos...
            // }

            if ($request->has('tecnologias')) {
                    $proyecto->tecnologias()->sync($request->tecnologias);
            }
        });

        return redirect()
            ->route('panel.proyectos.listar')
            ->with('success', 'El proyecto ha sido creado exitosamente.');
            
    }

    public function listarProyectos(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $proyectos = Proyecto::orderBy('id', 'desc')->paginate($perPage);

        return view('portafolio.proyectos.listar-proyectos', compact('proyectos'));
    }

    public function formEditarProyecto(Request $request)
    {
        $proyecto = Proyecto::with('tecnologias')->findOrFail($request->id);

    
        $tecnologias = Tecnologia::where('estado', 1)->get();

        return view('portafolio.proyectos.editar-proyecto', compact('proyecto', 'tecnologias'));
    }

    public function editarProyecto(Request $request){

        $validated = $request->validate([
            'id'                => 'required|integer',
            'nombre'            => 'required|string|max:200',
            'descripcion'       => 'nullable|string',
            'desafio'           => 'nullable|string',
            'solucion'          => 'nullable|string',
            'fecha_realizacion' => 'nullable|date',
            'horas_trabajo'     => 'nullable|integer|min:0',
            'url_repositorio'   => 'nullable|url|max:255',
            'url_produccion'    => 'nullable|url|max:255',
            'estado'            => 'required|integer|in:0,1',
            'imagen_portada'    => 'nullable|image|max:2048', // Máx 2MB
            'tecnologias'       => 'nullable|array',
            'tecnologias.*'     => 'exists:tecnologias,id' // Verifica que cada ID exista
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'tecnologias.*.exists' => 'Una de las tecnologías seleccionadas no es válida.'
        ]);
        try {
            $user = Auth::user();

            $proyecto = $user->perfil->proyectos()->findOrFail($request->id);

            DB::transaction(function () use ($validated, $request, $proyecto) {
                
                $proyecto->update([
                    'nombre'            => $validated['nombre'],
                    'descripcion'       => $validated['descripcion'],
                    'desafio'           => $validated['desafio'],
                    'solucion'          => $validated['solucion'],
                    'fecha_realizacion' => $validated['fecha_realizacion'],
                    'horas_trabajo'     => $validated['horas_trabajo'],
                    'url_repositorio'   => $validated['url_repositorio'],
                    'url_produccion'    => $validated['url_produccion'],
                    'estado'            => $validated['estado'],
                ]);

// if ($request->hasFile('imagen_portada')) {
//     // 1. Subir archivo
//     $path = $request->file('imagen_portada')->store('portadas_proyectos', 'public');
    
//     // 2. Buscar si ya tenía portada en la tabla de documentos (ej: tipo 1 = portada)
//     $documento = $proyecto->documentos()->where('tipo', 1)->first();

//     if ($documento) {
//         // Borrar archivo físico viejo
//         \Storage::delete($documento->url);
//         // Actualizar registro
//         $documento->update(['url' => $path]);
//     } else {
//         // Crear nuevo registro
//         $proyecto->documentos()->create([
//             'url' => $path,
//             'tipo' => 1 // Portada
//         ]);
//     }
// }

                $proyecto->tecnologias()->sync($request->input('tecnologias', []));
            });

            return redirect()
                ->route('panel.proyectos.listar')
                ->with('success', 'El proyecto se actualizó correctamente.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'No se encontró el proyecto o no tienes permisos para editarlo.');
            
        } catch (\Exception $e) {
            Log::error("Error editando proyecto ID {$request->id}: " . $e->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error inesperado al actualizar.');
        }


    }
}
