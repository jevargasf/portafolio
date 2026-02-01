<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Middleware\SoloAdmin;

// 1. GUEST (Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 2. RUTA DE REDIRECCIÓN / INICIO GENERAL
// Esta ruta decide a dónde va el usuario según su rol (Admin o Profesional)
Route::get('/inicio', [AuthController::class, 'inicio'])->middleware('auth')->name('inicio');


// 3. GRUPO AUTENTICADO
Route::middleware('auth')->group(function () {
    Route::get('/seleccionar-perfil', [AuthController::class, 'formSeleccionarPerfil'])->middleware('auth')->name('auth.form-seleccionar-perfil');
    Route::post('/seleccionar-perfil', [AuthController::class, 'seleccionarPerfil'])->middleware('auth')->name('auth.seleccionar-perfil');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ==========================================
    // ZONA A: ADMINISTRADOR (Gestión del Sistema)
    // ==========================================
    // Aquí agrupamos todo lo que SOLO el admin puede tocar.
    // Sugerencia: Usa un Middleware 'es.admin' o verifica rol en el grupo.
    Route::prefix('admin')->name('admin.')->middleware(SoloAdmin::class)->group(function(){
        
        // Dashboard Admin
        Route::get('/', [AdminController::class, 'inicio'])->name('dashboard');

        // Gestión de Usuarios (Toda la lógica de usuarios es de Admin)
        Route::controller(UsuariosController::class)->prefix('usuarios')->name('usuarios.')->group(function(){
            Route::get('/', 'listarUsuarios')->name('listar');          
            Route::get('/obtener', 'obtenerUsuario')->name('obtener'); 
            Route::get('/crear', 'formCrearUsuario')->name('crear.form');       
            Route::post('/crear', 'crearUsuario')->name('crear');       
            Route::get('/editar', 'formEditarUsuario')->name('editar.form');       
            Route::post('/editar', 'editarUsuario')->name('editar');    
            Route::post('/eliminar', 'eliminarUsuario')->name('eliminar');
        });
    });

    // ==========================================
    // ZONA B: PROFESIONAL / GESTIÓN (La App)
    // ==========================================
    Route::prefix('panel')->name('panel.')->group(function(){
        
        // Dashboard del Profesional (Opcional, si tienen uno propio)
        Route::get('/', [ProfesionalController::class, 'inicio'])->name('inicio');

        // Gestión de Proyectos
        Route::controller(ProyectosController::class)->prefix('proyectos')->name('proyectos.')->group(function(){
            Route::get('/', 'listarProyectos')->name('listar');          
            Route::get('/obtener', 'obtenerProyecto')->name('obtener'); 
            Route::get('/crear', 'formCrearProyecto')->name('crear.form');       
            Route::post('/crear', 'crearProyecto')->name('crear');       
            Route::get('/editar', 'formEditarProyecto')->name('editar.form');       
            Route::post('/editar', 'editarProyecto')->name('editar');    
            Route::post('/eliminar', 'eliminarProyecto')->name('eliminar');
        });

        // Perfil Personal
        Route::controller(PerfilController::class)->prefix('perfil')->name('perfil.')->group(function(){
            Route::get('/obtener', 'verPerfil')->name('ver'); 
            // Route::get('/crear', 'formCrearPerfil')->name('crear.form');       
            // Route::post('/crear', 'crearPerfil')->name('crear');       
            Route::get('/editar', 'formEditarPerfil')->name('editar.form');       
            Route::put('/editar', 'editarPerfil')->name('editar');    
            // Route::post('/eliminar', 'eliminarPerfil')->name('eliminar');        
        });
    });

});