<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;

// Rotas públicas
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/registro', [UsuarioController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'register']);
Route::get('/termos', [UsuarioController::class, 'mostrarTermos'])->name('termos');
Route::post('/concluir-cadastro', [UsuarioController::class, 'concluirCadastro'])->name('concluirCadastro');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/reativar-conta', [UsuarioController::class, 'showReactivationForm'])->name('reativar-conta');
Route::post('/reativar-conta', [UsuarioController::class, 'reactivateAccount'])->name('reativar-conta.processar');

/*Testando o Middleware isoladamente
Route::middleware(['check.user.is.active'])->group(function () {
    Route::get('/test-active', function () {
        return 'Middleware funcionando corretamente.';
    });
}); */

// Rotas protegidas
Route::middleware(['auth', 'check.user.is.active'])->group(function () {
    // Página inicial
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Configurações
    Route::prefix('configuracoes')->group(function () {
        Route::get('/', [UsuarioController::class, 'showSettings'])->name('configuracoes');
        Route::post('/salvar', [UsuarioController::class, 'updateSettings'])->name('configuracoes.salvar');
        Route::post('/desativar', [UsuarioController::class, 'deactivateProfile'])->name('configuracoes.desativar');
        Route::get('/log', [UsuarioController::class, 'viewLog'])->name('configuracoes.log');
        Route::get('/perfil/{id}/editar', [UsuarioController::class, 'editProfile'])->name('perfil.editar');
        Route::post('/perfil/{id}/editar', [UsuarioController::class, 'updateProfile'])->name('perfil.atualizar');
        Route::post('/atualizar-senha', [UsuarioController::class, 'updatePassword'])->name('configuracoes.atualizar-senha');
    });

    // Postagens
    Route::prefix('postagens')->group(function () {
        Route::post('/criar', [PostagemController::class, 'create'])->name('postagem.criar');
        Route::post('/{id}/editar', [PostagemController::class, 'edit'])->name('postagem.editar');
        Route::delete('/{id}/deletar', [PostagemController::class, 'delete'])->name('postagem.deletar');
        Route::post('/{id}/denunciar', [PostagemController::class, 'denunciar'])->name('postagem.denunciar');
    });
});
