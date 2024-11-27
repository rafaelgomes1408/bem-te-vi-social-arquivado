<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Usuario;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial do usuário ou de outro usuário.
     */
    public function index(Request $request)
    {
        // Determinar qual usuário exibir (próprio ou outro)
        $usuario = $request->has('user_id') 
            ? Usuario::where('is_ativo', true)->findOrFail($request->user_id) 
            : auth()->user();

        // Carregar postagens do usuário selecionado
        $postagens = Postagem::where('idUsuario', $usuario->idUsuario)
            ->orderBy('dataHora', 'desc')
            ->paginate(10); // Paginação de 10 postagens por página

        // Pesquisa de outros usuários (apenas usuários ativos)
        $usuarios = [];
        if ($request->has('search')) {
            $usuarios = Usuario::where('is_ativo', true)
                ->where('nomeUsuario', 'LIKE', '%' . $request->search . '%')
                ->get();
        }

        // Retorna a view com os dados do usuário, postagens e resultados da pesquisa
        return view('home', compact('usuario', 'postagens', 'usuarios'));
    }
}
