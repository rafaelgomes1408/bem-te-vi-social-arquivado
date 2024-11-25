<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Necessário 
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // Método para exibir a página de configurações do usuário
    public function showSettings()
    {
        // Obtém o usuário autenticado
        $usuario = Auth::user();

        // Retorna a view de configurações com os dados do usuário
        return view('usuario.configuracoes', compact('usuario'));
    }

    // Método para salvar as alterações do perfil
    public function updateSettings(Request $request)
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
        $imagemPerfil = $request->file('imagemPerfil');
    
        if ($imagemPerfil && $imagemPerfil->isValid()) {
            // Exclui a imagem antiga, se existir
            if (!empty($usuario->imagemPerfil)) {
                Storage::disk('public')->delete($usuario->imagemPerfil);
            }
    
            // Gera um nome único para o arquivo e realiza o upload
            $filename = uniqid() . '.' . $imagemPerfil->getClientOriginalExtension();
            $path = $imagemPerfil->storeAs('profile_pictures', $filename, 'public');
    
            // Verifica se o upload foi bem-sucedido
            if (!$path) {
                return redirect()->route('configuracoes')
                    ->withErrors(['imagemPerfil' => 'Ocorreu um erro ao salvar a imagem.']);
            }
    
            // Atualiza o caminho da imagem no usuário
            $usuario->imagemPerfil = $path;
            \Log::info('Imagem de perfil atualizada para o usuário: ' . $usuario->idUsuario);
        } else {
            return redirect()->route('configuracoes')
                ->withErrors(['imagemPerfil' => 'Arquivo de imagem inválido.']);
        }
    }

    $usuario->save();

    return redirect()->route('configuracoes')->with('success', 'Perfil atualizado com sucesso.');
    }


    // Método para desativar o perfil do usuário
    public function deactivateProfile(Request $request)
    {
        $usuario = Auth::user();
        $usuario->is_ativo = false; // Considerando que existe a coluna 'is_ativo' no banco
        $usuario->save();

        Auth::logout();
        return redirect('/')->with('success', 'Perfil desativado com sucesso.');
    }

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

    // Método para salvar as alterações do perfil editado
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nomeUsuario' => 'required|string|max:50',
            'biografia' => 'nullable|string|max:250',
            'imagemPerfil' => 'nullable|image|max:2048', // Valida o upload de imagem
        ]);

        $usuario = Usuario::findOrFail($id);

        // Verifica se o usuário logado é o dono do perfil
        if (Auth::user()->idUsuario !== $usuario->idUsuario) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para editar este perfil.');
        }

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

        return redirect()->route('perfil.editar', $usuario->idUsuario)->with('success', 'Perfil atualizado com sucesso.');
    }
}
