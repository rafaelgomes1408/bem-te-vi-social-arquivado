@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Painel Administrativo</h1>
    <ul>
        <li><a href="{{ route('admin.denuncias') }}">Gerenciar Denúncias</a></li>
        <li><a href="{{ route('admin.usuarios') }}">Gerenciar Usuários</a></li>
        <li><a href="{{ route('admin.adicionarAdministrador') }}">Adicionar Administrador</a></li>
    </ul>
</div>
@endsection