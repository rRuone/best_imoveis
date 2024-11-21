@extends('layouts.app')

@section('content')
<div class="section container">
    <div class="header-container">
        <br>
        <h4>Itens do Cardápio</h4>
        <div class="class button-group"><a href="{{ route('admin.item.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a></div>
    </div>
    <hr>

    <div class="container">
        <h4 class="inline">Detalhes do Item: {{ $itemCardapio->nome }}</h4>
        <table class="striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $itemCardapio->nome }}</td>
                    <td>{{ $itemCardapio->categoria ? $itemCardapio->categoria->nome : 'Sem Categoria' }}</td>
                    <td>R$ {{ number_format($itemCardapio->preco, 2, ',', '.') }}</td>
                    <td>
                        @if($itemCardapio->foto)
                            <img src="{{ url("storage/{$itemCardapio->foto}") }}" alt="{{ $itemCardapio->nome }}" style="width: 200px; height: auto;">
                        @else
                            <p>Sem Foto</p>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
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
            <h4>Ajuda - Detalhes do Item</h4>
            <p>Nessa seção, você pode visualizar os detalhes de um item específico do cardápio:</p>
            <ul>
                <li><strong>Nome:</strong> O nome do item do cardápio que foi selecionado.</li>
                <li><strong>Categoria:</strong> A categoria à qual o item pertence.</li>
                <li><strong>Preço:</strong> O preço do item formatado em reais.</li>
                <li><strong>Foto:</strong> A imagem do item, se disponível.</li>
                <li><strong>Voltar:</strong> Use o botão "Voltar" para retornar à lista de itens do cardápio.</li>
            </ul>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close btn grey">Fechar</a>
        </div>
    </div>
</div>

<!-- Scripts do Materialize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializa todos os modais
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>

<style>
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

.table-container {
    max-width: 70%; /* Ajuste a largura máxima da tabela conforme necessário */
    margin: 0 auto; /* Centraliza o container da tabela */
}

table {
    margin: 0;
    width: 100%; /* Garante que a tabela ocupe toda a largura do container */
    border-collapse: collapse; /* Remove o espaço entre as células */
}

table th, table td {
    padding: 10px; /* Adiciona espaço interno nas células */
    font-size: 14px;
    border-bottom: 1px solid #ddd; /* Adiciona apenas linhas internas */
}

table th {
    background-color: #f5f5f5; /* Cor de fundo para o cabeçalho */
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

.center-align {
    text-align: center; /* Centraliza o conteúdo */
}
</style>
@endsection
