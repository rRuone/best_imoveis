@extends('admin.layouts.principal')

@section('conteudo-principal')

    <style>
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .header-container a {
            margin-right: 20px;
        }

        .header-container h4 {
            margin: 0;
        }

        .card {
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
        }

        .card-image img {
            width: 70%; /* Largura total da div pai */
            height: 230px; /* Altura fixa para todas as imagens */
            object-fit: cover; /* Recorta a imagem para preencher o espaço definido */
            border-radius: 8px; /* Canto arredondado para um visual mais suave */
        }

        .form-container {
            margin-top: 20px;
        }

        .btn-container {
            margin-top: 20px;
            text-align: right;
        }

        .input-field {
            margin-bottom: 10px;
        }

        /* Layout da grade para os adicionais */
        .adicionais-container {
            display: flex;
            flex-wrap: wrap; /* Permite quebra de linha entre colunas */
            gap: 15px; /* Espaço entre os itens */
        }

        .input-field {
            flex: 1 1 48%; /* Cada item ocupa 48% da largura */
        }

   
    </style>

    <div class="container">

        <div class="header-container">
            <a href="{{ route('home.index') }}" class="waves-effect waves-light">
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

            <!-- Container para os adicionais -->
            <div class="adicionais-container">
                @php
                $adicionaisCount = count($adicionais); // Contando o total de adicionais
            @endphp
            
            <!-- Exibindo primeiros 5 adicionais -->
            @foreach(collect($adicionais)->slice(0, 5) as $adicional)
                <div class="input-field">
                    <label>
                        <input type="checkbox" name="adicionais[]" value="{{ $adicional->id }}" />
                        <span>{{ $adicional->nome }}</span>
                    </label>
                </div>
            @endforeach
            
            @if($adicionaisCount > 5)
                <!-- Exibindo adicionais restantes a partir do 6º item -->
                @foreach(collect($adicionais)->slice(5) as $adicional)
                    <div class="input-field">
                        <label>
                            <input type="checkbox" name="adicionais[]" value="{{ $adicional->id }}" />
                            <span>{{ $adicional->nome }}</span>
                        </label>
                    </div>
                @endforeach
            @endif
            </div>

            <!-- Rodapé fixo com o botão 'Avançar' -->
            <div class="footer-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #F5F5F5; border-top: 1px solid #ddd; padding: 10px 0; text-align: center; display: flex; justify-content: center; align-items: center;">
                <button type="submit" class="btn waves-effect waves-light green btn-responsive"
                    style="font-size: 1.2em; margin:0; width: 50%; justify-content: center; align-items: center;">
                    <span>Avançar</span>
                </button>
            </div>
        </form>
    </div>

@endsection
