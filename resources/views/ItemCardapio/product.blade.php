<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Adicionais</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .card {
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
        }
        .card-image img {
            height: 150px;
            object-fit: cover;
        }
        .form-container {
            margin-top: 20px;
        }
        .btn-container {
            margin-top: 20px;
            text-align: right; /* Alinha o botão à direita */
        }
        .input-field {
            margin-bottom: 10px; /* Espaçamento entre os adicionais */
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Detalhes do produto</h4>

        <div class="card">
            <div class="card-image">
                @if($itemCardapio->foto)
                    <img src="{{ url("storage/{$itemCardapio->foto}") }}" alt="{{ $itemCardapio->nome }}">
                @else
                    <img src="https://via.placeholder.com/300x150" alt="Sem Foto">
                @endif
            </div>
            <div class="card-content">
                <span class="card-title">{{ $itemCardapio->nome }}</span>
                <p>R$ {{ number_format($itemCardapio->preco, 2, ',', '.') }}</p>
                <p>{{ $itemCardapio->descricao }}</p>
            </div>
        </div>

        <form action="{{ route('itemCardapio.salvarAdicionais', $itemCardapio) }}" method="POST" class="form-container">
            @csrf

            {{-- <h5>Escolha Adicionais</h5>  --}}
            @foreach($adicionais as $adicional)
                <div class="input-field">
                    <label>
                        <input type="checkbox" name="adicionais[]" value="{{ $adicional->id }}" />
                        <span>{{ $adicional->nome }}</span>
                    </label>
                    <br>
                </div>
            @endforeach

            <div class="btn-container">
                <button class="btn waves-effect waves-light" type="submit">Avançar</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
