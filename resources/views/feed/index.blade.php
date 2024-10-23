@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Feed de Postagens</h1>

    <!-- Verificação se há postagens -->
    @if($postagens->isEmpty())
        <p>Nenhuma postagem encontrada.</p>
    @else
        <!-- Loop pelas postagens -->
        @foreach ($postagens as $postagem)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $postagem->usuario->nomeUsuario }}</h5>
                    <p class="card-text">{{ $postagem->conteudo }}</p>

                    <!-- Exibindo a data/hora da postagem -->
                    <p class="card-text">
                        <small class="text-muted">
                            {{ optional($postagem->dataHora)->format('d/m/Y H:i') ?? 'Data não disponível' }}
                        </small>
                    </p>

                    <!-- Botão para excluir a postagem (apenas para o dono da postagem) -->
                    @if($postagem->idUsuario === auth()->user()->idUsuario)
                        <form action="{{ route('postagem.deletar', $postagem->idPostagem) }}" method="POST" onsubmit="return confirm('Você tem certeza que deseja excluir esta postagem?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    @endif

                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
