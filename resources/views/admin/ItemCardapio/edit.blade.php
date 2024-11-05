@extends('layouts.app')
@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Editar Item do Cardápio</h4>
            <div class="class button-group">
                <a href="{{ route('admin.itemCardapio.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
            </div>

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
            <form action="{{ route('admin.itemCardapio.update', $itemCardapio->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
                @csrf
                @method('PUT')

                <div class="input-field">
                    <label for="nome">Nome do Item</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $itemCardapio->nome) }}">
                </div>

                <div class="input-field">
                    <label for="preco">Preço</label>
                    <input type="text" id="preco" name="preco" value="{{ old('preco', number_format($itemCardapio->preco, 2, ',', '.')) }}">
                </div>

                <div class="input-field ">
                    <label for="categoria_id"></label>
                    <select id="categoria_id" name="categoria_id">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $categoria->id == $itemCardapio->categoria_id ? 'selected':''}}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                    <label>Categoria</label>



                </div>

                <div class="input-field">
                    <label for="foto"></label>
                    <input type="file" id="foto" name="foto">
                </div>

                <!-- Exibe a imagem atual, se houver -->
                @if($itemCardapio->foto)
                    <div style="margin-top: 15px;">
                        <p>Foto Atual:</p>
                        <img src="{{ url('storage/'.$itemCardapio->foto) }}" alt="{{ $itemCardapio->nome }}" style="width: 100px; height: auto;">
                    </div>
                @endif

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
                <h4>Ajuda - Editar Item do Cardápio</h4>
                <p>Preencha ou altere os campos abaixo para atualizar o item no cardápio:</p>
                <ul>
                    <li><strong>Nome do Item:</strong> Altere o nome do item no cardápio.</li>
                    <li><strong>Preço:</strong> Insira o preço atualizado (formato automático R$ XX,XX).</li>
                    <li><strong>Categoria:</strong> Selecione uma categoria adequada.</li>
                    <li><strong>Foto:</strong> Carregue uma nova imagem, se desejar substituir a atual.</li>
                    <li><strong>Salvar:</strong> Clique para salvar as alterações.</li>
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
            margin-top: 5px;
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
            margin-left: auto;
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
