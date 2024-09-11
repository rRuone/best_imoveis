<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Item ao Cardápio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h4>Adicionar Novo Item ao Cardápio</h4>

        <!-- Mensagens de erro -->
        @if($errors->any())
            <div class="card-panel red lighten-4">
                <span class="red-text">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </span>
            </div>
        @endif

        <!-- Formulário para adicionar item -->
        <form action="{{ route('itemCardapio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-field">
                <label for="nome">Nome do Item</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="input-field">
                <label for="preco">Preço</label>
                <input type="text" id="preco" name="preco" value="{{ old('preco') }}">
            </div>

            <div class="input-field">
                <label for="categoria_id"></label>
                <select id="categoria_id" name="categoria_id">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                <label>Categoria</label>
            </div>

            <div class="input-field">
                <label for="foto"></label>
                <input type="file" id="foto" name="foto">
            </div>

            <button type="submit" class="btn">Salvar</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit(); // Inicializar o Materialize JS

        // Máscara para formatação do preço
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
        });
    </script>
</body>
</html>
