<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Usuario;
use App\Models\DocumentoEntrada;

class AdminBlogController extends Controller
{
    public function formCrearEntrada(Request $request){

        return view('panel.blog.crear-entrada');
    }

    public function crearEntrada(Request $request){

        $request->merge(['slug' => Str::slug($request->slug)]);

        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:entradas,slug',
            'titulo' => 'required|string|max:255',
            'extracto' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen_portada'    => 'nullable|image|max:4096',
            'scope' => 'required|in:personal,profesional', 
            'estado' => 'required|integer',  // 1: Borrador, 2: Publicado, 9: Eliminado
            'fecha_publicacion' => 'nullable|date'
        ]);

        try {
            DB::transaction(function () use ($validated, $request) {
                
                $fechaPub = $request->input('fecha_publicacion');
                if (!$fechaPub && $validated['estado'] == 2) {
                    $fechaPub = now();
                }

                $entrada = Entrada::create([
                    'usuario_id' => Auth::id(),
                    'slug' => Str::slug($validated['slug']),
                    'titulo' => $validated['titulo'],
                    'extracto' => $validated['extracto'],
                    'contenido' => $validated['contenido'],
                    'fecha_publicacion' => $fechaPub,
                    'scope' => $validated['scope'],   // 'personal' o 'profesional'
                    'estado' => $validated['estado'],  // 1: Borrador, 2: Publicado
                ]);

                if ($request->hasFile('imagen_portada')) {
                    $file = $request->file('imagen_portada');

                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    $hashArchivo = hash_file('sha256', $file->getRealPath());

                    $rutaGuardada = $file->storeAs(
                        'blog/' . date('Y'),
                        $hashArchivo . '.' . $extension,
                        'public'
                    );

                    DocumentoEntrada::create([
                        'entrada_id'    => $entrada->id,
                        'nombre_archivo' => $nombreOriginal,
                        'ruta_archivo'   => $rutaGuardada,
                        'extension'      => $extension,
                        'hash_archivo'   => $hashArchivo,
                        'es_portada'     => 1,
                        'estado'         => 1
                    ]);
                }
            });

            return redirect()
                ->route('panel.blog.listar')
                ->with('success', 'La entrada ha sido creada exitosamente.');

        } catch (\Exception $e) {
            Log::error("Error creando entrada de blog: " . $e->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al guardar la entrada. Revisa el log.');
        }
    }

    public function listarEntradas(Request $request){
        $perPage = $request->input('per_page', 10);

        $entradas = Entrada::orderBy('id', 'desc')->paginate($perPage);
        
        return view('panel.blog.listar-entradas', compact('entradas'));
    }

    public function formEditarEntrada(Request $request){
        
        $usuario = Usuario::findOrFail(Auth::id());

        $entrada = $usuario->entradas()->findOrFail($request->id);

        return view('panel.blog.editar-entrada', compact('entrada'));
    }

    public function editarEntrada(Request $request){
        $entrada = Entrada::findOrFail($request->id);

        if ((int) $entrada->usuario_id !== (int) Auth::id()) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para modificar este registro.');
        }

        $request->merge(['slug' => Str::slug($request->slug)]);

        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:entradas,slug,' . $entrada->id,
            'titulo' => 'required|string|max:255',
            'extracto' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen_portada'    => 'nullable|image|max:4096',
            'scope' => 'required|in:personal,profesional', 
            'estado' => 'required|integer',  // 1: Borrador, 2: Publicado, 9: Eliminado
            'fecha_publicacion' => 'nullable|date'
        ]);

        try {
            DB::transaction(function () use ($validated, $request, $entrada) {
                
                $fechaPub = $request->input('fecha_publicacion');
                if (!$fechaPub && $validated['estado'] == 2) {
                    $fechaPub = $entrada->fecha_publicacion ?? now();
                }
                

                $entrada->update([
                    'slug' => $validated['slug'],
                    'titulo' => $validated['titulo'],
                    'extracto' => $validated['extracto'],
                    'contenido' => $validated['contenido'],
                    'fecha_publicacion' => $fechaPub,
                    'scope' => $validated['scope'],   // 'personal' o 'profesional'
                    'estado' => $validated['estado'],  // 1: Borrador, 2: Publicado
                ]);

                if ($request->hasFile('imagen_portada')) {
                    $file = $request->file('imagen_portada');

                    $nombreOriginal = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    $hashArchivo = hash_file('sha256', $file->getRealPath());

                    $rutaGuardada = $file->storeAs(
                        'blog/' . date('Y'),
                        $hashArchivo . '.' . $extension,
                        'public'
                    );

                    $portadaAnterior = DocumentoEntrada::where('entrada_id', $entrada->id)
                                                ->where('es_portada', 1)
                                                ->first();

                    if ($portadaAnterior) {
                        if (Storage::disk('public')->exists($portadaAnterior->ruta_archivo)) {
                            Storage::disk('public')->delete($portadaAnterior->ruta_archivo);
                        }
                        $portadaAnterior->delete();
                    }

                    DocumentoEntrada::create([
                        'entrada_id'    => $entrada->id,
                        'nombre_archivo' => $nombreOriginal,
                        'ruta_archivo'   => $rutaGuardada,
                        'extension'      => $extension,
                        'hash_archivo'   => $hashArchivo,
                        'es_portada'     => 1,
                        'estado'         => 1
                    ]);
                }
            });

            return redirect()
                ->route('panel.blog.listar')
                ->with('success', 'La entrada ha sido modificada exitosamente.');

        } catch (\Exception $e) {
            Log::error("Error editando entrada de blog: " . $e->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al editar la entrada. Revisa el log.');
        }
    }
    
    public function eliminarEntrada(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $usuario = Usuario::findOrFail(Auth::id());

            $entrada = $usuario->entradas()->findOrFail($request->id);
            
            DB::transaction(function () use ($entrada) {

                foreach ($entrada->documentos as $doc) {
                    if (Storage::disk('public')->exists($doc->ruta_archivo)) {
                        Storage::disk('public')->delete($doc->ruta_archivo);
                    }
                }

                $entrada->delete();
            });

            return redirect()
                ->route('panel.blog.listar')
                ->with('success', 'La entrada y sus archivos asociados han sido eliminados.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'No se encontró la entrada o no tienes permisos para eliminarla.');

        } catch (\Exception $e) {
            Log::error("Error eliminando entrada ID {$request->id}: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al intentar eliminar la entrada.');
        }
    }
}
