@extends('layouts.app')

@section('content')
<div class="container">

    <div class="header-container">
        <br>
        <h4 class="inline">Histórico de Pedidos</h4>
        <a href="{{ route('admin.pedidos.index') }}" class="btn-small waves-effect waves-light grey inline">Voltar</a>

    </div>



    <hr>
    <!-- Formulário de Filtro -->
    <form action="{{ route('admin.pedidos.historico') }}" method="GET" class="row">
        <div class="input-field col s4">
            <input type="text" name="cliente" id="cliente" value="{{ request('cliente') }}">
            <label for="cliente">Nome do Cliente</label>
        </div>
        <div class="input-field col s4">
            <input type="text" name="pedido_id" id="pedido_id" value="{{ request('pedido_id') }}">
            <label for="pedido_id">Número do Pedido</label>
        </div>
        <div class="input-field col s4">
            <input type="date" name="data_finalizacao" id="data_finalizacao" value="{{ request('data_finalizacao') }}">
            <label for="data_finalizacao">Data de Finalização</label>
        </div>
        <div class="input-field col s12">
            <button type="submit" class="waves-effect waves-light btn">Filtrar</button>
            <a href="{{ route('admin.pedidos.historico') }}" class="btn-flat">Limpar Filtros</a>
        </div>
    </form>

    <!-- Lista de Pedidos Finalizados -->
    @if($pedidosFinalizados->isNotEmpty())
        @foreach($pedidosFinalizados as $pedido)
            <div class="card-panel">
                <p><strong>Pedido:</strong> {{ $pedido->id }}</p>
                <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                <p><strong>Data Finalização:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y H:i') }}</p>
                <p><strong>Telefone:</strong>
                    @php
                        $telefone = $pedido->cliente->telefone;
                        $telefoneFormatado = strlen($telefone) == 11 ?
                            '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7) :
                            $telefone;
                    @endphp
                    {{ $telefoneFormatado }}
                </p>
                <hr>
            </div>
        @endforeach
    @else
        <p>Nenhum pedido finalizado encontrado.</p>
    @endif
</div>


<!-- Floating Help Button -->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
        <i class="large material-icons">help_outline</i>
    </a>
</div>

<!-- Help Modal -->
<div id="helpModal" class="modal">
    <div class="modal-content">
        <h4>Ajuda</h4>
        <p>Esta é a página de Histórico de Pedidos, onde você pode visualizar todos os pedidos finalizados.</p>
        <p>Use o formulário de filtros para buscar pedidos específicos pelo nome do cliente, número do pedido ou data de finalização.</p>
        <p>Para limpar os filtros e exibir todos os pedidos novamente, clique em "Limpar Filtros".</p>
        <p>Para retornar à página principal de pedidos, clique no botão "Voltar".</p>
    </div>

    <div class="modal-footer">
        <a href="#!" class="modal-close btn grey">Fechar</a>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa os modais
    M.Modal.init(document.querySelectorAll('.modal'));
});
</script>



<style>
    .form-container {
        max-width: 70%;
        margin: 0 auto;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1px;
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

    .input-field {
        margin-bottom: 20px;
    }

    .btn-small {
        padding: 5px 10px;
        font-size: 12px;
    }

    .center-align {
        text-align: center;
    }

    .fixed-action-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
    }
</style>
@endsection
