<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // Método para exibir página de cadastro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Método para registrar o usuário
    public function register(Request $request)
    {
        // Validação dos dados de cadastro
        $request->validate([
            'nomeCompleto' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Armazena os dados na sessão temporariamente
        $request->session()->put('cadastro_temp', $request->only('nomeCompleto', 'email', 'password'));

        // Redireciona para a página dos Termos de Uso
        return redirect()->route('termos');
    }

    // Método para exibir a página de Termos de Uso
    public function mostrarTermos()
    {
        return view('auth.termos');
    }

    // Método para concluir o cadastro após aceitar os Termos de Uso
    public function concluirCadastro(Request $request)
    {
        if ($request->input('concordo') !== 'sim') {
            $request->session()->forget('cadastro_temp');
            return redirect()->route('registro')->withErrors(['message' => 'Você precisa concordar com os Termos para se cadastrar.']);
        }

        $dados = $request->session()->get('cadastro_temp');

        Usuario::create([
            'nomeUsuario' => $dados['nomeCompleto'],
            'email' => $dados['email'],
            'senha' => bcrypt($dados['password']),
        ]);

        $request->session()->forget('cadastro_temp');

        return redirect()->route('login')->with('success', 'Cadastro concluído com sucesso! Faça login para acessar sua conta.');
    }

    // Método para exibir a página de configurações do usuário
    public function showSettings()
    {
        $usuario = Auth::user();
        return view('usuario.configuracoes', compact('usuario'));
    }

    // Método para salvar as alterações do perfil
    public function updateSettings(Request $request)
    {
        $request->validate([
            'nomeUsuario' => 'required|string|max:50',
            'biografia' => 'nullable|string|max:250',
            'imagemPerfil' => 'nullable|image|max:2048',
        ]);

        $usuario = Auth::user();
        $usuario->nomeUsuario = $request->input('nomeUsuario');
        $usuario->biografia = $request->input('biografia');

        if ($request->hasFile('imagemPerfil')) {
            $imagemPerfil = $request->file('imagemPerfil');

            if ($imagemPerfil && $imagemPerfil->isValid()) {
                if (!empty($usuario->imagemPerfil)) {
                    Storage::disk('public')->delete($usuario->imagemPerfil);
                }

                $filename = uniqid() . '.' . $imagemPerfil->getClientOriginalExtension();
                $path = $imagemPerfil->storeAs('profile_pictures', $filename, 'public');

                if (!$path) {
                    return redirect()->route('configuracoes')->withErrors(['imagemPerfil' => 'Ocorreu um erro ao salvar a imagem.']);
                }

                $usuario->imagemPerfil = $path;
            } else {
                return redirect()->route('configuracoes')->withErrors(['imagemPerfil' => 'Arquivo de imagem inválido.']);
            }
        }

        $usuario->save();

        return redirect()->route('configuracoes')->with('success', 'Perfil atualizado com sucesso.');
    }

    // Método para desativar o perfil do usuário
    public function deactivateProfile(Request $request)
    {
        $usuario = Auth::user();
        $usuario->update(['is_ativo' => false]);
        Auth::logout();
        return redirect('/')->with('success', 'Perfil desativado com sucesso. Você pode reativar sua conta dentro de 30 dias.');
    }

    // Método para editar o perfil
    public function editProfile($id)
    {
        $usuario = Usuario::findOrFail($id);

        if (Auth::user()->idUsuario !== $usuario->idUsuario) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para editar este perfil.');
        }

        return view('usuario.editar', compact('usuario'));
    }

    // Método para trocar senha
    public function updatePassword(Request $request)
    {
        $request->validate([
            'senha_atual' => 'required',
            'nova_senha' => 'required|min:8|confirmed',
        ]);

        $usuario = Auth::user();

        if (!Hash::check($request->input('senha_atual'), $usuario->senha)) {
            return redirect()->route('configuracoes')->withErrors(['senha_atual' => 'A senha atual está incorreta.']);
        }

        $usuario->senha = bcrypt($request->input('nova_senha'));
        $usuario->save();

        return redirect()->route('configuracoes')->with('success', 'Senha atualizada com sucesso.');
    }

    // Método para exibir o log de atividades
    public function viewLog()
    {
        $usuario = Auth::user();

        $logs = [
            ['data' => now()->format('d/m/Y H:i'), 'acao' => 'Login realizado com sucesso.'],
            ['data' => now()->subDay()->format('d/m/Y H:i'), 'acao' => 'Perfil atualizado.'],
        ];

        return view('usuario.log', compact('usuario', 'logs'));
    }
}
