@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-container">
            <br>
            <h4>Itens do Cardápio</h4>
            <a href="{{ route('itemCardapio.create') }}"class="btn-small waves-effect waves-light gren inline">Adicionar</a>
        </div>
        <hr>
       

        <!-- Mensagem de sucesso, se houver -->
        @if(session('success'))
            <div class="card-panel green lighten-4">
                <span class="green-text">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabela de itens do cardápio -->
        <table class="striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Foto</th>
                    {{-- <th>Ações</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($itemCardapio as $item)
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->categoria ? $item->categoria->nome : 'Sem Categoria' }}</td>
                        <td>R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                        <td>
                            @if($item->foto)
                            <img src="{{ url("storage/{$item->foto}")  }}" alt="{{ $item->nome }}" style="width: 100px; height: auto;">

                            @else
                                Sem Foto
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('itemCardapio.show', $item->id) }}" class="btn blue">Ver</a>
                            <a href="{{ route('itemCardapio.edit', $item->id) }}" class="btn orange">Editar</a>
                            <form action="{{ route('itemCardapio.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn red">Excluir</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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