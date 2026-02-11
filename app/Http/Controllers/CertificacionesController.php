<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CertificacionesController extends Controller
{
    public function formAgregarCertificacion(Request $request){

        return view('portafolio.perfil.certificaciones.agregar-certificacion');
    }

    public function agregarCertificacion(Request $request){
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'organizacion' => 'required|string|max:200',
            'numero_horas' => 'required|integer',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'url_certificado' => 'nullable|url|max:255',
            'estado' => 'required|integer' // 0: Oculto, 1: Visible
        ], [
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser posterior al inicio.'
        ]);

        // 2. OBTENCIÓN DEL PERFIL (Security: Ownership)
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->withErrors(['error' => 'Error crítico: Usuario sin perfil asociado.']);
        }

        // 3. PERSISTENCIA
        $perfil->certificaciones()->create($validated);

        // 4. FEEDBACK
        return redirect()
            ->route('panel.perfil.certificaciones.listar')
            ->with('success', 'Certificación registrada exitosamente.');
    }

    public function listarCertificaciones(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $certificaciones = Certificacion::orderBy('id', 'desc')->paginate($perPage);

        return view('portafolio.perfil.certificaciones.listar-certificaciones', compact('certificaciones'));
    }

    public function formEditarCertificacion(Request $request){
        
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->with('error', 'No tienes un perfil creado.');
        }

        $certificacion = $perfil->certificaciones()->findOrFail($request->id);

        return view('portafolio.perfil.certificaciones.editar-certificacion', compact('certificacion'));
    }

    public function editarCertificacion(Request $request){

        $perfil = Auth::user()->perfil;
    
        if (!$perfil) {
            return back()->with('error', 'No tienes un perfil profesional asociado.');
        }
        
        $certificacion = $perfil->certificaciones()->findOrFail($request->id);

        if ($certificacion->perfil_id !== Auth::user()->perfil->id) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para modificar este registro.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'organizacion' => 'required|string|max:200',
            'numero_horas' => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'url_certificado' => 'nullable|url|max:255',
            'estado' => 'required|integer|in:0,1' // 0: Oculto, 1: Visible
        ], [
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser posterior al inicio.'
        ]);

        $certificacion->update($validated);

        return redirect()
            ->route('panel.perfil.certificaciones.listar')
            ->with('success', 'Certificación actualizada exitosamente.');
    }
    
    public function eliminarCertificacion(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $usuario = Auth::user();

            if (!$usuario->perfil) {
                return back()->with('error', 'Error crítico: No tienes un perfil profesional asociado.');
            }

            $certificacion = $usuario->perfil->certificaciones()->findOrFail($request->id);
            
            $certificacion->delete();

            return redirect()
                ->route('panel.certificaciones.listar')
                ->with('success', 'La certificación ha sido eliminada.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'No se encontró la certificación o no tienes permisos para eliminarla.');

        } catch (\Exception $e) {
            Log::error("Error eliminando certificación ID {$request->id}: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al intentar eliminar la certificación.');
        }

    }
}
