@extends('admin.layouts.principal')

@section('conteudo-principal')
    <div class="container">
        <h4>Bem-vindo à Master Dog</h4>
        <p>Explore nosso cardápio!</p>

        @foreach($categorias as $categoria)
            <h4>{{ $categoria->nome }}</h4>
            <div class="row">
                @foreach($categoria->itensCardapio as $item)
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-image">
                                <a href="{{ route('itemCardapio.product', $item->id) }}">
                                    @if($item->foto)
                                        <img src="{{ url("storage/{$item->foto}") }}" alt="{{ $item->nome }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x150" alt="Sem Foto">
                                    @endif
                                </a>
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{ $item->nome }}</span>
                                <p>R$ {{ number_format($item->preco, 2, ',', '.') }}</p>
                                <p>{{ $item->descricao }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr>
            </div>
        @endforeach

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endsection
