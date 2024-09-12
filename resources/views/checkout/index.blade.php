@extends('admin.layouts.principal')

@section('conteudo-principal')
    <div class="container">
        <h4>Seu Pedido</h4>

        @if(empty($pedido))
            <p>Seu carrinho está vazio.</p>
        @else
            @foreach($pedido as $item)
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $item['item_cardapio']->nome }}</span>
                        <p>R$ {{ number_format($item['item_cardapio']->preco, 2, ',', '.') }}</p>

                        {{-- Se houver adicionais, exibe a lista --}}
                        @if(!empty($item['adicionais']))
                           {{-- <h5>Adicionais:</h5>
                             <ul>
                                @foreach($item['adicionais'] as $adicionalId => $adicional)
                                    <li>{{ $adicional['nome'] }} - R$ {{ number_format($adicional['preco'], 2, ',', '.') }}</li>
                                @endforeach
                            </ul> --}}
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Links para selecionar ou criar um endereço --}}
        <div class="section">
             <h5>Escolha um Endereço:</h5>
           {{-- <a href="{{ route('enderecos.index') }}" class="btn waves-effect waves-light">Escolher Endereço</a>
            <a href="{{ route('enderecos.create') }}" class="btn waves-effect waves-light">Criar Novo Endereço</a>
        </div> --}}

        {{-- Botão para finalizar o pedido --}}
        <a href="" class="btn waves-effect waves-light">Finalizar Pedido</a>
    </div>
@endsection

@section('conteudo-secundario')
    {{-- Aqui você pode adicionar conteúdo secundário se necessário --}}
@endsection
