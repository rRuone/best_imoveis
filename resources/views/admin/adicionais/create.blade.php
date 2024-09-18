@extends('layouts.app')
@section('content')
<div class="section container">
    <div class="header-container">
        <br>
        <h4 class="inline">Adicionar Adicional</h4>
        <a href="{{ route('admin.adicionais.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
    </div>
    <hr>
    <div class="section container">
        
        @if($errors->any())
            <span style="color: #ff0000">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
            <br>
        @endif

        <form action="{{ route('admin.adicionais.store') }}" method="POST" class="form-container">
            @csrf
            <div class="input-field">
                <label for="nome">Nome do Adicional</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="input-field">
                <label for="preco">Preço do Adicional</label>
                <input type="text" id="preco" name="preco" value="{{ old('preco') }}">
            </div>
                <button type="submit" class="btn-small waves-effect waves-light">Salvar</button>
           
        </form>
    </div>
</div>
    <style>

        .form-container{
            max-width: 70%; 
            margin: 0 auto; 
        }

        .header-container {
            display: flex;
            align-items: center; /* Alinha verticalmente ao centro */
            justify-content: space-between; /* Espaça igualmente entre os itens */
            margin-bottom: 20px; /* Espaço abaixo do cabeçalho */
        }

        .header-container h4 {
            margin: 0; /* Remove margem padrão do título */
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

        .center-align {
            text-align: center; /* Centraliza o conteúdo */
        }
    </style>

    
@endsection
