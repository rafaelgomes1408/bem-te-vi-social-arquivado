@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>
    <form action="{{ route('perfil.atualizar', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nomeUsuario">Nome</label>
            <input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" value="{{ $usuario->nomeUsuario }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="biografia">Biografia</label>
            <textarea name="biografia" id="biografia" class="form-control" rows="3">{{ $usuario->biografia }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="imagemPerfil">Imagem de Perfil</label>
            <input type="file" name="imagemPerfil" id="imagemPerfil" class="form-control">
            @if($usuario->imagemPerfil)
                <img src="{{ asset('storage/' . $usuario->imagemPerfil) }}" alt="Imagem do Perfil" class="mt-3" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection
