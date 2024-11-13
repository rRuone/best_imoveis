<div class="col s12 m6 l4">
    <ul class="collapsible">
        <li class="active">
            <div class="collapsible-header green lighten-1 valign-wrapper">
                <i class="material-icons white-text">check_circle</i>
                <h5 class="white-text flow-text" style="flex: 1;">
                    <strong>Prontos para entrega</strong>
                </h5>
                <div class="right-align" style="display: flex; align-items: center;">
                    <span class="white-text" style="font-size: 1.5em; margin-right: 10px;">{{ $numeroPedidosConcluidos }}</span>
                    <i class="material-icons white-text" id="icon-prontosEntrega" onclick="toggleDetails('prontosEntrega')">arrow_drop_up</i>
                </div>
            </div>
            <div class="collapsible-body" id="details-prontosEntrega" style="display: block;">
                @if($pedidosConcluidos->isNotEmpty())
                    @foreach($pedidosConcluidos as $pedido)
                    <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                        <div class="pedido-info-header" style="display: flex; align-items: center; justify-content: space-between;">
                            <p class="flow-text">
                                <strong>Pedido:</strong> {{ $pedido->id }}
                            </p>
                            <p class="flow-text">
                                <i class="material-icons">access_time</i>
                                {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
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
                            
                            @if ($pedido->endereco)
                                <p><strong>Endereço:</strong>
                                    {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }}, {{$pedido->endereco->bairro}}
                                </p>
                            @elseif($pedido->retirar)
                                <p><span><strong>Retirada no Balcão</strong></span></p>
                            @else
                                <p><span>Endereço não disponível</span></p>
                            @endif

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
                    <p>Visualize os pedidos prontos para entrega.</p>
                @endif
            </div>
        </li>
    </ul>
</div>