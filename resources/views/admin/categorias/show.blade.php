@extends('layouts.app')

@section('content')
<div class="section container">
    <div class="header-container">
        <br>
        <h4>Categorias</h4>
        <a href="{{ route('admin.categorias.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>
    </div>
    <hr>

    <div class="container">
        <h4 class="inline">Detalhes da Categoria: {{ $categoria->nome }}</h4>
        <table class="striped">
            <thead>
                <tr>
                    <th>Nome</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $categoria->nome }}</td>

            </tbody>
        </table>
    </div>
</div>

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

.center-align {
    text-align: center; /* Centraliza o conteúdo */
}
</style>
@endsection
