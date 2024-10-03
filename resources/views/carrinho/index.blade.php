@extends('admin.layouts.principal')

@section('conteudo-principal')
    
    <div class="container">
        <div class="header-container">
            {{-- <a href="{{ route('home.index') }}" class=" waves-effect waves-light">
                <i class="material-icons black-text">arrow_back</i>
            </a> --}}
            <h4 class="inline">Detalhes do Pedido</h4>
        </div>
        <hr>
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

         {{-- Link para avançar para o próximo passo (formulário) --}}
         <form action="{{ route('carrinho.avancar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-small waves-effect waves-light gren inline">Avançar</button>
        </form>

        
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

@endsection
