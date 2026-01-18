<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function formCrearUsuario(Request $request){
        return view('admin.usuarios.crear-usuario');
    }

    public function crearUsuario(Request $request){
        $validated = $request->validate([
            'run' => ['required', 'unique:usuarios,run', 'regex:/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]{1}$/'],
            'correo' => 'required|unique:usuarios,correo|email',
            'password' => 'required|string|min:8|max:255',
            'password_rep' => 'required|same:password',
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100'
        ],[
            'run.unique' => 'Este RUN ya está registrado.',
            'run.regex' => 'El formato debe ser 12.345.678-K',
            'password_rep.same' => 'Las contraseñas no coinciden.'
        ]);

        $usuario = Usuario::create([
            'run' => $validated['run'],
            'correo' => $validated['correo'],
            'password' => Hash::make($validated['password']),
            'nombres' => $validated['nombres'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'rol_id' => 2,
            'estado'  => 1
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente'
        ], 201);
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

        return response()->json([
            'success' => true,
            'data' => $usuarios
        ], 200);
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
