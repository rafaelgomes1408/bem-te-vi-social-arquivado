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
    $postagem = Postagem::findOrFail($id);

    // Verifica se a postagem pertence ao usuário logado
    if ($postagem->idUsuario === auth()->user()->idUsuario) {
        $postagem->delete();
        return redirect()->route('feed')->with('success', 'Postagem excluída com sucesso.');
    }

    return redirect()->route('feed')->with('error', 'Você não tem permissão para excluir esta postagem.');
}

    // Função para denunciar uma postagem (por outros usuários)
    public function denunciar($id)
{
    $postagem = Postagem::findOrFail($id);

    // Lógica para registrar a denúncia (salvar em um log ou enviar uma notificação, por exemplo)
    // Aqui você pode implementar o que deseja fazer com a denúncia (registrar no banco de dados, notificar admin, etc.)
    
    return redirect()->route('feed')->with('success', 'Postagem denunciada com sucesso. Um administrador será notificado.');
}

}
