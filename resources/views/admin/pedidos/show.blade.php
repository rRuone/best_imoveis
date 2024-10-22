@extends('admin.layouts.principal')

@section('conteudo-principal')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do Pedido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h4>Detalhes do Pedido #{{ $pedido->id }}</h4>

        <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
        <p><strong>Data:</strong> {{ $pedido->data_Pedido }}</p>
        <p><strong>Status:</strong> {{ $pedido->status }}</p>
        <p><strong>Método de Pagamento:</strong> {{ $pedido->metdPag }}</p>

        <h5>Itens do Pedido</h5>
        <table class="striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Preço Total</th>
                    <th>Adicionais</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->itens as $item)
                    <tr>
                        <td>{{ $item->itemCardapio->nome }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->preco * $item->quantidade, 2, ',', '.') }}</td>
                        <td>
                            @if($item->adicionais->isNotEmpty())
                                <ul>
                                    @foreach($item->adicionais as $adicional)
                                        <li>{{ $adicional->nome }} - R$ {{ number_format($adicional->preco, 2, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            @else
                                Nenhum adicional
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.pedidos') }}" class="btn waves-effect waves-light">Voltar</a>
    </div>
</body>
</html>
@endsection