@extends('admin.layouts.principal')

@section('conteudo-principal')

    <div class="container">
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
                    <h5>Seu carrinho está vazio.</h5>
                    <p>Adicione itens ao seu carrinho para começar.</p>
                </div>
            @endif
        </div>
        
        {{-- Para avançar para o próximo passo (formulário) --}}
        <form action="{{ route('carrinho.avancar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-small waves-effect waves-light green inline">Avançar</button>
        </form>
    </div>

@endsection
