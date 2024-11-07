@extends('layouts.app')

@section('content')

<script>
    function toggleDetails(id) {
        const details = document.getElementById(id);
        if (details.style.display === "none") {
            details.style.display = "block";
        } else {
            details.style.display = "none";
        }
    }
</script>
<div class="container">
    <div class="row">
        <!-- Painel Pendentes -->
        <div class="col s12 m6 l4">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header orange lighten-1 valign-wrapper">
                        <i class="material-icons white-text">search</i>
                        <h5 class="white-text flow-text" style="display:flex; align-items:center;">
                            <strong style="margin-right:190px;">Pendentes</strong>
                            <span>{{ $numeroPedidosPendentes }} </span>
                        </h5>
                    </div>
                    <div class="collapsible-body">
                        @if($produtosPendentes->isNotEmpty())
                            @foreach($produtosPendentes as $pedido)
                                <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                                    <div class="pedido-info-header">
                                        <p class="flow-text"><strong>Pedido:</strong> {{ $pedido->id }}
                                            <span style="margin-left: 60px;">
                                                <i class="material-icons" style="vertical-align: middle;"> <strong>access_time</strong></i>
                                                {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
                                            </span>
                                            <form action="{{ route('admin.pedidos.cancelar', $pedido->id) }}" method="POST" style="display:block; margin-top: -10px;">
                                                @csrf
                                                <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 10px;">
                                                    <i class="material-icons" style="color: black;">cancel</i>
                                                </button>
                                            </form>
                                        </p>
                                    </div>

                                    <hr style="margin-top: 0.2px; margin-bottom: 1px;">
                                    <p>
                                        <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                                        <span style="margin-left:100px">
                                            <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                        </span>
                                        <br>
                                        <p>
                                            @php
                                                $telefone = $pedido->cliente->telefone;
                                                if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                                    $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                                } else {
                                                    $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                                }
                                            @endphp
                                            {{$telefoneFormatado}}
                                            <span style="margin-left:100px">
                                                <strong>{{ ucfirst($pedido->metdPag) }}</strong>
                                            </span>
                                        </p>
                                    </p>
                                    <hr>
                                    <p><strong>Endereço:</strong>
                                        @if($pedido->endereco)
                                            {{ $pedido->endereco->logradouro }}, {{$pedido->endereco->numero}}
                                        @else
                                            <span>Endereço não disponível</span>
                                        @endif
                                    </p>

                                    <livewire:exibir-detalhes :pedido="$pedido" />

                                    <form action="{{ route('admin.pedidos.avancar', $pedido->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                            <strong>Avançar</strong>
                                            <span style="margin-left: 20px;">
                                                <i class="material-icons">arrow_forward</i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>Nenhum pedido no momento</p>
                        @endif
                    </div>
                </li>
            </ul>
        </div>

        <!-- Painel Em Produção -->
        <div class="col s12 m6 l4">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header yellow lighten-1 valign-wrapper" style="display: flex; justify-content: space-between;">
                        <h5 class="black-text flow-text">
                            <strong>Em produção</strong>
                        </h5>
                        <span class="black-text" style="font-size: 24px;">
                            {{ $numeroPedidosEmProcesso }}
                        </span>
                    </div>
                    <div class="collapsible-body">
                        @if($pedidosEmProcesso->isNotEmpty())
                            @foreach($pedidosEmProcesso as $pedido)
                                <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                                    <div>
                                        <p class="flow-text"><strong>Pedido:</strong> {{ $pedido->id }}
                                            <span style="margin-left: 100px;">
                                                <i class="material-icons">access_time</i>
                                                {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
                                            </span>
                                        </p>
                                    </div>
                                    <hr>
                                    <p>
                                        <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                                        <span style="margin-left:100px">
                                            <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                        </span>
                                        <br>
                                        <p>
                                            @php
                                            $telefone = $pedido->cliente->telefone;
                                            if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                                $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                            } else {
                                                $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                            }
                                            @endphp
                                            {{$telefoneFormatado}}
                                            <span style="margin-left:100px">
                                                <strong>{{ ucfirst($pedido->metdPag) }}</strong>
                                            </span>
                                        </p>
                                    </p>
                                    <hr>
                                    <p><strong>Endereço:</strong>
                                        @if($pedido->endereco)
                                            {{ $pedido->endereco->logradouro }}, {{$pedido->endereco->numero}}
                                        @else
                                            <span>Endereço não disponível</span>
                                        @endif
                                    </p>

                                    <livewire:exibir-detalhes :pedido="$pedido" />

                                    <form action="{{ route('admin.pedidos.avancarPr', $pedido->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                            <strong>Avançar</strong>
                                            <span>
                                                <i class="material-icons">arrow_forward</i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>Nenhum Pedido em Produção</p>
                        @endif
                    </div>
                </li>
            </ul>
        </div>

        <!-- Painel Prontos para Entrega -->
        <div class="col s12 m6 l4">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header green lighten-1 valign-wrapper">
                        <i class="material-icons white-text">check_circle</i>
                        <h5 class="white-text flow-text">
                            <strong>Prontos para entrega</strong>
                            <span>{{ $numeroPedidosConcluidos }}</span>
                        </h5>
                    </div>
                    <div class="collapsible-body">
                        @if($pedidosConcluidos->isNotEmpty())
                            @foreach($pedidosConcluidos as $pedido)
                                <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                                    <div>
                                        <p class="flow-text"><strong>Pedido:</strong> {{ $pedido->id }}
                                            <span style="margin-left: 100px;">
                                                <i class="material-icons" style="vertical-align: middle;"> <strong>access_time</strong></i>
                                                {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
                                            </span>
                                        </p>
                                    </div>
                                    <hr>
                                    <p>
                                        <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                                        <span style="margin-left:100px">
                                            <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                        </span>
                                        <br>
                                        <p>
                                            @php
                                                $telefone = $pedido->cliente->telefone;
                                                if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                                    $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                                } else {
                                                    $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                                }
                                            @endphp
                                            {{$telefoneFormatado}}
                                            <span style="margin-left:100px">
                                                <strong>{{ ucfirst($pedido->metdPag) }}</strong>
                                            </span>
                                        </p>
                                    </p>
                                    <hr>
                                    <p><strong>Endereço:</strong>
                                        @if($pedido->endereco)
                                            {{ $pedido->endereco->logradouro }}, {{$pedido->endereco->numero}}
                                        @else
                                            <span>Endereço não disponível</span>
                                        @endif
                                    </p>

                                    <livewire:exibir-detalhes :pedido="$pedido" />

                                    <form action="{{ route('admin.pedidos.finalizado', $pedido->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                            <strong>Finalizar</strong>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>Receba pedidos e visualize os prontos para entrega.</p>
                        @endif
                    </div>
                </li>
            </ul>
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

<div class="row">
    <div class="col s12" style="display: flex; justify-content: flex-end; margin-top: 20px;">
        <a href="{{ route('admin.pedidos.historico') }}" class="btn-small waves-effect waves-light green inline">
            <i class="material-icons left">history</i> Histórico
        </a>
    </div>
</div>

</div>

  <!-- Floating Help Button -->
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large blue modal-trigger" href="#helpModal">
        <i class="large material-icons">help_outline</i>
    </a>
</div>

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


@endsection

