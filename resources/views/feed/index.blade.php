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
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection