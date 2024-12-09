<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle($request, Closure $next)
{
    Log::info('Middleware AdminMiddleware chamado.', ['user_id' => Auth::id()]);
    
    if (Auth::check() && Auth::user()->is_admin) {
        Log::info('Acesso permitido para administrador.', ['user_id' => Auth::id()]);
        return $next($request);
    }

    Log::warning('Acesso negado para usuário.', [
        'user_id' => Auth::id(),
        'is_admin' => Auth::user()->is_admin ?? null,
    ]);

    return redirect('/home')->withErrors('Acesso negado: apenas administradores podem acessar.');
}
}

