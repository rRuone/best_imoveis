@extends('admin.layouts.principal')

@section('conteudo-principal')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestão de Pedidos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h4>Gestão de Pedidos</h4>

        {{-- @if($pedidos->isEmpty())
            <p>Nenhum pedido encontrado.</p>
        @else
            <table class="striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{ $pedido->data_Pedido }}</td>
                            <td>{{ $pedido->status }}</td>
                            <td>
                                <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn blue">Ver Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif --}}
    </div>
</body>
</html>
@endsection