@extends('admin.layouts.principal')

@section('conteudo-principal')
    <div class="container" style="padding-bottom: 80px;"> <!-- Aumente o padding inferior conforme necessário -->
        <div class="header-container">
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
                <a href="{{ route('home.index') }}" class="btn-small waves-effect waves-light green">Adicionar Produtos</a>
            </div>
            @endif
        </div>
    </div>

    <livewire:carrinho-total />

    
@endsection
