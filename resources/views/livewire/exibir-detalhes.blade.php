<div>
    <span wire:click="toggleDetalhes" style="cursor: pointer; color: #000000; font-weight: bold; display: flex; align-items: center;">
        Exibir detalhes
        <i class="material-icons" style="margin-left: 5px;">{{ $mostrarDetalhes ? 'arrow_drop_up' : 'arrow_drop_down' }}</i>
    </span>

    @if($mostrarDetalhes)
        <div style="padding-top: 10px; border-top: 1px solid #ccc; margin-top: 5px;">
            @foreach($pedido->pedidoItems as $item)
                <p><strong>Item: </strong> {{ $item->itemCardapio->nome }}</p>

                <!-- Verifica se o item pertence à categoria "Lanche" -->
                @if($item->itemCardapio->categoria && $item->itemCardapio->categoria->nome === 'Lanche')
                    @if($item->adicionais->isNotEmpty())
                        <div style="display: flex; justify-content: space-between;">
                            <div style="width: 45%;">
                                <ul>
                                    @foreach($item->adicionais->take(5) as $pedidoItemAdicional)
                                        <li>{{ $pedidoItemAdicional->adicional->nome }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Se houver mais de 5 adicionais, exibe na segunda coluna -->
                            @if($item->adicionais->count() > 5)
                                <div style="width: 45%; border-left: 1px solid #ccc; padding-left: 10px;">
                                    <ul>
                                        @foreach($item->adicionais->slice(5) as $pedidoItemAdicional)
                                            <li>{{ $pedidoItemAdicional->adicional->nome }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif
                @endif
                <hr>
            @endforeach
        </div>
    @endif
</div>
