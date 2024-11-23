@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Cabeçalho -->
    <div class="header bg-success text-white p-3 rounded mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img 
                    src="{{ Auth::user()->imagemPerfil ? asset('storage/' . Auth::user()->imagemPerfil) : asset('images/default-profile.png') }}" 
                    alt="Imagem de Perfil" 
                    class="rounded-circle" 
                    width="50">
                <div class="ms-3">
                    <!-- Nome do usuário (primeiro nome) e biografia -->
                    <h4>Seja Bem-vindo, {{ explode(' ', Auth::user()->nomeUsuario)[0] }}</h4>
                    <p>{{ Str::limit(Auth::user()->biografia ?? 'Sem biografia disponível.', 100, '...') }}</p>
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-light me-2"><i class="fas fa-home"></i></a>
                <a href="{{ route('perfil.editar', Auth::user()->idUsuario) }}" class="btn btn-light me-2"><i class="fas fa-cog"></i></a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Feed -->
    <div class="feed">
        <!-- Área de pesquisa -->
        <div class="d-flex mb-3">
            <form action="{{ route('home') }}" method="GET" class="d-flex w-100">
                <input 
                    type="text" 
                    class="form-control me-2" 
                    name="search" 
                    placeholder="Pesquisar usuários" 
                    value="{{ request('search') }}" 
                    aria-label="Pesquisar usuários">
                <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
            </form>
        </div>

        @if(request('search'))
            <!-- Resultados da pesquisa -->
            <h5 class="mb-3">Resultados da pesquisa para: "{{ request('search') }}"</h5>
            @if($usuarios->isEmpty())
                <p class="text-muted text-center">Nenhum usuário encontrado.</p>
            @else
                <div class="list-group mb-4">
                    @foreach ($usuarios as $usuario)
                        <a href="{{ route('home', ['user_id' => $usuario->idUsuario]) }}" class="list-group-item list-group-item-action">
                            <strong>{{ $usuario->nomeUsuario }}</strong>
                            <p class="mb-0 text-muted">{{ Str::limit($usuario->biografia ?? 'Sem biografia.', 100, '...') }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Área de postagem -->
        <div class="mb-3">
            <form action="{{ route('postagem.criar') }}" method="POST">
                @csrf
                <textarea 
                    class="form-control mb-2" 
                    name="conteudo" 
                    placeholder="Qual a sua boa mensagem de hoje?" 
                    rows="2" 
                    maxlength="250" 
                    required></textarea>
                <button type="submit" class="btn btn-success w-100">Postar</button>
            </form>
        </div>

        <!-- Lista de postagens -->
        <div class="posts">
            @if($postagens->isEmpty())
                <p class="text-muted text-center">
                    @if(auth()->user()->idUsuario === $usuario->idUsuario)
                        Você ainda não escreveu nenhuma mensagem.
                    @else
                        Este usuário ainda não escreveu nenhuma mensagem.
                    @endif
                </p>
            @else
                @foreach ($postagens as $postagem)
                    <div class="post bg-light p-3 rounded mb-3">
                        <p>{{ $postagem->conteudo }}</p>
                        <small class="text-muted">
                            Publicado em {{ $postagem->dataHora->format('d/m/Y H:i') }}
                        </small>

                        <!-- Botão de excluir postagem -->
                        @if($postagem->idUsuario === Auth::user()->idUsuario)
                            <form action="{{ route('postagem.deletar', $postagem->idPostagem) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta postagem?')">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
