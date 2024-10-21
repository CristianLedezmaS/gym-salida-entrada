<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->tipo_usuario == 'cliente') {
            // Redirigir a los clientes fuera de la página de inicio de sesión
            if ($request->route()->getName() === 'login') {
                return redirect()->route('home');
            }
            return $next($request);
        }
        
        return $next($request);
    }
}
