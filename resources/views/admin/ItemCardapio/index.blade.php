@extends('layouts.app')

@section('content')
<div class="section container">
    <div class="header-container">
        <br>
        <h4 class="inline">Itens do Cardápio</h4>
        <div class="class button-group">
            <a href="javascript:history.back()" class="btn-small waves-effect waves-light grey inline">Voltar</a>
        <a href="{{ route('admin.itemCardapio.create') }}" class="btn-small waves-effect waves-light green inline">Adicionar</a>
        </div>


    </div>
    <hr>

    <!-- Mensagem de sucesso, se houver -->
    @if(session('success'))
        <div class="card-panel green lighten-4">
            <span class="green-text">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal small-modal">
        <div class="modal-content">
            <h4>Confirmar Exclusão</h4>
            <p>Tem certeza de que deseja excluir o item <strong id="item-name"></strong>?</p>
        </div>
        <div class="modal-footer">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-close btn red">Sim</button>
                <a href="#!" class="modal-close btn grey">Cancelar</a>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table class="striped">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.itemCardapio.index', ['sort' => 'nome', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}" class="header-link">
                            Nome
                            @if ($sort === 'nome')
                                <i class="material-icons">{{ $direction === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.itemCardapio.index', ['sort' => 'categoria_id', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}" class="header-link">
                            Categoria
                            @if ($sort === 'categoria_id')
                                <i class="material-icons">{{ $direction === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.itemCardapio.index', ['sort' => 'preco', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}" class="header-link">
                            Preço
                            @if ($sort === 'preco')
                                <i class="material-icons">{{ $direction === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
                            @endif
                        </a>
                    </th>
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
                                <img src="{{ url("storage/{$item->foto}") }}" alt="{{ $item->nome }}" style="width: 100px; height: auto;">
                            @else
                                Sem Foto
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.itemCardapio.show', $item->id) }}" class="btn blue btn-small">
                                <i class="material-icons">remove_red_eye</i>
                            </a>
                            <a href="{{ route('admin.itemCardapio.edit', $item->id) }}" class="btn green btn-small">
                                <i class="material-icons">edit</i>
                            </a>
                            <button class="btn red btn-small modal-trigger" data-target="deleteModal"
                                    data-url="{{ route('admin.itemCardapio.destroy', $item->id) }}"
                                    data-name="{{ $item->nome }}">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
        <i class="large material-icons">help_outline</i>
    </a>
</div>

<div id="helpModal" class="modal">
    <div class="modal-content">
        <h4>Ajuda</h4>
        <p>Esta página permite que você visualize e gerencie os itens do cardápio. Aqui estão as funcionalidades:</p>
        <ul>
            <li><strong>Adicionar:</strong> Clique no botão "Adicionar" para criar um novo item de cardápio.</li>
            <li><strong>Visualizar:</strong> O ícone de olho permite visualizar detalhes do item.</li>
            <li><strong>Editar:</strong> O ícone de lápis permite editar um item existente.</li>
            <li><strong>Excluir:</strong> O ícone de lixeira permite excluir um item após confirmação.</li>
            <li><strong>Ordenar:</strong> Clique nos cabeçalhos da tabela (Nome, Categoria, Preço) para ordenar os itens.</li>
        </ul>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close btn grey">Fechar</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the modal
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);

        // Add event listener to delete buttons to open modal with correct data
        document.querySelectorAll('.modal-trigger').forEach(button => {
            button.addEventListener('click', function() {
                // Set the form action URL for deletion
                let url = this.getAttribute('data-url');
                document.getElementById('deleteForm').setAttribute('action', url);

                // Set the item name in the modal confirmation text
                let itemName = this.getAttribute('data-name');
                document.getElementById('item-name').textContent = itemName;
            });
        });
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
        margin-top: 1px; /* Diminui o espaço acima do hr */
        margin-bottom: 20px; /* Espaço abaixo do hr */
    }

    .header-container h4 {
        margin: 1%; /* Remove margem padrão do título */
        position: sticky; /* Faz o cabeçalho ficar fixo */
        top: 0; /* Fica fixo no topo */
        z-index: 10; /* Coloca acima de outros elementos */
    }

    .header-container .btn-small {
        margin-left: auto; /* Alinha o botão à direita */
    }

    .table-container {
        max-width: 100%; /* Ajuste a largura máxima da tabela conforme necessário */
        margin: 0 auto; /* Centraliza o container da tabela */
        overflow-y: auto; /* Permite rolagem vertical */
        height: 400px; /* Ajuste a altura conforme necessário */
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
        position: sticky; /* Faz o cabeçalho ficar fixo */
        top: 0; /* Fica fixo no topo da tabela */
        z-index: 5; /* Coloca acima de outros elementos */
    }

    table th:last-child, table td:last-child {
        text-align: right; /* Alinha a última coluna à direita */
    }

    .btn-small {
        padding: 5px 10px;
        font-size: 12px;
    }

    .modal.small-modal {
        width: 40% !important; /* Ajuste a largura conforme necessário */
        max-height: 200px; /* Ajuste a altura se necessário */
    }

    .header-link {
        color: inherit; /* Mantém a cor do link igual ao do pai */
        text-decoration: none; /* Remove o sublinhado dos links */
    }

    .header-link:hover {
        text-decoration: underline; /* Opcional: Adiciona sublinhado ao passar o mouse para melhor UX */
    }

    .fixed-action-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
    }
</style>
@endsection
