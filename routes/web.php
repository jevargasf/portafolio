<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificacionesController;
use App\Http\Controllers\EducacionController;
use App\Http\Controllers\ExperienciasLaboralesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Middleware\SoloAdmin;


// ==========================================
// GRUPO 1: PORTAFOLIO PROFESIONAL
// ==========================================
Route::domain('javiervargas.test')->group(function () {

    // GUEST (Login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // RUTA DE REDIRECCIÓN / INICIO GENERAL
    Route::get('/inicio', [AuthController::class, 'inicio'])->middleware('auth')->name('inicio');


    // GRUPO AUTENTICADO
    Route::middleware('auth')->group(function () {
        Route::get('/seleccionar-perfil', [AuthController::class, 'formSeleccionarPerfil'])->middleware('auth')->name('auth.form-seleccionar-perfil');
        Route::post('/seleccionar-perfil', [AuthController::class, 'seleccionarPerfil'])->middleware('auth')->name('auth.seleccionar-perfil');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // ==========================================
        // ZONA A: ADMINISTRADOR (Gestión de Usuarios y Configuraciones Globales del Sistema)
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
            Route::prefix('perfil')->name('perfil.')->group(function(){
                Route::controller(PerfilController::class)->group(function(){
                    Route::get('/obtener', 'verPerfil')->name('ver'); 
                    // Route::get('/crear', 'formCrearPerfil')->name('crear.form');       
                    // Route::post('/crear', 'crearPerfil')->name('crear');       
                    Route::get('/editar', 'formEditarPerfil')->name('editar.form');       
                    Route::put('/editar', 'editarPerfil')->name('editar');    
                    // Route::post('/eliminar', 'eliminarPerfil')->name('eliminar');    
                });

                // CREAR CONTROLADORES PARA CADA TABLA
                Route::controller(ExperienciasLaboralesController::class)->prefix('experiencias')->name('experiencias.')->group(function(){
                    Route::get('/', 'listarExperiencias')->name('listar');
                    Route::get('/agregar', 'formAgregarExperiencia')->name('agregar.form');
                    Route::post('/agregar', 'agregar')->name('agregar');
                    Route::get('/editar', 'formEditarExperiencia')->name('editar.form');
                    Route::put('/editar', 'editarExperiencia')->name('editar');
                    Route::post('/eliminar', 'eliminarExperiencia')->name('eliminar'); 
                });
                
                Route::controller(EducacionController::class)->prefix('educacion')->name('educacion.')->group(function(){
                    Route::get('/', 'listarTitulos')->name('listar');
                    Route::get('/agregar', 'formAgregarTitulo')->name('agregar.form');
                    Route::post('/agregar', 'agregarTitulo')->name('agregar');
                    Route::get('/editar', 'formEditarTitulo')->name('editar.form');
                    Route::put('/editar', 'editarTitulo')->name('editar');
                    Route::post('/eliminar', 'eliminarTitulo')->name('eliminar'); 
                });
                
                Route::controller(CertificacionesController::class)->prefix('certificaciones')->name('certificaciones.')->group(function(){
                    Route::get('/', 'listarCertificaciones')->name('listar');
                    Route::get('/agregar', 'formAgregarCertificacion')->name('agregar.form');
                    Route::post('/agregar', 'agregarCertificacion')->name('agregar');
                    Route::get('/editar', 'formEditarCertificacion')->name('editar.form');
                    Route::put('/editar', 'editarCertificacion')->name('editar');
                    Route::post('/eliminar', 'eliminarCertificacion')->name('eliminar'); 
                });
            });

            // Administrador de Entradas del Blog
            Route::controller(AdminBlogController::class)->prefix('blog')->name('blog.')->group(function(){
                Route::get('/', 'listarEntradas')->name('listar');          
                Route::get('/obtener', 'obtenerEntrada')->name('obtener'); 
                Route::get('/crear', 'formCrearEntrada')->name('crear.form');       
                Route::post('/crear', 'crearEntrada')->name('crear');       
                Route::get('/editar', 'formEditarEntrada')->name('editar.form');       
                Route::put('/editar', 'editarEntrada')->name('editar');    
                Route::post('/eliminar', 'eliminarEntrada')->name('eliminar');
            });
        });
    });


    // ==========================================
    // ZONA C: PÚBLICA (La vista del portafolio)
    // ==========================================
    Route::name('public.')->group(function(){
        Route::get('/', [PublicPortfolioController::class, 'index'])->name('inicio');
        Route::get('/sobre-mi', [PublicPortfolioController::class, 'verPerfil'])->name('perfil');
        Route::get('/proyectos', [PublicPortfolioController::class, 'verProyectos'])->name('proyectos');
        Route::get('/proyecto/{proyecto:slug}', [PublicPortfolioController::class, 'detalleProyecto'])->name('detalle-proyecto');
        Route::get('/descargar-cv', [PublicPortfolioController::class, 'descargarCV'])->name('descargar-cv');
        Route::get('/blog', [PublicPortfolioController::class, 'verBlog'])->name('blog');

    });
});


// ==========================================
// GRUPO 2: VISTA PÚBLICA BLOG PERSONAL
// ==========================================
Route::domain('lohumanoquemequeda.test')->group(function () {
    
    Route::get('/', [PublicBlogController::class, 'index']);
    Route::get('/{slug}', [PublicBlogController::class, 'mostrarEntrada']);

});