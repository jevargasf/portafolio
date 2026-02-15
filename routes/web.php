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
use Illuminate\Support\Facades\Config;

// ==========================================
// LECTURA DE ENTORNOS
// ==========================================
// Capturamos el dominio del blog desde el .env
// Si por alguna razón no existe en el .env, usamos el de producción por defecto
$dominioBlog = env('BLOG_DOMAIN', 'lohumanoquemequeda.eu.org');

// ==========================================
// GRUPO 1: BLOG EXTERNO (Dominio Dinámico)
// ==========================================
Route::domain($dominioBlog)->group(function () {
    Route::get('/', [PublicBlogController::class, 'index']);
    Route::get('/{slug}', [PublicBlogController::class, 'mostrarEntrada']);
});


// ==========================================
// GRUPO 2: PORTAFOLIO PROFESIONAL (Fallback General)
// ==========================================
// Al no envolver esto en un Route::domain(), Laravel responderá automáticamente
// a javiervargas.test (en tu PC), javiervargas.cl y www.javiervargas.cl (en Prod).

// GUEST (Login)
Route::middleware('guest')->group(function () {

    $rutaSecreta = Config::get('app.login_route');

    Route::get($rutaSecreta, [AuthController::class, 'formLogin'])->name('login');
    Route::post($rutaSecreta, [AuthController::class, 'login']);
});

// RUTA DE REDIRECCIÓN / INICIO GENERAL
Route::get('/inicio', [AuthController::class, 'inicio'])->middleware('auth')->name('inicio');

// GRUPO AUTENTICADO
Route::middleware('auth')->group(function () {
    Route::get('/seleccionar-perfil', [AuthController::class, 'formSeleccionarPerfil'])->name('auth.form-seleccionar-perfil');
    Route::post('/seleccionar-perfil', [AuthController::class, 'seleccionarPerfil'])->name('auth.seleccionar-perfil');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ZONA A: ADMINISTRADOR
    Route::prefix('admin')->name('admin.')->middleware(SoloAdmin::class)->group(function(){
        Route::get('/', [AdminController::class, 'inicio'])->name('dashboard');

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

    // ZONA B: PROFESIONAL
    Route::prefix('panel')->name('panel.')->group(function(){
        Route::get('/', [ProfesionalController::class, 'inicio'])->name('inicio');

        Route::controller(ProyectosController::class)->prefix('proyectos')->name('proyectos.')->group(function(){
            Route::get('/', 'listarProyectos')->name('listar');          
            Route::get('/obtener', 'obtenerProyecto')->name('obtener'); 
            Route::get('/crear', 'formCrearProyecto')->name('crear.form');       
            Route::post('/crear', 'crearProyecto')->name('crear');       
            Route::get('/editar', 'formEditarProyecto')->name('editar.form');       
            Route::post('/editar', 'editarProyecto')->name('editar');    
            Route::post('/eliminar', 'eliminarProyecto')->name('eliminar');
        });

        Route::prefix('perfil')->name('perfil.')->group(function(){
            Route::controller(PerfilController::class)->group(function(){
                Route::get('/obtener', 'verPerfil')->name('ver'); 
                Route::get('/editar', 'formEditarPerfil')->name('editar.form');       
                Route::put('/editar', 'editarPerfil')->name('editar');    
            });

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

        // Blog Admin
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
// ZONA C: PÚBLICA (WEB PRINCIPAL)
// ==========================================
Route::name('public.')->group(function(){
    Route::get('/', [PublicPortfolioController::class, 'index'])->name('inicio');
    Route::get('/sobre-mi', [PublicPortfolioController::class, 'verPerfil'])->name('perfil');
    Route::get('/proyectos', [PublicPortfolioController::class, 'verProyectos'])->name('proyectos');
    Route::get('/proyecto/{proyecto:slug}', [PublicPortfolioController::class, 'detalleProyecto'])->name('detalle-proyecto');
    Route::get('/descargar-cv', [PublicPortfolioController::class, 'descargarCV'])->name('descargar-cv');
    Route::get('/blog', [PublicPortfolioController::class, 'verBlog'])->name('blog');
});