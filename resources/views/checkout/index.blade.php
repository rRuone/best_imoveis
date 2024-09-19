@extends('admin.layouts.principal')

@section('conteudo-principal')
    <div class="container">

        @if(empty($pedido))
            <p>Seu carrinho está vazio.</p>
        @else
        
        @foreach ($pedido as $item)
            <h3>{{ $item['item_cardapio']->nome }} - R$ {{ number_format($item['item_cardapio']->preco, 2, ',', '.') }}</h3>
        
            @endforeach

            {{-- Exibe os endereços do cliente com checkboxes --}}
            <div class="row">
                <div class="row card-panel mb-0">
                    <h5 class="h5-header">Endereço de entrega:</h5>
                    @if($enderecos->isEmpty())
                        <a href="{{ route('admin.enderecos.create') }}" class="btn waves-effect waves-light">Adicionar Novo Endereço</a>
                    @else
                    <form action="{{ route('checkout.endereco.selecionar') }}" method="POST">
                        @csrf
                        <ul>
                            @foreach($enderecos as $endereco)
                                <li>
                                    <label>
                                        {{-- Marca o checkbox do endereço selecionado --}}
                                        <input type="radio" name="endereco_id" value="{{ $endereco->id }}"
                                            @if(session('endereco_id') == $endereco->id) checked @endif />
                                        <span>{{ $endereco->logradouro }}, {{ $endereco->bairro }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <button class="btn waves-effect waves-light" type="submit">Confirmar Endereço</button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Método de pagamento --}}
            <div class="row">
                <div class="row card-panel mb-0">
                    <h5 class="h5-header">Método de pagamento:</h5>
                    <form action="{{ route('checkout.pagamento.selecionar') }}" method="POST">
                        @csrf
                        <ul>
                            <li>
                                <label>
                                    <input type="radio" name="metodo_pagamento" value="dinheiro"
                                        @if(session('metodo_pagamento') == 'dinheiro') checked @endif />
                                    <span>Dinheiro</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="metodo_pagamento" value="cartao"
                                        @if(session('metodo_pagamento') == 'cartao') checked @endif />
                                    <span>Cartão</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="radio" name="metodo_pagamento" value="pix"
                                        @if(session('metodo_pagamento') == 'pix') checked @endif />
                                    <span>PIX</span>
                                </label>
                            </li>
                        </ul>
                        <button class="btn waves-effect waves-light" type="submit">Confirmar Método de Pagamento</button>
                    </form>
                </div>
            </div>

            {{-- Exibe o subtotal --}}
            <div class="card-panel">
                <h5 class="h5-header">Subtotal:</h5>
                <p>R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            </div>
            <hr>
            {{-- Formulário para finalizar o pedido --}}
            <div class="row">
                <div class="col s12 center-align">
                    <form action="{{ route('checkout.finalizar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="metodo_pagamento" value="{{ session('metodo_pagamento') }}">
                        <button type="submit" class="waves-effect waves-light btn btn-custom">Finalizar Pedido</button>
                    </form>
                </div>
            </div>
            
        @endif

        <style>
            .card-panel {
                margin: 0 !important; /* Remove a margem externa */
                padding: 15px; /* Ajusta o preenchimento interno */
                border: 1px solid #e0e0e0; /* Cria uma borda fina ao redor */
                border-radius: 0; /* Remove o arredondamento */
            }

            .divider {
                margin: 10px 0; /* Ajusta o espaçamento vertical da linha divisória */
            }

            .section {
                padding: 0; /* Remove preenchimento extra da section */
            }

            .h5-header {
                margin-bottom: 5px; /* Diminui a margem abaixo dos headers */
            }
        </style>
    </div>
@endsection
