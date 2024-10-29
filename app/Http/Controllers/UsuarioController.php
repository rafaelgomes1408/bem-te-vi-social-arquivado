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
            'email' => 'required|email|unique:usuarios,email', // Verifica se o e-mail é único
            'password' => 'required|confirmed|min:8',
        ]);

        // Criação do novo usuário
        User::create([
            'nomeCompleto' => $request->nomeCompleto,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirecionamento após cadastro bem-sucedido
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Você pode fazer login.');
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
