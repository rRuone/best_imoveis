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

    .header-container h4 {
        margin: 0; /* Remove a margem padrão do título */
    }

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

    <div class="container">

            <div class="header-container">
                <a href="{{ route('home.index') }}" class=" waves-effect waves-light">
                    <i class="material-icons black-text">arrow_back</i>
                </a>
                <h4 class="inline">Detalhes do Pedido</h4>
            </div>
            <hr>

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
@endsection


