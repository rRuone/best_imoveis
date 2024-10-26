<div class="col s12 center-align">
    @if(session()->has('error'))
        <p class="red-text">{{ session('error') }}</p>
    @endif

    @if(session()->has('success'))
        <p class="green-text">{{ session('success') }}</p>
    @endif

    <button wire:click="finalizarPedido" class="waves-effect waves-light btn btn-custom">
        Finalizar Pedido
    </button>
</div>
