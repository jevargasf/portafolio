<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tecnologia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;
use App\Models\DocumentoProyecto;

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

            if ($request->hasFile('imagen_portada')) {
                
                $file = $request->file('imagen_portada');

                $nombreOriginal = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $hashArchivo = hash_file('sha256', $file->getRealPath());

                $rutaGuardada = $file->store('proyectos', 'public');

                DocumentoProyecto::create([
                    'proyecto_id'    => $proyecto->id,
                    'nombre_archivo' => $nombreOriginal,
                    'ruta_archivo'   => $rutaGuardada,
                    'extension'      => $extension,
                    'hash_archivo'   => $hashArchivo,
                    'es_portada'     => 1,
                    'es_demo'        => 0,
                    'estado'         => 1
                ]);
            }

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

                if ($request->hasFile('imagen_portada')) {
                    $file = $request->file('imagen_portada');

                    $nombreOriginal = $file->getClientOriginalName();
                    $extension      = $file->getClientOriginalExtension();
                    $hashArchivo    = hash_file('sha256', $file->getRealPath());

                    $rutaGuardada = $file->store('proyectos', 'public');

                    $portadaAnterior = DocumentoProyecto::where('proyecto_id', $proyecto->id)
                                                ->where('es_portada', 1)
                                                ->first();

                    if ($portadaAnterior) {
                        if (Storage::disk('public')->exists($portadaAnterior->ruta_archivo)) {
                            Storage::disk('public')->delete($portadaAnterior->ruta_archivo);
                        }
                        $portadaAnterior->delete();
                    }

                    DocumentoProyecto::create([
                        'proyecto_id'    => $proyecto->id,
                        'nombre_archivo' => $nombreOriginal,
                        'ruta_archivo'   => $rutaGuardada,
                        'extension'      => $extension,
                        'hash_archivo'   => $hashArchivo,
                        'es_portada'     => 1,
                        'es_demo'        => 0,
                        'estado'         => 1
                    ]);
                }

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

    public function eliminarProyecto(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $user = Auth::user();

            $proyecto = $user->perfil->proyectos()->findOrFail($request->id);

            foreach ($proyecto->documentos as $doc) {
                if (Storage::disk('public')->exists($doc->ruta_archivo)) {
                    Storage::disk('public')->delete($doc->ruta_archivo);
                }
            }

            $proyecto->delete();

            return redirect()
                ->route('panel.proyectos.listar')
                ->with('success', 'El proyecto y sus archivos asociados han sido eliminados.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'No se encontró el proyecto o no tienes permisos para eliminarlo.');

        } catch (\Exception $e) {
            Log::error("Error eliminando proyecto ID {$request->id}: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al intentar eliminar el proyecto.');
        }
}
}
