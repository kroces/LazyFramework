<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermisosActivos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // aqui pasa la magia de los permisos
        if(auth()->user() && (auth()->user()->permiso($request->route()->uri()))){
            return $next($request);
        }
        return redirect()->route("authError");
    }
}
