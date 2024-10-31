<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FeedController;

// Rota para exibir o formulário de registro
Route::get('/registro', [UsuarioController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'register']);

// Rota para exibir os Termos de Utilização
Route::get('/termos', [UsuarioController::class, 'mostrarTermos'])->name('termos');

// Rota para concluir o cadastro após a aceitação dos Termos
Route::post('/concluir-cadastro', [UsuarioController::class, 'concluirCadastro'])->name('concluirCadastro');

// Inclui todas as rotas de autenticação padrão do Laravel (login, registro, recuperação de senha)
Auth::routes();

// Rotas que precisam de autenticação
Route::middleware('auth')->group(function () {

    // Rota protegida para a página inicial
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Rotas protegidas para perfil de usuário
    Route::get('/perfil/{id}/editar', [UsuarioController::class, 'editProfile'])->name('perfil.editar');
    Route::post('/perfil/{id}/editar', [UsuarioController::class, 'editProfile']);

    // Rota para exibir o formulário de criação de postagem (GET)
    Route::get('/postagens/criar', function () {
        return view('postagens.criar');
    })->name('postagem.form');

    // Rotas protegidas para criar, editar e deletar postagens
    Route::post('/postagens/criar', [PostagemController::class, 'create'])->name('postagem.criar');
    Route::post('/postagens/{id}/editar', [PostagemController::class, 'edit'])->name('postagem.editar');
    Route::delete('/postagens/{id}/deletar', [PostagemController::class, 'delete'])->name('postagem.deletar');
    
    // Rota para o feed de postagens
    Route::get('/feed', [FeedController::class, 'index'])->name('feed');

    // Rota para denunciar postagens (por outros usuários)
    Route::post('/postagens/{id}/denunciar', [PostagemController::class, 'denunciar'])->name('postagem.denunciar');
});
