<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Si NO es admin (asumiendo que 1 es admin)
        if (auth()->check() && auth()->user()->rol_id !== 1) {
            // Opción A: Abortar con error 403 (Prohibido)
            abort(403, 'No tienes permiso para entrar aquí.');
            
            // Opción B: Redirigir al inicio
            // return redirect()->route('inicio')->with('error', 'Acceso denegado');
        }

        return $next($request);
    }
}
