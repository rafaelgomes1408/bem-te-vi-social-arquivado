<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use Illuminate\Support\Facades\Auth;

class PostagemController extends Controller
{
    // Função para criar uma nova postagem
    public function create(Request $request)
    {
        $request->validate([
            'conteudo' => 'required|max:250', // Limite de 250 caracteres
        ]);

        // Criação da postagem
        Postagem::create([
            'conteudo' => $request->input('conteudo'),
            'dataHora' => now(),
            'idUsuario' => Auth::user()->idUsuario, // Relaciona a postagem com o usuário logado
        ]);

        return redirect()->route('feed')->with('success', 'Postagem criada com sucesso.');
    }

    // Função para editar uma postagem existente
    public function edit(Request $request, $id)
    {
        $request->validate([
            'conteudo' => 'required|max:250', // Validação para edição
        ]);

        $postagem = Postagem::findOrFail($id);

        // Verifica se a postagem pertence ao usuário logado
        if ($postagem->idUsuario !== Auth::user()->idUsuario) {
            return redirect()->route('feed')->with('error', 'Você não tem permissão para editar esta postagem.');
        }

        // Atualização do conteúdo da postagem
        $postagem->update([
            'conteudo' => $request->input('conteudo'),
        ]);

        return redirect()->route('feed')->with('success', 'Postagem editada com sucesso.');
    }

    // Função para excluir uma postagem
    public function delete($id)
    {
        $postagem = Postagem::findOrFail($id);

        // Verifica se a postagem pertence ao usuário logado
        if ($postagem->idUsuario !== Auth::user()->idUsuario) {
            return redirect()->route('feed')->with('error', 'Você não tem permissão para excluir esta postagem.');
        }

        $postagem->delete();

        return redirect()->route('feed')->with('success', 'Postagem excluída com sucesso.');
    }

    // Função para denunciar uma postagem (por outros usuários)
    public function denunciar($id)
    {
        $postagem = Postagem::findOrFail($id);

        // Simulação de lógica para registrar denúncia
        // Exemplo: adicionar um campo `isOfensiva` ou registrar em outra tabela
        $postagem->update([
            'isOfensiva' => true,
        ]);

        return redirect()->route('feed')->with('success', 'Postagem denunciada com sucesso. Um administrador será notificado.');
    }
}
