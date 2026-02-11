<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExperienciaLaboral;
use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class ExperienciasLaboralesController extends Controller
{
    public function formAgregarExperiencia(Request $request){
        $regiones = Region::with('comunas')->get();

        return view('portafolio.perfil.experiencias.agregar-experiencia', compact('regiones'));
    }

    public function agregar(Request $request){
        // 1. VALIDACIÓN (First Principles: No confiar en el input del usuario)
        $validated = $request->validate([
            'cargo'             => 'required|string|max:200',
            'organizacion'      => 'required|string|max:200',
            'comuna_id'         => 'required|exists:comunas,id', // Integridad Referencial
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_inicio', // Lógica temporal
            'es_trabajo_actual' => 'boolean',
            'descripcion'       => 'nullable|string',
            'estado'            => 'integer' // Por si lo usas para visibilidad
        ], [
            // Mensajes personalizados (Opcional, para mejor UX)
            'fecha_fin.after_or_equal' => 'La fecha de término no puede ser anterior al inicio.',
            'comuna_id.required'       => 'Debes seleccionar una comuna válida.'
        ]);

        // 2. LÓGICA DE NEGOCIO (Data Sanitization)
        // Si marcó "Es actual", forzamos fecha_fin a NULL, ignorando cualquier fecha que haya podido viajar.
        if ($request->boolean('es_trabajo_actual')) {
            $validated['fecha_fin'] = null;
        }

        // 3. ASIGNACIÓN DE AUTORÍA
        // Obtenemos el perfil del usuario logueado.
        // Asumo que tu User tiene relación hasOne('perfil')
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->withErrors(['error' => 'No se encontró un perfil asociado a este usuario.']);
        }

        // 4. PERSISTENCIA (Creación vía Relación)
        // Esto asigna automáticamente el 'perfil_id'
        $perfil->experiencias()->create($validated);

        // 5. REDIRECCIÓN CON FEEDBACK
        return redirect()
            ->route('panel.perfil.experiencias.listar') // Ajusta a tu ruta de listado
            ->with('success', 'Experiencia registrada correctamente en el sistema.');
    }

    public function listarExperiencias(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $experiencias = ExperienciaLaboral::orderBy('id', 'desc')->paginate($perPage);

        return view('portafolio.perfil.experiencias.listar-experiencias', compact('experiencias'));
    }

    public function formEditarExperiencia(Request $request){
        
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->with('error', 'No tienes un perfil creado.');
        }
    
        $experiencia = $perfil->experiencias()->with('comuna.region')->findOrFail($request->id);
        
        $regiones = Region::with('comunas')->get();

        return view('portafolio.perfil.experiencias.editar-experiencia', compact('experiencia', 'regiones'));

    }

    public function editarExperiencia(Request $request){
        
        $experiencia = ExperienciaLaboral::findOrFail($request->id);


        if ($experiencia->perfil_id !== Auth::user()->perfil->id) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para modificar este registro.');
        }

        $validated = $request->validate([
            'cargo'             => 'required|string|max:200',
            'organizacion'      => 'required|string|max:200',
            'comuna_id'         => 'required|exists:comunas,id',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_inicio',
            'es_trabajo_actual' => 'boolean', // Laravel convierte "1", "on", "true" a booleano
            'descripcion'       => 'nullable|string',
            'estado'            => 'integer'
        ], [
            'fecha_fin.after_or_equal' => 'La fecha de término no puede ser anterior al inicio.'
        ]);

        if ($request->boolean('es_trabajo_actual')) {
            $validated['fecha_fin'] = null;
        }

        $experiencia->update($validated);

        return redirect()
            ->route('panel.perfil.experiencias.listar')
            ->with('success', 'Experiencia laboral actualizada correctamente.');
        
    }

    public function eliminarExperiencia(Request $request){

        $experiencia = ExperienciaLaboral::findOrFail($request->id);

        
        if ($experiencia->perfil_id !== Auth::user()->perfil->id) {
            abort(403, 'ACCESO DENEGADO: Intentas eliminar un registro que no te pertenece.');
        }

        // 3. EJECUCIÓN (Hard Delete)
        // Si usas SoftDeletes en el modelo, esto solo marcará 'deleted_at'.
        // Si no, lo borrará físicamente de la BD.
        $experiencia->delete();

        return redirect()
            ->route('panel.perfil.experiencias.listar')
            ->with('success', 'Experiencia laboral eliminada permanentemente.');
        }
}
