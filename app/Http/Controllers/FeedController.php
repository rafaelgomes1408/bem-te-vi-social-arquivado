<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;

class FeedController extends Controller
{
    // Método para exibir o feed de postagens
    public function index()
    {
        // Busca todas as postagens e as ordena pela data mais recente
        $postagens = Postagem::with('usuario')->orderBy('dataHora', 'desc')->get();

        // Retorna a view com as postagens
        return view('feed.index', compact('postagens'));
    }
}
