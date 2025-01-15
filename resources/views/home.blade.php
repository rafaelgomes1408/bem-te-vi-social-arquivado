@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Mensagens de erro e sucesso -->
    @if ($errors->has('custom_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('custom_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Cabeçalho -->
    <div class="header bg-success text-white p-3 rounded mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img 
                    src="{{ $usuario->getImagemPerfilUrl() }}" 
                    alt="Imagem de Perfil" 
                    class="rounded-circle" 
                    width="50">
                <div class="ms-3">
                    @if(auth()->user()->idUsuario === $usuario->idUsuario)
                        <h4>Seja bem-vindo, {{ explode(' ', $usuario->nomeUsuario)[0] }}</h4>
                    @else
                        <h4>Exibindo perfil de {{ $usuario->nomeUsuario }}</h4>
                    @endif
                    <p>{{ Str::limit($usuario->biografia ?? 'Sem biografia disponível.', 100, '...') }}</p>
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-light me-2"><i class="fas fa-home"></i></a>
                @if(auth()->user()->idUsuario === $usuario->idUsuario)
                    <a href="{{ route('configuracoes') }}" class="btn btn-light me-2"><i class="fas fa-cog"></i></a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Campo de Pesquisa -->
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
                @foreach ($usuarios as $user)
                    <a href="{{ route('home', ['user_id' => $user->idUsuario]) }}" class="list-group-item list-group-item-action">
                        <img 
                            src="{{ $user->getImagemPerfilUrl() }}" 
                            alt="Imagem de Perfil" 
                            class="rounded-circle me-2" 
                            width="30">
                        <strong>{{ $user->nomeUsuario }}</strong>
                        <p class="mb-0 text-muted">{{ Str::limit($user->biografia ?? 'Sem biografia.', 100, '...') }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    @endif

    <!-- Feed -->
    <div class="feed">
        @if(auth()->user()->idUsuario === $usuario->idUsuario)
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
        @endif

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

                        @if($postagem->idUsuario === auth()->user()->idUsuario)
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

                <div class="d-flex justify-content-center">
                    {{ $postagens->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Créditos -->
    <div class="credits text-center mt-5">
        <button class="btn btn-link text-muted" data-bs-toggle="modal" data-bs-target="#creditosModal">Créditos</button>
    </div>

    <!-- Modal de Créditos -->
    <div class="modal fade" id="creditosModal" tabindex="-1" aria-labelledby="creditosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="creditosModalLabel">Créditos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Este sistema utiliza tecnologias avançadas de PLN, incluindo os modelos BERTimbau e HateBR. Autores:</p>
                    <ul>
                        <li><strong>BERTimbau:</strong> Fábio Souza, Rodrigo Nogueira, Roberto Lotufo.</li>
                        <li><strong>HateBR:</strong> Francielle Vargas, Isabelle Carvalho, Thiago Pardo, Fabrício Benevenuto.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
