<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UsuariosController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function(){
        Route::get('/', 'inicio')->name('inicio');          
    });

    Route::controller(UsuariosController::class)->prefix('usuarios')->name('usuarios.')->group(function(){
        Route::get('/', 'listarUsuarios')->name('listar');          
        Route::get('/obtener', 'obtenerUsuario')->name('obtener'); 
        Route::get('/crear/form', 'formCrearUsuario')->name('crear.form');       
        Route::post('/crear', 'crearUsuario')->name('crear');       
        Route::post('/editar', 'editarUsuario')->name('editar');    
        Route::get('/editar/form', 'formEditarUsuario')->name('editar.form');       
        Route::post('/eliminar', 'eliminarUsuario')->name('eliminar');
    });

    Route::controller(ProyectosController::class)->prefix('proyectos')->name('proyectos.')->group(function(){
        Route::get('/', 'index')->name('index');       // Vista lista de proyectos
        Route::get('/crear', 'create')->name('create'); // Vista formulario crear
        Route::post('/', 'store')->name('store');      // Guardar en BD
        Route::get('/{id}/editar', 'edit')->name('edit');
    });
// });
