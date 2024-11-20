<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Usuario; // Certifique-se de que o modelo Usuario está corretamente importado

class HomeController extends Controller
{
    /**
     * Exibe a página inicial do usuário ou de outro usuário.
     */
    public function index(Request $request)
    {
        // Determinar qual usuário exibir (próprio ou outro)
        $usuario = $request->has('user_id') 
            ? Usuario::findOrFail($request->user_id) 
            : auth()->user();

        // Carregar postagens do usuário selecionado
        $postagens = Postagem::where('idUsuario', $usuario->idUsuario)
            ->orderBy('dataHora', 'desc')
            ->get();

        // Pesquisa de outros usuários
        $usuarios = [];
        if ($request->has('search')) {
            $usuarios = Usuario::where('nomeUsuario', 'LIKE', '%' . $request->search . '%')->get();
        }

        // Retorna a view com os dados do usuário, postagens e resultados da pesquisa
        return view('home', compact('usuario', 'postagens', 'usuarios'));
    }
}
