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
    </div>
@endsection

@section('conteudo-secundario')
    {{-- Aqui você pode adicionar conteúdo secundário se necessário --}}
@endsection
