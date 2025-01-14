@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Postagem</h1>

    <!-- Exibir mensagens de erro -->
    @if ($errors->has('custom_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('custom_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Formulário para criar uma nova postagem -->
    <form action="{{ route('postagem.criar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="conteudo">Conteúdo da Postagem:</label>
            <textarea name="conteudo" id="conteudo" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Postar</button>
    </form>
</div>
@endsection
