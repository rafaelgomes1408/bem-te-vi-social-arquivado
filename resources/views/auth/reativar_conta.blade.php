@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reativar Conta</h1>
    <p>Sua conta está desativada. Deseja reativá-la?</p>

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('reativarConta') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Reativar Conta</button>
        <a href="{{ route('login') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
