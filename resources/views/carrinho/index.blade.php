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

    <div class="container" style="padding-bottom: 80px;">
        <div class="header-container">
            <a href="{{ route('home.index') }}" class="waves-effect waves-light">
                <i class="material-icons black-text">arrow_back</i>
            </a>
            <h4 class="inline">Seu Carrinho</h4>
        </div>
        <hr>
        <div>
            @if(session()->get('pedido'))
                @foreach(session()->get('pedido') as $index => $item)
                    <livewire:carrinho-item :index="$index" :key="$index" />
                @endforeach
            @else
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('home.index') }}" class="btn btn-full-width waves-effect waves-light orange darken-4">
                        Adicionar Produtos
                    </a>
                </div>
            @endif
        </div>

        @if(session()->get('pedido'))
            <div style="text-align: center; margin-top: 25px;">
                <a href="{{ route('home.index') }}"
                   class="btn btn-full-width waves-effect waves-dark orange darken-4">
                    Adicionar Mais Itens
                </a>
            </div>
        @endif
    </div>

    <livewire:carrinho-total />
@endsection
