<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PerfilProfesional;
use App\Models\DocumentoProfesional;
use App\Models\LinkRedSocial;
use Illuminate\Support\Facades\Log;

class PerfilController extends Controller
{
    public function formEditarPerfil() {
        /** @var \App\Models\Usuario $usuario */
        $usuario = Auth::user();
        
        $perfil = $usuario->perfil()->with(['redesSociales', 'experiencias', 'educacion', 'documentos'])->first();
        
        return view('portafolio.perfil.editar-perfil', compact('usuario', 'perfil'));
    }

public function editarPerfil(Request $request){
        $validated = $request->validate([
            'ocupacion'       => 'nullable|string|max:200',
            'telefono'        => 'nullable|string|max:9',
            'biografia'       => 'nullable|string',
            'esta_disponible' => 'nullable', // Viene como "1" o null (checkbox)
            
            // Archivos
            'foto_perfil'     => 'nullable|image|max:2048', // JPG/PNG, Máx 2MB
            'archivo_cv'      => 'nullable|file|mimes:pdf|max:5120', // PDF, Máx 5MB
            
            // Redes Sociales (Array)
            'redes'           => 'nullable|array',
            'redes.linkedin'  => 'nullable|url|max:255',
            'redes.github'    => 'nullable|url|max:255',
        ]);

        try {
            $user = Auth::user();

            DB::transaction(function () use ($request, $user, $validated) {
                $perfil = PerfilProfesional::updateOrCreate(
                    ['usuario_id' => $user->id],
                    [
                        'ocupacion'       => $validated['ocupacion'],
                        'telefono'        => $validated['telefono'],
                        'biografia'       => $validated['biografia'],
                        'esta_disponible' => $request->has('esta_disponible') ? 1 : 0,
                        'estado'          => 1 // Activo por defecto
                    ]
                );

                if ($request->hasFile('foto_perfil')) {
                    $this->guardarDocumento(
                        $request->file('foto_perfil'), 
                        $perfil->id, 
                        'es_foto_perfil', 
                        'fotos_perfil'
                    );
                }

                if ($request->hasFile('archivo_cv')) {
                    $this->guardarDocumento(
                        $request->file('archivo_cv'), 
                        $perfil->id, 
                        'es_cv', 
                        'curriculums'
                    );
                }

                if ($request->has('redes')) {
                    foreach ($request->redes as $nombreRed => $url) {
                        // Si la URL viene vacía, la ignoramos o podríamos borrar el registro
                        if (empty($url)) {
                             // Opcional: Borrar si el usuario limpió el input
                             LinkRedSocial::where('perfil_id', $perfil->id)
                                          ->where('nombre_red', ucfirst($nombreRed))
                                          ->delete();
                             continue;
                        }

                        LinkRedSocial::updateOrCreate(
                            [
                                'perfil_id'  => $perfil->id,
                                'nombre_red' => ucfirst($nombreRed) // 'linkedin' -> 'Linkedin'
                            ],
                            [
                                'url'         => $url,
                                'icono_class' => $this->obtenerIconoRed($nombreRed),
                                'estado'      => 1
                            ]
                        );
                    }
                }

            });

            return back()->with('success', 'Tu perfil profesional ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error("Error actualizando perfil usuario {$user->id}: " . $e->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al guardar los cambios.');
        }
    }

    private function guardarDocumento($file, $perfilId, $columnaFlag, $carpetaStorage)
    {
        // A. Metadatos
        $nombreOriginal = $file->getClientOriginalName();
        $extension      = $file->getClientOriginalExtension();
        $hashArchivo    = hash_file('sha256', $file->getRealPath());

        // B. Buscar documento anterior de ese tipo (Foto o CV)
        $docAnterior = DocumentoProfesional::where('perfil_id', $perfilId)
                        ->where($columnaFlag, 1)
                        ->first();

        // C. Limpieza previa
        if ($docAnterior) {
            if (Storage::disk('public')->exists($docAnterior->ruta_archivo)) {
                Storage::disk('public')->delete($docAnterior->ruta_archivo);
            }
            $docAnterior->delete();
        }

        // D. Guardar nuevo archivo físico
        $rutaGuardada = $file->store($carpetaStorage, 'public');

        // E. Guardar en Base de Datos
        DocumentoProfesional::create([
            'perfil_id'      => $perfilId,
            'nombre_archivo' => $nombreOriginal,
            'ruta_archivo'   => $rutaGuardada,
            'extension'      => $extension,
            'hash_archivo'   => $hashArchivo,
            'es_cv'          => ($columnaFlag === 'es_cv') ? 1 : 0,
            'es_foto_perfil' => ($columnaFlag === 'es_foto_perfil') ? 1 : 0,
            'estado'         => 1
        ]);
    }

    private function obtenerIconoRed($red)
    {
        return match(strtolower($red)) {
            'linkedin' => 'ri-linkedin-fill', // O 'fab fa-linkedin' según tu librería
            'github'   => 'ri-github-fill',
            default    => 'ri-link'
        };
    }
}
