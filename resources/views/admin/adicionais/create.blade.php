@extends('layouts.app')

@section('content')
<div class="section container">
    <div class="header-container">
        <br>
        <h4 class="inline">Adicionar Adicional</h4>
        <div class="class button-group"><a href="{{ route('admin.adicionais.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
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
        <form action="{{ route('admin.adicionais.store') }}" method="POST" class="form-container">
            @csrf
            <div class="input-field">
                <label for="nome">Nome do Adicional*</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="input-field">
                <label for="preco">Preço do Adicional</label>
                <input type="text" id="preco" name="preco" value="{{ old('preco') }}">
            </div>
            <button type="submit" class="btn-small waves-effect waves-light">Salvar</button>
        </form>
    </div>

    <!-- Botão de Ajuda Flutuante -->
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
            <i class="large material-icons">help_outline</i>
        </a>
    </div>

    <!-- Modal de Ajuda -->
    <div id="helpModal" class="modal">
        <div class="modal-content">
            <h4>Ajuda - Adicionar Adicional</h4>
            <p>Nessa seção, você pode adicionar um novo adicional preenchendo os campos abaixo:</p>
            <ul>
                <li><strong>Nome do Adicional:</strong> Informe o nome do adicional. Esse campo é obrigatório.</li>
                <li><strong>Preço do Adicional:</strong> Informe o preço do adicional no formato monetário. O valor será automaticamente formatado.</li>
                <li><strong>Salvar:</strong> Clique em "Salvar" para confirmar a adição do novo adicional.</li>
                <li><strong>Voltar:</strong> Use o botão "Voltar" para retornar à lista de adicionais.</li>
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

    $(document).ready(function() {
        // Máscara para formatação do preço na interface
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
            precoValue = precoValue.replace('R$ ', '').replace(',', '.');
            precoField.val(precoValue);
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
