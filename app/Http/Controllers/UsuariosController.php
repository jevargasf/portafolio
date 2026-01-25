<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    private function formatearRun($run)
    {
        $run = preg_replace('/[^0-9kK]/', '', $run);
        
        if (strlen($run) < 2) return $run;

        $dv = substr($run, -1);
        $cuerpo = substr($run, 0, -1);

        // $cuerpo = number_format($cuerpo, 0, '', '.');
        return $cuerpo . '-' . strtoupper($dv);
    }

    private function validarRun($run)
    {
        if (!str_contains($run, '-')) return false;
        
        list($cuerpo, $dv) = explode('-', $run);
        
        if (!is_numeric($cuerpo)) return false;

        $cuerpo = (int)$cuerpo;
        $dv = strtoupper($dv);

        $suma = 0;
        $multiplo = 2;

        while ($cuerpo > 0) {
            $suma += ($cuerpo % 10) * $multiplo;
            $cuerpo = (int)($cuerpo / 10);
            $multiplo++;
            if ($multiplo > 7) $multiplo = 2;
        }

        $resto = $suma % 11;
        $dvCalculado = 11 - $resto;

        if ($dvCalculado == 11) $dvCalculado = '0';
        else if ($dvCalculado == 10) $dvCalculado = 'K';
        else $dvCalculado = (string)$dvCalculado;

        return $dv === $dvCalculado;
    }

    public function formCrearUsuario(Request $request){
        return view('admin.usuarios.crear-usuario');
    }

    public function crearUsuario(Request $request){
        if ($request->has('run')) {
            $runFormateado = $this->formatearRun($request->run);
            
            $request->merge(['run' => $runFormateado]);
        }
        
        $validated = $request->validate([
            'run' => [
                'required',
                'string',
                'max:10',
                'unique:usuarios,run',
                'regex:/^[0-9]+-[0-9kK]{1}$/',
                function ($attribute, $value, $fail) {
                    if (!$this->validarRun($value)) {
                        $fail('El RUN ingresado no es válido (Dígito verificador incorrecto).');
                    }
                },
            ],
            'correo' => 'required|unique:usuarios,correo|email',
            'password' => 'required|string|min:8|max:255',
            'password_rep' => 'required|same:password',
            'rol_id'           => 'required|integer|in:1,2',
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100'
        ],[
            'run.unique' => 'Este RUN ya está registrado.',
            'run.regex' => 'El formato debe ser 12.345.678-K',
            'password_rep.same' => 'Las contraseñas no coinciden.',
            'rol_id.in' => 'El rol seleccionado no es válido.'
        ]);
    
        try {
            DB::transaction(function () use ($validated) {
                
                $nuevoUsuario = Usuario::create([
                    'run'              => $validated['run'],
                    'correo'           => $validated['correo'],
                    'password'         => Hash::make($validated['password']),
                    'nombres'          => $validated['nombres'],
                    'apellido_paterno' => $validated['apellido_paterno'],
                    'apellido_materno' => $validated['apellido_materno'],
                    'rol_id'           => $validated['rol_id'],
                    'estado'           => 1
                ]);

                $nuevoUsuario->perfil()->create([
                    'estado' => 1
                ]);
            });

            return redirect()
                ->route('admin.usuarios.listar')
                ->with('success', 'Usuario y perfil creados exitosamente.');

        } catch (\Exception $e) {
            
            Log::error("Error creando usuario: " . $e->getMessage());

            $mensajeError = 'Error al guardar en base de datos.';

            if ($e instanceof \Illuminate\Database\QueryException) {
                if ($e->getCode() == '22001') {
                    $mensajeError = 'Uno de los campos excede el largo máximo permitido.';
                }
                if ($e->getCode() == '23000') {
                    $mensajeError = 'El correo o RUN ya existe en el sistema.';
                }
            }

            return back()->withInput()->withErrors(['general' => $mensajeError]);
        }
    }

    public function obtenerUsuario(Request $request){
        $request->validate(['id' => 'required|integer']);

        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $usuario
        ], 200);
    }

    public function listarUsuarios(Request $request){
        $perPage = $request->input('per_page', 10);
    
        $usuarios = Usuario::orderBy('id', 'desc')->paginate($perPage);

        return view('admin.usuarios.listar-usuarios', compact('usuarios'));
    }

    public function formEditarUsuario(Request $request){
        $request->validate(['id' => 'required|integer']);

        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return redirect()->route('usuarios.listar')->with('error', 'Usuario no encontrado');
        }

        return view('admin.usuarios.editar-usuario', [
            'usuario' => $usuario
        ]);
    }

    public function editarUsuario(Request $request){
        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'run' => [
                'required', 
                'string', 
                'unique:usuarios,run,' . $usuario->id,
                'regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]{1}$/'
            ],
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'rol_id' => 'required|integer',
            'password' => 'nullable|string|min:8|max:255', 
            'estado' => 'required|boolean'
        ]);

        $usuario->run = $validated['run'];
        $usuario->correo = $validated['correo'];
        $usuario->nombres = $validated['nombres'];
        $usuario->apellido_paterno = $validated['apellido_paterno'];
        $usuario->apellido_materno = $validated['apellido_materno'];
        $usuario->rol_id = $validated['rol_id'];
        $usuario->estado = $validated['estado'];

        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente',
            'data' => $usuario
        ], 200);
    }

    public function eliminarUsuario(Request $request){
        $usuario = Usuario::find($request->id);

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
        }

        $usuario->estado = Usuario::ESTADO_ELIMINADO;
        $usuario->save();
        $mensaje = 'Usuario desactivado correctamente';

        return response()->json([
            'success' => true,
            'message' => $mensaje
        ], 200);
    }
}
