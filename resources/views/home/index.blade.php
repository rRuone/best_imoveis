<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cardápio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .card {
            width: 100%;
            max-width: 300px; /* Ajuste a largura máxima conforme necessário */
            margin: 10px auto; /* Margem automática para centralizar */
        }
        .card-image img {
            height: 150px; /* Altura ajustada para tornar a imagem menor */
            object-fit: cover;
        }
    </style>
</head>
<body>
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
                                @if($item->foto)
                                    <img src="{{ url("storage/{$item->foto}") }}" alt="{{ $item->nome }}">
                                @else
                                    <img src="https://via.placeholder.com/300x150" alt="Sem Foto">
                                @endif
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{ $item->nome }}</span>
                                <p>R$ {{ number_format($item->preco, 2, ',', '.') }}</p>
                                <p>{{ $item->descricao }}</p>
                            </div>
                            <div class="card-action">
                                <a href="#">Adicionar ao Carrinho</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
