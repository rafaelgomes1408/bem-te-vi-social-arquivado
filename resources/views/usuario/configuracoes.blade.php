@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Cabeçalho -->
    <div class="header bg-success text-white p-3 rounded mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
            <img 
                src="{{ $usuario->getImagemPerfilUrl() }}" 
                alt="Imagem de Perfil de {{ $usuario->nomeUsuario }}" 
                class="rounded-circle" 
                width="50">
                <div class="ms-3">
                    <h4>Seja Bem-vindo, {{ explode(' ', $usuario->nomeUsuario)[0] }}</h4>
                    <p>{{ Str::limit($usuario->biografia ?? 'Sem biografia disponível.', 100, '...') }}</p>
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-light"><i class="fas fa-home"></i></a>
            </div>
        </div>
    </div>

    <!-- Configurações -->
    <div class="configuracoes">
        <h3 class="mb-4">Configurações</h3>

        <!-- Formulário de edição de perfil -->
        <form action="{{ route('configuracoes.salvar') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <h5>Editar Perfil</h5>
            <div class="form-group mb-3">
                <label for="nomeUsuario">Nome</label>
                <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" value="{{ $usuario->nomeUsuario }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="biografia">Biografia</label>
                <textarea id="biografia" name="biografia" class="form-control" rows="3" maxlength="250">{{ $usuario->biografia }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="imagemPerfil">Escolha uma imagem...</label>
                <input type="file" id="imagemPerfil" name="imagemPerfil" class="form-control">
            </div>
            <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
        </form>

        <!-- Links de redefinição de senha e log 
        <div class="mb-4">
            <p>Deseja redefinir sua senha? <a href="{{ route('password.request') }}" class="text-success">Clique aqui!</a></p>
        </div>
        -->
               <!-- Redefinição de senha -->
                <div class="card mt-4">
            <div class="card-header">
                <h5>Alterar Senha</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('configuracoes.atualizar-senha') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="senha_atual" class="form-label">Senha Atual</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="senha_atual" 
                            name="senha_atual" 
                            required>
                        @error('senha_atual')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nova_senha" class="form-label">Nova Senha</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="nova_senha" 
                            name="nova_senha" 
                            required>
                        @error('nova_senha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nova_senha_confirmation" class="form-label">Confirme a Nova Senha</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="nova_senha_confirmation" 
                            name="nova_senha_confirmation" 
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Atualizar Senha</button>
                </form>
            </div>
        </div>


        <!-- Log e desativar conta -->
        <div class="d-flex justify-content-between">
            <form action="{{ route('configuracoes.log') }}" method="GET">
                <button type="submit" class="btn btn-outline-success">Abrir Log</button>
            </form>
            <form action="{{ route('configuracoes.desativar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja desativar seu perfil?')">Desativar Perfil</button>
            </form>
        </div>
    </div>
</div>
@endsection
