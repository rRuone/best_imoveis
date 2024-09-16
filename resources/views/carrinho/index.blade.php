@extends('admin.layouts.principal')

@section('conteudo-principal')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h4>Carrinho</h4>

        {{-- Verifica se o pedido está vazio --}}
        @if(empty($pedido))
            <p>Seu carrinho está vazio.</p>
        @else
            {{-- Itera sobre cada item do pedido --}}
            @foreach($pedido as $index => $item)
            <div class="card">
                <div class="card-content">
                    @if(isset($item['item_cardapio']))
                        <span class="card-title">{{ $item['item_cardapio']->nome }}</span>
                        <p>R$ {{ number_format($item['item_cardapio']->preco, 2, ',', '.') }}</p>
                    @else
                        <p>Item do cardápio não encontrado.</p>
                    @endif
            
                    @if(!empty($item['adicionais']))
                        <h5>Adicionais:</h5>
                        <ul>
                            @foreach($item['adicionais'] as $adicional)
                                <li>{{ $adicional['nome'] }}</li>
                            @endforeach
                        </ul>
                    @endif
            
                    {{-- <!-- Botões de incremento e decremento -->
                    <div class="input-field col s12">
                        <button class="btn increment" data-id="{{ $item['id'] }}">+</button>
                        <span class="quantity" data-id="{{ $item['id'] }}">{{ $item['quantidade'] }}</span>
                        <button class="btn decrement" data-id="{{ $item['id'] }}">-</button>
                    </div> --}}
                </div>
            </div>
            
            @endforeach
        @endif

        {{-- Link para avançar para o próximo passo --}}
        <a href="{{ route('cliente.create') }}" class="btn waves-effect waves-light">Avançar</a>
    </div>

    {{-- <script>
    $(document).ready(function() {
    $('.increment').on('click', function() {
        updateQuantity($(this).data('id'), 'increment');
    });

    $('.decrement').on('click', function() {
        updateQuantity($(this).data('id'), 'decrement');
    });

    function updateQuantity(itemId, action) {
        $.ajax({
            url: '{{ route('carrinho.update') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                item_id: itemId,
                action: action
            },
            success: function(response) {
                if (response.newQuantity !== undefined) {
                    $('span.quantity[data-id="' + itemId + '"]').text(response.newQuantity);
                } else {
                    alert('Erro ao atualizar a quantidade.');
                }
            },
            error: function(xhr) {
                alert('Erro ao atualizar a quantidade.');
            }
        });
    }
});

    </script> --}}
</body>
</html>
@endsection
