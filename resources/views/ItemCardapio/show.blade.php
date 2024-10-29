@extends('layouts.app')

@section('content')
<div class="section container">
    <div class="header-container">
        <br>

        <h4>Detalhes do Item do Cardápio</h4>
        </h4><a href="{{ route('itemCardapio.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>

    </div>
    <hr>

    <div class="container">
        <h4 class="inline">Detalhes do Item: {{ $itemCardapio->nome}}
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
