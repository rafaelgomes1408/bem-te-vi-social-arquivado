<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController; // Adicionado o controlador de Home

// Rota para exibir o formulário de registro
Route::get('/registro', [UsuarioController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'register']);

// Rota para exibir os Termos de Utilização
Route::get('/termos', [UsuarioController::class, 'mostrarTermos'])->name('termos');

// Rota para concluir o cadastro após a aceitação dos Termos
Route::post('/concluir-cadastro', [UsuarioController::class, 'concluirCadastro'])->name('concluirCadastro');

// Rotas de recuperação de senha
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Formulário de pedido de link
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');   // Envia o link de redefinição de senha
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');  // Formulário de redefinição de senha
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');               // Processa a redefinição de senha

// Inclui todas as rotas de autenticação padrão do Laravel (login, registro, logout)
Auth::routes(['register' => false, 'reset' => false]); // 'reset' => false para evitar duplicação de rotas de reset

// Rotas que precisam de autenticação
Route::middleware('auth')->group(function () {

    // Página inicial do usuário autenticado
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rota para logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rotas de Configurações
    Route::prefix('configuracoes')->group(function () {
        Route::get('/', [UsuarioController::class, 'showSettings'])->name('configuracoes');
        Route::post('/salvar', [UsuarioController::class, 'updateSettings'])->name('configuracoes.salvar');
        Route::post('/desativar', [UsuarioController::class, 'deactivateProfile'])->name('configuracoes.desativar');
        Route::get('/log', [UsuarioController::class, 'viewLog'])->name('configuracoes.log');
        Route::get('/perfil/{id}/editar', [UsuarioController::class, 'editProfile'])->name('perfil.editar');
        Route::post('/perfil/{id}/editar', [UsuarioController::class, 'updateProfile'])->name('perfil.atualizar');
        Route::post('/configuracoes/atualizar-senha', [UsuarioController::class, 'updatePassword'])->name('configuracoes.atualizar-senha');
        Route::get('/configuracoes/log', [UsuarioController::class, 'viewLog'])->name('configuracoes.log');
        });
        
    });

    // Rotas de Postagens
    Route::prefix('postagens')->group(function () {
        Route::get('/criar', function () {
            return view('postagens.criar');
        })->name('postagem.form');
        Route::post('/criar', [PostagemController::class, 'create'])->name('postagem.criar');
        Route::post('/{id}/editar', [PostagemController::class, 'edit'])->name('postagem.editar');
        Route::delete('/{id}/deletar', [PostagemController::class, 'delete'])->name('postagem.deletar');
        Route::post('/{id}/denunciar', [PostagemController::class, 'denunciar'])->name('postagem.denunciar');
 });

