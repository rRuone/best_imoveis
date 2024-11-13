<div  wire:poll.keep-alive.20s class="col s12 m6 l4">
    <ul class="collapsible">
        <li class="active">
            <div class="collapsible-header orange lighten-1 valign-wrapper">
                <i class="material-icons white-text">search</i>
                <h5 class="white-text flow-text" style="flex: 1;">
                    <strong>Pendentes</strong>
                </h5>
                <div class="right-align" style="display: flex; align-items: center;">
                    <span class="white-text" style="font-size: 1.5em; margin-right: 10px;">{{ $numeroPedidosPendentes }}</span>
                    <i class="material-icons white-text" id="icon-pendentes" onclick="toggleDetails('pendentes')">arrow_drop_up</i>
                </div>
            </div>
            <div class="collapsible-body" id="details-pendentes" style="display: block;">
                @if($produtosPendentes->isNotEmpty())
                    @foreach($produtosPendentes as $pedido)
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
                            @if ($pedido->endereco)
                                <p><strong>Endereço:</strong>
                                    {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }}, {{$pedido->endereco->bairro}}
                                </p>
                            @elseif($pedido->retirar)
                                <p><span><strong>Retirada no Balcão</strong></span></p>
                            @else
                                <p><span>Endereço não disponível</span></p>
                            @endif

                            <livewire:exibir-detalhes :pedido="$pedido" wire:key="detalhes-{{ $pedido->id }}" wire:poll.15s />



                        <!-- Botões de Cancelar e Avançar centralizados e responsivos -->
                        <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                            <!-- Botão Cancelar -->
                            <form action="{{ route('admin.pedidos.cancelar', $pedido->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="waves-effect waves-light btn red darken-1" style="color: white; display: flex; align-items: center; justify-content: center;">
                                    <i class="material-icons left" style="margin-right: 8px;">cancel</i>
                                    <strong>Cancelar</strong>
                                </button>
                            </form>

                            <!-- Botão Avançar -->
                            <form action="{{ route('admin.pedidos.avancar', $pedido->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="waves-effect waves-light btn btn-custom" style="display: flex; align-items: center; justify-content: center;">
                                    <strong>Avançar</strong>
                                    <span style="margin-left: 20px;">
                                        <i class="material-icons">arrow_forward</i>
                                    </span>
                                </button>
                            </form>
                        </div>
                        </div>
                    @endforeach
                @else
                    <p>Nenhum pedido no momento</p>
                @endif
            </div>
        </li>
    </ul>
</div>


{{-- <script>
 
    function toggleDetails(id) {
        const details = document.getElementById('details-' + id);
        const icon = document.getElementById('icon-' + id);

        if (details.style.display === "none" || details.style.display === "") {
            details.style.display = "block";
            icon.innerText = "arrow_drop_up";
        } else {
            details.style.display = "none";
            icon.innerText = "arrow_drop_down";
        }
    }

</script> --}}

