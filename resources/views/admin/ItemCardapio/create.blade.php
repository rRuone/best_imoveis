@extends('layouts.app')
@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Adicionar Item ao Cardápio</h4>
            <a href="{{ route('admin.itemCardapio.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
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
            <form action="{{ route('admin.itemCardapio.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
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

                <button type="submit" class="btn-small waves-effect waves-light">Salvar</button>
            </form>
        </div>

        <!-- Floating Help Button -->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
                <i class="large material-icons">help_outline</i>
            </a>
        </div>

        <!-- Help Modal -->
        <div id="helpModal" class="modal">
            <div class="modal-content">
                <h4>Ajuda - Adicionar Item ao Cardápio</h4>
                <p>Aqui você pode preencher as informações para adicionar um novo item ao cardápio:</p>
                <ul>
                    <li><strong>Nome do Item:</strong> Nome do item a ser exibido no cardápio.</li>
                    <li><strong>Preço:</strong> Insira o preço do item (o campo aplicará automaticamente a máscara de R$ XX,XX).</li>
                    <li><strong>Categoria:</strong> Escolha uma categoria que melhor represente o item.</li>
                    <li><strong>Foto:</strong> Opcionalmente, adicione uma foto do item. O upload é feito automaticamente ao enviar o formulário.</li>
                    <li><strong>Salvar:</strong> Clique em “Salvar” para adicionar o item ao cardápio.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close btn grey">Fechar</a>
            </div>
        </div>
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

    <style>
        .form-container {
            max-width: 70%;
            margin: 0 auto;
        }

        .header-container {
            display: flex;
            align-items: center; /* Alinha verticalmente ao centro */
            justify-content: space-between; /* Espaça igualmente entre os itens */
            margin-bottom: 1px; /* Espaço abaixo do cabeçalho */
        }

        hr {
            margin-top: 5px; /* Diminui o espaço acima do hr */
            margin-bottom: 20px; /* Espaço abaixo do hr */
        }

        .header-container h4 {
            margin: 1%; /* Remove margem padrão do título */
        }

        .header-container .btn-small {
            margin-left: auto; /* Alinha o botão à direita */
        }

        .input-field {
            margin-bottom: 20px; /* Espaço entre os campos do formulário */
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }

        .fixed-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
        }
    </style>
@endsection
