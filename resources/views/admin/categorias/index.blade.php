@extends('layouts.app')

@section('content')
    <br>
    <h4>Lista de Categorias</h4>
    <hr>
    <div class="container">
        <section class="section">
            <div class="table-container">
                <table class="highlight responsive-table striped">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            {{-- <th>Ações</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->nome }}</td>
                                <td class="right-align">
                                    {{-- <a href="#" class="btn-small waves-effect waves-light blue">Editar</a> 
                                    <a href="#" class="btn-small waves-effect waves-light red">Remover</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="center-align">Não existem categorias</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <style>
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
            padding: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ddd; /* Adiciona linhas internas */
        }

        table th {
            background-color: #f5f5f5; /* Cor de fundo para o cabeçalho */
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
@endsection
