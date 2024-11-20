@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Redefinir Senha</h3>

                <!-- Formulário para redefinir a senha -->
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <!-- Token de redefinição de senha -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Campo Senha -->
                    <div class="form-group mb-3">
                        <label for="password">Nova Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Campo Confirmação de Senha -->
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Confirme a Senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <!-- Botão Redefinir Senha -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Redefinir Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
