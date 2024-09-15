<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h4>Seu Carrinho</h4>

        {{-- Verifica se o pedido está vazio --}}
        @if(empty($pedido))
            <p>Seu carrinho está vazio.</p>
        @else
            {{-- Itera sobre cada item do pedido --}}
            @foreach($pedido as $item)
                <div class="card">
                    <div class="card-content">
                        {{-- Verifica se o item_cardapio existe antes de tentar acessá-lo --}}
                        @if(isset($item['item_cardapio']))
                            {{-- Exibe o nome do item do cardápio --}}
                            <span class="card-title">{{ $item['item_cardapio']->nome }}</span>
                            
                            {{-- Exibe o preço formatado do item --}}
                            <p>R$ {{ number_format($item['item_cardapio']->preco, 2, ',', '.') }}</p>
                        @else
                            <p>Item do cardápio não encontrado.</p>
                        @endif

                        {{-- Verifica se há adicionais e os exibe --}}
                        {{-- @if(!empty($item['adicionais']))
                            <h5>Adicionais:</h5>
                            <ul>
                                @foreach($item['adicionais'] as $adicional)
                                   
                                    <li>{{ $adicional['nome'] }} - R$ {{ number_format($adicional['preco'], 2, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        @endif --}}
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Link para avançar para o próximo passo --}}
        <a href="{{ route('cliente.create') }}" class="btn waves-effect waves-light">Avançar</a>

    </div>
</body>
</html>
