@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Recuperação de Senha</h3>

                <!-- Exibir mensagens de erro, caso existam -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Formulário para envio do e-mail de recuperação -->
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <!-- Campo E-mail -->
                    <div class="form-group mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>

                    <!-- Botão Enviar Link de Recuperação -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Enviar Link de Recuperação</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
