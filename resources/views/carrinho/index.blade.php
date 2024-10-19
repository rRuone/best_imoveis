@extends('admin.layouts.principal')

@section('conteudo-principal')

    <div class="container">
        <div class="header-container">
            <h4 class="inline">Seu Carrinho</h4>
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
        
                    {{-- Componente Livewire para controle de quantidade --}}
                    <livewire:carrinho-item :index="$index" />
        
                    <div style="position: absolute; top: 10px; right: 10px;">
                            <form action="{{ route('carrinho.remover', $index) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-floating waves-effect waves-light red"><i class="material-icons">clear</i></button>
                            </form>
                    </div>
                    </div>
                </div>
            @endforeach
        @endif
        {{-- Para avançar para o próximo passo (formulário) --}}
        <form action="{{ route('carrinho.avancar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-small waves-effect waves-light green inline">Avançar</button>
        </form>
    </div>

@endsection
