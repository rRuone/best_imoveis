@extends('admin.layouts.principal')

@section('conteudo-principal')
    <style>
        .header-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px; /* Ajuste o espaço inferior conforme necessário */
        }


        .header-container a {
         margin-right: 20px; /* Espaço entre o ícone e o título */
        }

        header-container h4 {
        margin: 0; /* Remove a margem padrão do título */
        }

        .header-container i {
        font-size: 24px; /* Ajuste o tamanho do ícone conforme necessário */
        vertical-align: middle; /* Ajusta a altura da linha do ícone */
        }

    </style>


    <div class="container" style="padding-bottom: 80px;"> <!-- Aumente o padding inferior conforme necessário -->
        <div class="header-container">
            <a href="{{ route('home.index') }}" class=" waves-effect waves-light">
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
                <a href="{{ route('home.index') }}" class="btn-small waves-effect waves-light orange darken-4" style="width:790px">Adicionar Produtos</a>
            </div>
            @endif
        </div>

        @if(session()->get('pedido'))
            <div style="text-align:center; margin-top:25px">
                <a href="{{ route('home.index') }}" class="btn-small waves-effect waves-dark orange darken-4" 
                style="width:790px; color:white; background-color:transparent;">Adicionar Mais Itens</a> 
            </div>
        @endif
    </div>

    <livewire:carrinho-total />

    
@endsection
