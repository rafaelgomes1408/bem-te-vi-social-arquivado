<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Usuario;
use App\Models\Denuncia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function listarDenuncias()
    {
        $denuncias = Denuncia::with('postagem', 'usuario')->latest()->paginate(10);
        return view('admin.denuncias', compact('denuncias'));
    }

    public function excluirPostagem($id)
    {
        $postagem = Postagem::findOrFail($id);
        $postagem->delete();

        return redirect()->route('admin.denuncias')->with('success', 'Postagem excluída com sucesso.');
    }

    public function listarUsuarios()
    {
        $usuarios = Usuario::paginate(10);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function bloquearUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update(['is_ativo' => false]);

        return redirect()->route('admin.usuarios')->with('success', 'Usuário bloqueado com sucesso.');
    }

    public function desbloquearUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update(['is_ativo' => true]);

        return redirect()->route('admin.usuarios')->with('success', 'Usuário desbloqueado com sucesso.');
    }

    public function adicionarAdministrador(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
        ]);

        $usuario = Usuario::where('email', $request->email)->firstOrFail();
        $usuario->update(['is_admin' => true]);

        return redirect()->route('admin.usuarios')->with('success', 'Administrador adicionado com sucesso.');
    }
}

