<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('auth.login'); // Certifique-se de que a view login.blade.php esteja em resources/views/auth
    }

    public function login(Request $request)
    {
        // Validação das credenciais fornecidas pelo usuário
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentativa de login com as credenciais
        if (Auth::attempt($credentials)) {
            // Mensagem de log para login bem-sucedido
            \Log::info('Login bem-sucedido para o usuário: ' . $request->input('email'));

            // Regenerar a sessão para evitar ataques de sessão fixa
            $request->session()->regenerate();

            // Redireciona o usuário para a página inicial ou uma página protegida
            return redirect()->intended('home');
        } else {
            // Mensagem de log para falha no login
            \Log::error('Falha de login para o usuário: ' . $request->input('email'));
        }

        // Se o login falhar, redireciona de volta para a página de login com erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }

        // Método para realizar logout
        public function logout(Request $request)
        {
            // Desloga o usuário autenticado
            Auth::logout();

            // Invalida a sessão do usuário
            $request->session()->invalidate();

            // Regenera o token de sessão para evitar ataques de sessão fixa
            $request->session()->regenerateToken();

            // Redireciona o usuário para a página de login
            return redirect('/login');
    }
}
