@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-container">
            <br>
            <h4 class="inline">Lista de Adicionais</h4>
            <a href="{{ route('admin.adicionais.create') }}" class="btn-small waves-effect waves-light gren inline">Adicionar</a>
        </div>
        <hr>
        <section class="section">
            <div class="table-container">
                <table class="highlight responsive-table striped">
                    <thead>
                        <tr>
                            <th>Adicional</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($adicionais as $adicional)
                            <tr>
                                <td>{{ $adicional->nome }}</td>
                                <td class="right-align">
                                    {{-- <a href="#" class="btn-small waves-effect waves-light blue">Editar</a> 
                                    <a href="#" class="btn-small waves-effect waves-light red">Remover</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="center-align">Não existem adicionais</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <style>

        .header-container {
            display: flex;
            align-items: center; /* Alinha verticalmente ao centro */
            justify-content: space-between; /* Espaça igualmente entre os itens */
            margin-bottom: 2px; /* Espaço abaixo do cabeçalho */
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

        .btn-small {   /*Botão adicionar  */
            padding: 5px 10px; 
            font-size: 12px;
        }
    </style>
@endsection
