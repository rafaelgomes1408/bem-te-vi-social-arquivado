@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Bem-te-vi Cadastro de Usuário</h3>

                <!-- Formulário de Cadastro de Usuário -->
                <form action="{{ route('registro') }}" method="POST">
                    @csrf

                    <!-- Campo Nome Completo -->
                    <div class="form-group mb-3">
                        <label for="nomeCompleto">Nome completo</label>
                        <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
                    </div>

                    <!-- Campo E-mail -->
                    <div class="form-group mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Campo Senha -->
                    <div class="form-group mb-3">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="password" required>
                    </div>

                    <!-- Campo Reescreva a Senha -->
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Reescreva a senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <!-- Botão Cadastrar -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection