<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // Método para exibir o formulário de edição de perfil
    public function editProfile($id)
    {
        // Busca o usuário pelo ID
        $usuario = Usuario::findOrFail($id);

        // Verifica se o usuário logado é o dono do perfil
        if (Auth::user()->idUsuario !== $usuario->idUsuario) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para editar este perfil.');
        }

        // Retorna a view de edição do perfil com os dados do usuário
        return view('usuario.editar', compact('usuario'));
    }

    // Método para salvar as alterações do perfil
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nomeUsuario' => 'required|string|max:50',
            'biografia' => 'nullable|string|max:250',
            'imagemPerfil' => 'nullable|image|max:2048', // Valida o upload de imagem
        ]);
    
        $usuario = Auth::user();
        $usuario->nomeUsuario = $request->input('nomeUsuario');
        $usuario->biografia = $request->input('biografia');
    
        // Lógica para lidar com o upload da imagem
        if ($request->hasFile('imagemPerfil')) {
            // Exclui a imagem antiga, se existir
            if ($usuario->imagemPerfil) {
                \Storage::delete('public/' . $usuario->imagemPerfil);
            }
    
            // Faz o upload da nova imagem
            $path = $request->file('imagemPerfil')->store('public/profile_pictures');
            $usuario->imagemPerfil = str_replace('public/', '', $path); // Salva o caminho sem "public/"
        }
    
        $usuario->save();
    
        return redirect()->route('configuracoes')->with('success', 'Perfil atualizado com sucesso.');
    }
}
