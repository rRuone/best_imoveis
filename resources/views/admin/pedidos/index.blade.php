@extends('layouts.app')

@section('content')


<div class="section container">

    <div div class="header-container center-align" style="display: flex; justify-content: center;
     align-items: center; height: 30px;">
        <h4 class="inline">Pedidos do dia</h4>
    </div>

    <hr>

    <div class="row">
        <!-- Painel Pendentes -->
        <livewire:pedidos-pendentes/>


        <!-- Painel Em Produção -->
        <livewire:pedidos-em-producao/>


        <!-- Painel Prontos para Entrega -->
        <livewire:pronto-entrega/>
        

        <div class="row">
            <div class="col s12" style="display: flex; justify-content: flex-end; margin-top: 20px;">
                <a href="{{ route('admin.pedidos.historico') }}" class="btn-small waves-effect waves-light green inline">
                    <i class="material-icons left">history</i> Histórico
                </a>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    <div id="helpModal" class="modal">
        <div class="modal-content">
            <h4>Ajuda</h4>
            <p>Esta é a página de gerenciamento de pedidos. Você pode visualizar os pedidos pendentes, em produção e prontos para entrega.</p>
            <p>Para avançar um pedido, clique no botão "Avançar" ao lado do pedido correspondente.</p>
            <p>Para ver o histórico de pedidos, clicar no botão "Histórico"</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close btn grey">Fechar</a>
        </div>
    </div>
</div>



</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
        <i class="large material-icons">help_outline</i>
    </a>
</div>

  <!-- Floating Help Button -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializa os modais
        M.Modal.init(document.querySelectorAll('.modal'));
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        M.Collapsible.init(elems);
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
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .header-container .btn-small {
        margin-left: auto;
    }

    .table-container {
        max-width: 100%;
        margin: 0 auto;
        overflow-y: auto;
        height: 400px;
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
        position: sticky;
        top: 0;
        z-index: 5;
    }

    table th:last-child, table td:last-child {
        text-align: right;
    }

    .btn-small {
        padding: 5px 10px;
        font-size: 12px;
    }

    .modal.small-modal {
        width: 40% !important;
        max-height: 200px;
    }

    .header-link {
        color: inherit;
        text-decoration: none;
    }

    .header-link:hover {
        text-decoration: underline;
    }

    .fixed-action-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
    }
</style>

@endsection

