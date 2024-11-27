<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserIsActive
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
        Log::info('Middleware CheckUserIsActive iniciado.');

        $user = Auth::user();
        Log::info('Usuário autenticado:', ['user' => $user ? $user->idUsuario : 'Nenhum usuário autenticado']);

        if ($user && !$user->is_ativo) {
            Log::warning('Usuário desativado tentando acessar:', ['user_id' => $user->idUsuario]);

            // Salva o ID do usuário na sessão
            $request->session()->put('user_id_to_reactivate', $user->idUsuario);

            // Desloga o usuário e redireciona para reativação
            Auth::logout();
            Log::info('Usuário deslogado e redirecionado para reativação.');

            return redirect()->route('reativar-conta')->withErrors(['message' => 'Sua conta está desativada. Reative-a para continuar.']);
        }

        Log::info('Middleware CheckUserIsActive passou com sucesso.');

        return $next($request);
    }
}
