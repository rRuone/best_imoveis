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
        {{-- Links para selecionar ou criar um endereço --}}
        <div class="row">
            <!-- Primeira Div -->
            <div class="row card-panel mb-0">
                <div class="col s6">
                    <h5 class="h5-header">Selecione Endereço:</h5> 
                </div>
                <div class="col s6">
                    <a href=""><h6 class="h5-header">Novo Endereço</h6></a>
                </div>
            </div>
        
           
            
        
            <!-- Segunda Div -->
            <div class="row card-panel mb-0">
                <h5 class="h5-header">Endereço de entrega:</h5>
                
            </div>
            <div class="row card-panel mb-0">
                    Retirada
            </div>
        </div>
        
        

      
    </div>
@endsection

@section('conteudo-secundario')
    {{-- Aqui você pode adicionar conteúdo secundário se necessário --}}
@endsection
