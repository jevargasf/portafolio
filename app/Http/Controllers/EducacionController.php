<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TituloAcademico;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class EducacionController extends Controller
{
    public function formAgregarTitulo(Request $request){
        $regiones = Region::with('comunas')->get();

        return view('panel.perfil.educacion.agregar-titulo', compact('regiones'));
    }

    public function agregarTitulo(Request $request){
        $validated = $request->validate([
            'nombre_titulo'   => 'required|string|max:200',
            'institucion'     => 'required|string|max:200',
            'comuna_id'       => 'required|exists:comunas,id', // Integridad Referencial
            'fecha_inicio'    => 'required|date',
            'fecha_obtencion' => 'required|date|after_or_equal:fecha_inicio', // Lógica temporal: No puedes titularte antes de empezar
            'estado'          => 'integer'
        ], [
            'fecha_obtencion.after_or_equal' => 'La fecha de obtención debe ser posterior al inicio.'
        ]);

        // 2. OBTENCIÓN DEL PERFIL (Security: Ownership)
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->withErrors(['error' => 'Error crítico: Usuario sin perfil asociado.']);
        }

        // 3. PERSISTENCIA
        // Usamos la relación para inyectar automáticamente el perfil_id
        // Asumiendo que en tu modelo PerfilProfesional tienes: public function educacion() { return $this->hasMany(TituloAcademico::class); }
        $perfil->educacion()->create($validated);

        // 4. FEEDBACK
        return redirect()
            ->route('panel.perfil.educacion.listar')
            ->with('success', 'Título académico registrado exitosamente.');
    }

    public function listarTitulos(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $titulos = TituloAcademico::orderBy('id', 'desc')->paginate($perPage);

        return view('panel.perfil.educacion.listar-titulos', compact('titulos'));
    }

    public function formEditarTitulo(Request $request){
        $perfil = Auth::user()->perfil;

        if (!$perfil) {
            return back()->with('error', 'No tienes un perfil creado.');
        }

        $titulo = $perfil->educacion()->with('comuna.region')->findOrFail($request->id);
        
        $regiones = Region::with('comunas')->get();

        return view('panel.perfil.educacion.editar-titulo', compact('titulo', 'regiones'));

    }

    public function editarTitulo(Request $request){
        $titulo = TituloAcademico::findOrFail($request->id);

        if ($titulo->perfil_id !== Auth::user()->perfil->id) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para modificar este registro.');
        }

        $validated = $request->validate([
            'nombre_titulo'   => 'required|string|max:200',
            'institucion'     => 'required|string|max:200',
            'comuna_id'       => 'required|exists:comunas,id', // Integridad Referencial
            'fecha_inicio'    => 'required|date',
            'fecha_obtencion' => 'required|date|after_or_equal:fecha_inicio', // Lógica temporal: No puedes titularte antes de empezar
            'estado'          => 'integer'
        ], [
            'fecha_obtencion.after_or_equal' => 'La fecha de obtención debe ser posterior al inicio.'
        ]);

        $titulo->update($validated);

        return redirect()
            ->route('panel.perfil.educacion.listar')
            ->with('success', 'Título académico actualizado exitosamente.');
    }

    public function eliminarTitulo(Request $request){
        
        $titulo = TituloAcademico::findOrFail($request->id);

        
        if ($titulo->perfil_id !== Auth::user()->perfil->id) {
            abort(403, 'ACCESO DENEGADO: Intentas eliminar un registro que no te pertenece.');
        }

        // 3. EJECUCIÓN (Hard Delete)
        // Si usas SoftDeletes en el modelo, esto solo marcará 'deleted_at'.
        // Si no, lo borrará físicamente de la BD.
        $titulo->delete();

        return redirect()
            ->route('panel.perfil.educacion.listar')
            ->with('success', 'Título académico eliminado permanentemente.');
        
    }
}
