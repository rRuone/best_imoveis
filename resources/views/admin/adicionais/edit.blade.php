@extends('layouts.app')

@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Editar Adicional</h4>
            <a href="{{ route('admin.adicionais.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
        </div>
        <hr>

        <!-- Mensagens de erro -->
        @if($errors->any())
            <span style="color: #ff0000">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
            <br>
        @endif

        <div class="section container">
            <form action="{{ route('admin.adicionais.update', $adicionais->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
                @csrf
                @method('PUT')

                <div class="input-field">
                    <label for="nome">Nome do Adicional</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $adicionais->nome) }}">
                </div>

                <div class="input-field">
                    <label for="preco">Preço</label>
                    <input type="text" id="preco" name="preco" value="{{ old('preco', number_format($adicionais->preco, 2, ',', '.')) }}">
                </div>

                <button type="submit" class="btn-small waves-effect waves-light">Salvar</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
         M.AutoInit(); // Inicializar o Materialize JS

        // Máscara para formatação do preço na interface
        $(document).ready(function() {
            $('#preco').on('input', function() {
                let valor = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
                if (valor) {
                    valor = (parseInt(valor) / 100).toFixed(2).replace('.', ','); // Formata como R$ XX,XX
                    $(this).val('R$ ' + valor);
                } else {
                    $(this).val('');
                }
            });

            // Substitui vírgula por ponto ao enviar o formulário
            $('form').on('submit', function() {
                let precoField = $('#preco');
                let precoValue = precoField.val();

                // Remove o "R$ " e troca a vírgula por ponto para enviar no formato correto
                precoValue = precoValue.replace('R$ ', '').replace(',', '.');

                precoField.val(precoValue); // Atualiza o valor do campo com o formato correto
            });
        });
    </script>

    <style>
        .form-container {
            max-width: 70%;
            margin: 0 auto;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1px;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 20px;
        }

        .header-container h4 {
            margin: 1%;
        }

        .header-container .btn-small {
            margin-left: auto;
        }

        .input-field {
            margin-bottom: 20px;
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }

        .center-align {
            text-align: center;
        }
    </style>
@endsection
