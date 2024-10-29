{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-container">
            <br>
            <h4>Lista de Adicionais</h4>
            <a href="{{ route('admin.adicionais.create') }}" class="btn-small waves-effect waves-light green inline">Adicionar</a>
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
                <p>Tem certeza de que deseja excluir o adicional <strong id="item-name"></strong>?</p>
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

        <table class="striped">
            <thead>
                <tr>
                    <th><a href="#" class="header-link">Adicional</a></th>
                    <th><a href="#" class="header-link">Preço</a></th>
                    <th class="actions-header">Ações</th> <!-- Alinhado à direita -->
                </tr>
            </thead>
            <tbody>
                @foreach($adicionais as $adicional)
                    <tr>
                        <td>{{ $adicional->nome }}</td>
                        <td>R$ {{ number_format($adicional->preco, 2, ',', '.') }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('admin.adicionais.show', $adicional->id) }}" class="btn blue btn-small">
                                <i class="material-icons">remove_red_eye</i>
                            </a>
                            <a href="{{ route('admin.adicionais.edit', $adicional->id) }}" class="btn green btn-small">
                                <i class="material-icons">edit</i>
                            </a>
                            <button class="btn red btn-small modal-trigger" data-target="deleteModal"
                                    data-url="{{ route('admin.adicionais.destroy', $adicional->id) }}"
                                    data-name="{{ $adicional->nome }}">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);

            document.querySelectorAll('.modal-trigger').forEach(button => {
                button.addEventListener('click', function() {
                    let url = this.getAttribute('data-url');
                    document.getElementById('deleteForm').setAttribute('action', url);

                    let itemName = this.getAttribute('data-name');
                    document.getElementById('item-name').textContent = itemName;
                });
            });
        });
    </script>

    <style>
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 20px;
        }

        .header-container h4 {
            margin: 1%;
        }

        .header-container .btn-small {
            margin-left: auto;
        }

        .modal.small-modal {
            width: 40% !important;
            max-height: 300px;
        }

        .header-link {
            color: inherit;
            text-decoration: none;
        }

        .header-link:hover {
            text-decoration: underline;
        }

        table {
            margin: 0;
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
        }

        /* Ajustes na coluna "Ações" */
        .actions-header {
            text-align: right;
            padding-right: 15px; /* Espaço extra para alinhar mais à esquerda */
        }

        .actions-cell {
            text-align: right;
            padding-right: 15px; /* Espaço extra para afastar da borda direita */
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-container">
            <br>
            <h4>Adicionais</h4>
            <a href="{{ route('admin.adicionais.create') }}" class="btn-small waves-effect waves-light green inline">Adicionar</a>
        </div>
        <hr>

        <!-- Mensagem de sucesso, se houver -->
        @if(session('success'))
            <div class="card-panel green lighten-4">
                <span class="green-text">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Modal de Confirmação de Exclusão -->
        <div id="deleteModal" class="modal small-modal">
            <div class="modal-content">
                <h4>Confirmar Exclusão</h4>
                <p>Tem certeza de que deseja excluir o adicional <strong id="item-name"></strong>?</p>
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

        <table class="striped">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.adicionais.index', ['sort' => 'nome', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}" class="header-link">
                            Nome
                            @if ($sort === 'nome')
                                <i class="material-icons">{{ $direction === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.adicionais.index', ['sort' => 'preco', 'direction' => $direction === 'asc' ? 'desc' : 'asc']) }}" class="header-link">
                            Preço
                            @if ($sort === 'preco')
                                <i class="material-icons">{{ $direction === 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
                            @endif
                        </a>
                    </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adicionais as $adicional)
                    <tr>
                        <td>{{ $adicional->nome }}</td>
                        <td>R$ {{ number_format($adicional->preco, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.adicionais.show', $adicional->id) }}" class="btn blue btn-small">
                                <i class="material-icons">remove_red_eye</i>
                            </a>
                            <a href="{{ route('admin.adicionais.edit', $adicional->id) }}" class="btn green btn-small">
                                <i class="material-icons">edit</i>
                            </a>
                            <button class="btn red btn-small modal-trigger" data-target="deleteModal"
                                    data-url="{{ route('admin.adicionais.destroy', $adicional->id) }}"
                                    data-name="{{ $adicional->nome }}">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa o modal
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);

            // Adiciona event listener aos botões de exclusão para abrir o modal com os dados corretos
            document.querySelectorAll('.modal-trigger').forEach(button => {
                button.addEventListener('click', function() {
                    // Define a URL de ação para exclusão
                    let url = this.getAttribute('data-url');
                    document.getElementById('deleteForm').setAttribute('action', url);

                    // Define o nome do item no texto de confirmação do modal
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

        table th:last-child, table td:last-child {
            text-align: right; /* Alinha a última coluna à direita */
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }

        .modal.small-modal {
            width: 40% !important; /* Ajusta a largura conforme necessário */
            max-height: 300px; /* Ajusta a altura se necessário */
        }

        .header-link {
            color: inherit; /* Faz a cor do link herdar do seu pai */
            text-decoration: none; /* Remove o sublinhado dos links */
        }

        .header-link:hover {
            text-decoration: underline; /* Adiciona sublinhado ao passar o mouse para melhor UX */
        }
    </style>
@endsection
