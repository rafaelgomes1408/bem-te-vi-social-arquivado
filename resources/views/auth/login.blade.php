@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Bem-te-vi Social - Login</h3>

                <!-- Exibir mensagens de erro de login -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulário de Login -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Campo de E-mail -->
                    <div class="form-group mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>

                    <!-- Campo de Senha -->
                    <div class="form-group mb-4">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Botão Entrar -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>

                    <!-- Links de recuperação de senha e cadastro -->
                    <div class="text-center">
                        <p>Esqueceu sua senha? <a href="{{ route('password.request') }}">Clique aqui!</a></p>
                        <p>Ainda não tem uma conta? <a href="{{ route('registro') }}">Cadastre-se!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
