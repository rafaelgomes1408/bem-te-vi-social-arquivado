<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// Rotas protegidas
Route::middleware(['auth'])->group(function () {
    // Página inicial
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Configurações
    Route::prefix('configuracoes')->group(function () {
        Route::get('/', [UsuarioController::class, 'showSettings'])->name('configuracoes');
        Route::post('/salvar', [UsuarioController::class, 'updateSettings'])->name('configuracoes.salvar');
        Route::post('/configuracoes/desativar', [UsuarioController::class, 'deactivateProfile'])->name('configuracoes.desativar');
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

// Nova rota para administradores
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/denuncias', [AdminController::class, 'listarDenuncias'])->name('admin.denuncias');
    Route::post('/postagem/{id}/excluir', [AdminController::class, 'excluirPostagem'])->name('admin.excluirPostagem');
    Route::get('/usuarios', [AdminController::class, 'listarUsuarios'])->name('admin.usuarios');
    Route::post('/usuario/{id}/bloquear', [AdminController::class, 'bloquearUsuario'])->name('admin.bloquearUsuario');
    Route::post('/usuario/{id}/desbloquear', [AdminController::class, 'desbloquearUsuario'])->name('admin.desbloquearUsuario');
    Route::post('/administrador/adicionar', [AdminController::class, 'adicionarAdministrador'])->name('admin.adicionarAdministrador');
});


