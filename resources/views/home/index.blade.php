@extends('admin.layouts.principal')

@section('conteudo-principal')
<style>
    .card-image img {
    width: 70%; /* Largura total da div pai */
    height: 230px; /* Altura fixa para todas as imagens */
    object-fit: cover; /* Recorta a imagem para preencher o espaço definido */
    border-radius: 8px; /* Canto arredondado para um visual mais suave */
}

@media (max-width: 768px) {
    .card-image img {
        height: 200px; /* tablets */
    }
}

@media (max-width: 480px) {
    .card-image img {
        height: 150px; /*smartphones */
    }
}

</style>
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
                                <a href="{{ route('item.product', $item->id) }}">
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
