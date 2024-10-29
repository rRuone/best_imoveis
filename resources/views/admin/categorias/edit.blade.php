@extends('layouts.app')

@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Editar Categoria</h4>
            <a href="{{ route('admin.categorias.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        M.AutoInit(); // Inicializar o Materialize JS
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
