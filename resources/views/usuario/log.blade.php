@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Log de Acessos</h3>
    @if (empty($logs))
        <p class="text-muted">Nenhum log de acesso encontrado.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log['data'] }}</td>
                        <td>{{ $log['acao'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('configuracoes') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
