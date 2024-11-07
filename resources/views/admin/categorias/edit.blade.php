@extends('layouts.app')

@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Editar Categoria</h4>
            <div class="class button-group">
                <a href="{{ route('admin.categorias.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
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
            <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <div class="input-field">
                    <label for="nome">Nome da Categoria</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $categoria->nome) }}">
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
                <h4>Ajuda - Edição de Categoria</h4>
                <p>Esta página permite editar o nome da categoria selecionada.</p>
                <ul>
                    <li><strong>Campo Nome:</strong> Atualize o nome da categoria no campo de texto.</li>
                    <li><strong>Salvar:</strong> Clique no botão "Salvar" para aplicar as alterações.</li>
                    <li><strong>Voltar:</strong> Use o botão "Voltar" para retornar à lista de categorias sem salvar.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close btn grey">Fechar</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa os modais
            M.Modal.init(document.querySelectorAll('.modal'));
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

        .fixed-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
        }
    </style>
@endsection
