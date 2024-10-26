<div>
    {{-- Endereço de entrega --}}
    <h5 class="h5-header">Endereço de entrega:</h5>
    @if($enderecos->isEmpty())
        <a href="{{ route('admin.enderecos.create') }}" class="btn waves-effect waves-light">Adicionar Novo Endereço</a>
    @else
        <ul>
            @foreach($enderecos as $endereco)
                <li>
                    <label>
                        <input type="radio" name="endereco" value="{{ $endereco->id }}" 
                            wire:model="selectedEndereco" />
                        <span>{{ $endereco->logradouro }}, {{ $endereco->bairro }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Método de pagamento --}}
    <h5 class="h5-header">Método de pagamento:</h5>
    <ul>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="dinheiro" 
                    wire:click="setMetodoPagamento('dinheiro')" 
                    @if($metodoPagamento === 'dinheiro') checked @endif />
                <span>Dinheiro</span>
            </label>
        </li>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="cartao" 
                    wire:click="setMetodoPagamento('cartao')" 
                    @if($metodoPagamento === 'cartao') checked @endif />
                <span>Cartão</span>
            </label>
        </li>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="pix" 
                    wire:click="setMetodoPagamento('pix')" 
                    @if($metodoPagamento === 'pix') checked @endif />
                <span>PIX</span>
            </label>
        </li>
    </ul>

    {{-- Botão para finalizar pedido --}}
    <div class="row">
        <div class="col s12 center-align">
            <button wire:click="finalizar" class="waves-effect waves-light btn btn-custom">Finalizar Pedido</button>
        </div>
    </div>
</div>
