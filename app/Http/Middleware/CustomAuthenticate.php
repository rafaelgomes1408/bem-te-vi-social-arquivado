<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Sincroniza 'idUsuario' e 'user_id' na sessão
            session(['idUsuario' => Auth::user()->idUsuario]);
            session(['user_id' => Auth::user()->idUsuario]);  // Define 'user_id' com o valor de 'idUsuario'
        }

        return $next($request);
    }
}