@extends('layouts.app')

@section('content')
    <div class="section container">
        <div class="header-container">
            <br>
            <h4 class="inline">Adicionar Item ao Cardápio</h4>
            <a href="{{ route('itemCardapio.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
        </div>
        <hr>

        

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
        <div class="section container">
            <form action="{{ route('itemCardapio.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
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

.form-container{
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
            margin-top: 1px; /* Diminui o espaço acima do hr */
            margin-bottom: 20px; /* Espaço abaixo do hr */
        }

        .header-container h4 {
            margin: 1%; /* Remove margem padrão do título */
        }

        .header-container .btn-small {
            margin-left: auto; /* Alinha o botão à direita */
        }

        hr {
            margin-top: 5px; /* Diminui o espaço acima do hr */
            margin-bottom: 20px; /* Espaço abaixo do hr */
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