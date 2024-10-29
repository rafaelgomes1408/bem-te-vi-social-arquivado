@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Termos de Utilização</h3>

                <div class="mb-4">
                    <p>Aqui, insira os termos de utilização da plataforma. O usuário deve ler esses termos e concordar para efetuar o cadastro.</p>
                </div>

                <!-- Formulário para Concordar ou Não Concordar -->
                <form action="{{ route('concluirCadastro') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-around">
                        <!-- Botão Não Concordo -->
                        <button type="submit" name="concordo" value="nao" class="btn btn-danger">Não Concordo</button>
                        
                        <!-- Botão Concordo -->
                        <button type="submit" name="concordo" value="sim" class="btn btn-success">Concordo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
