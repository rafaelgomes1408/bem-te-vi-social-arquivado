<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FeedController;

// Rotas de registro, login e recuperação de senha (não precisam de autenticação)
Route::get('/registro', [UsuarioController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rota para recuperação de senha
Route::get('/password/reset', [LoginController::class, 'showResetForm'])->name('password.request');

// Rota para logout (precisa de autenticação)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
