<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;

class PostagemController
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
            'idUsuario' => auth()->user()->idUsuario, // Relaciona a postagem com o usuário logado
        ]);

        return redirect()->route('feed'); // Redireciona para o feed
    }

    // Função para editar uma postagem existente
    public function edit(Request $request, $id)
    {
        $postagem = Postagem::find($id);

        // Atualização do conteúdo da postagem
        $postagem->update($request->all());

        return redirect()->route('home');
    }

    // Função para excluir uma postagem
    public function delete($id)
    {
        $postagem = Postagem::find($id);
        $postagem->delete();

        return redirect()->route('home');
    }
}
