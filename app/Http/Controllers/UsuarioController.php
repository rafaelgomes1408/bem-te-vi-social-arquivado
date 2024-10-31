<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // Função para exibir o formulário de cadastro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Função para registrar um novo usuário
    public function register(Request $request)
    {
        // Validação dos dados de cadastro
        $request->validate([
            'nomeCompleto' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|confirmed|min:8',
        ]);
    
        // Armazena os dados do usuário na sessão temporariamente
        $request->session()->put('cadastro_temp', $request->only('nomeCompleto', 'email', 'password'));
    
        // Redireciona para a página dos Termos de Utilização
        return redirect()->route('termos');
    }
    
    // Função para exibir os Termos de Utilização
    public function mostrarTermos()
    {
        return view('auth.termos');
    }

    // Função para concluir o cadastro após aceitar os Termos de Utilização
    public function concluirCadastro(Request $request)
{
    // Verifica se o usuário concordou com os Termos de Utilização
    if ($request->input('concordo') !== 'sim') {
        // Limpa os dados temporários e redireciona para o formulário de cadastro
        $request->session()->forget('cadastro_temp');
        return redirect()->route('registro')->withErrors(['message' => 'Você precisa concordar com os Termos para se cadastrar.']);
    }

    // Recupera os dados temporários do usuário armazenados na sessão
    $dados = $request->session()->get('cadastro_temp');
    
    // Cria o usuário na tabela 'usuarios'
    \App\Models\Usuario::create([
        'nomeUsuario' => $dados['nomeCompleto'],
        'email' => $dados['email'],
        'senha' => Hash::make($dados['password']),
    ]);

    // Limpa os dados temporários da sessão
    $request->session()->forget('cadastro_temp');

    // Redireciona para a página de login com uma mensagem de sucesso
    return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Você pode fazer login.');
}

    // Função para editar o perfil do usuário
    public function editProfile(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        // Atualização dos dados do usuário
        $usuario->update($request->all());

        return redirect()->route('perfil', $id);
    }
}
