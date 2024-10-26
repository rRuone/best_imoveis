<div>
    <ul>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="dinheiro" 
                       wire:click="selecionarMetodo('dinheiro')"
                       @if($metodoPagamento == 'dinheiro') checked @endif />
                <span>Dinheiro</span>
            </label>
        </li>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="cartao" 
                       wire:click="selecionarMetodo('cartao')"
                       @if($metodoPagamento == 'cartao') checked @endif />
                <span>Cartão</span>
            </label>
        </li>
        <li>
            <label>
                <input type="radio" name="metodo_pagamento" value="pix" 
                       wire:click="selecionarMetodo('pix')"
                       @if($metodoPagamento == 'pix') checked @endif />
                <span>PIX</span>
            </label>
        </li>
    </ul>
</div>