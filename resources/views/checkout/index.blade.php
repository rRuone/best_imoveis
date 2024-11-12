@extends('admin.layouts.principal')

@section('conteudo-principal')

<style>
    .header-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        
    }

    .header-container a {
        margin-right: 10px; /* Espaço menor para mobile */
    }

    .header-container h4 {
        margin: 0;
    }

    .header-container i {
        font-size: 24px;
        vertical-align: middle;
    }

    /* Estilos adicionais para dispositivos móveis */
    @media (max-width: 600px) {
        .header-container {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-full-width {
            width: 100% !important;
            margin-top: 10px;
        }
    }

    @media (min-width: 601px) {
        .btn-fixed-width {
            width: 300px;
        }
    }
</style>
    <div class="container">

        @if(empty($pedido))
            <p>Seu carrinho está vazio.</p>
        @else
        
        @foreach ($pedido as $item)
            {{-- <h3>{{ $item['item_cardapio']->nome }} - R$ {{ number_format($item['item_cardapio']->preco, 2, ',', '.') }}</h3> --}}
        @endforeach

        
        <div class="header-container">
            <a href="{{ route('carrinho.index') }}" class="waves-effect waves-light">
                <i class="material-icons black-text">arrow_back</i>
            </a>
            <h4 class="inline">Finalizar Pedido</h4>
            
        </div>
        <hr>
           

         @livewire('endereco-selecionado', ['enderecos' => $enderecos])
                    
            

            {{-- Método de pagamento --}}
            <div class="row">
                <div class="collection mb-0 grey lighten-3">
                    <h5 class="h5-header">Método de pagamento:</h5>
                    @livewire('metodo-pagamento')
                </div>
            </div>

            {{-- Formulário para finalizar o pedido --}}
            @livewire('finalizar-pedido')

            
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
