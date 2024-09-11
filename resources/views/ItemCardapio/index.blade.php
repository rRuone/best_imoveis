<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Itens do Cardápio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h4>Itens do Cardápio</h4>

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
                    <th>Ações</th>
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
                            <a href="{{ route('itemCardapio.show', $item->id) }}" class="btn blue">Ver</a>
                            <a href="{{ route('itemCardapio.edit', $item->id) }}" class="btn orange">Editar</a>
                            <form action="{{ route('itemCardapio.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn red">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('itemCardapio.create') }}" class="btn green">Adicionar Novo Item</a>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
