<div class="quantity-controls" style="display: flex; align-items: center; gap: 10px; margin-top: 20px;">
    <!-- Botão de decrementar (-) -->
    <button wire:click="decrementar" class="btn waves-effect waves-light">-</button>

    <!-- Exibe a contagem de itens no carrinho -->
    <span>{{ $quantidade }}</span>

    <!-- Botão de incrementar (+) -->
    <button wire:click="incrementar" class="btn waves-effect waves-light">+</button>
</div>
