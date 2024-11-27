<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Denuncia; // Importação do modelo de Denúncias
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

        return redirect()->route('home')->with('success', 'Postagem criada com sucesso.');
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
        if ($postagem->idUsuario !== auth()->user()->idUsuario) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para excluir esta postagem.');
        }

        $postagem->delete();

        return redirect()->route('home')->with('success', 'Postagem excluída com sucesso.');
    }

    // Função para denunciar uma postagem
    public function denunciar(Request $request, $id)
{
    // Validação dos dados recebidos
    $request->validate([
        'categoria' => 'required|string',
        'descricao' => 'nullable|string|max:250',
    ]);

    \Log::info('Iniciando o processo de denúncia.');

    // Obtendo os dados necessários
    $postagem = Postagem::findOrFail($id);
    $usuario = Auth::user();

    \Log::info('Dados da denúncia recebidos:', [
        'idPostagem' => $postagem->idPostagem,
        'idUsuario' => $usuario->idUsuario,
        'categoria' => $request->input('categoria'),
        'descricao' => $request->input('descricao'),
    ]);

    try {
        // Criando a denúncia
        Denuncia::create([
            'idPostagem' => $postagem->idPostagem,
            'idUsuario' => $usuario->idUsuario,
            'categoria' => $request->input('categoria'),
            'descricao' => $request->input('descricao'),
        ]);

        \Log::info('Denúncia registrada com sucesso.');

        return redirect()->back()->with('success', 'Denúncia registrada com sucesso.');
    } catch (\Exception $e) {
        \Log::error('Erro ao registrar a denúncia:', ['error' => $e->getMessage()]);
        return redirect()->back()->withErrors(['message' => 'Ocorreu um erro ao registrar sua denúncia. Tente novamente mais tarde.']);
    }
}

}
