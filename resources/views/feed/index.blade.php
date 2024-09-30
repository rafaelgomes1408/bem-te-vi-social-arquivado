@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Feed de Postagens</h1>

    <!-- Loop pelas postagens -->
    @foreach ($postagens as $postagem)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $postagem->usuario->nomeUsuario }}</h5>
                <p class="card-text">{{ $postagem->conteudo }}</p>
                <p class="card-text"><small class="text-muted">{{ $postagem->dataHora->format('d/m/Y H:i') }}</small></p>
            </div>
        </div>
    @endforeach
</div>
@endsection
