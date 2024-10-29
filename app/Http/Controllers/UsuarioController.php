<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

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
        // Validação de dados
        $request->validate([
            'nomeUsuario' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:8',
        ]);

        // Criação do usuário
        Usuario::create([
            'nomeUsuario' => $request->input('nomeUsuario'),
            'email' => $request->input('email'),
            'senha' => bcrypt($request->input('senha')), // Senha criptografada
            'idPerfil' => $request->input('idPerfil'), // Perfil padrão pode ser atribuído aqui
        ]);

        return redirect()->route('login'); // Redireciona para a tela de login
    }

    // Função para editar perfil
    public function editProfile(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        // Atualização dos dados
        $usuario->update($request->all());

        return redirect()->route('perfil', $id);
    }
}
