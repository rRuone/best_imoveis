<div class="footer-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #F5F5F5; border-top: 1px solid #ddd; padding: 10px 0; text-align: center; display: flex; justify-content: center; align-items: center;">
    @if(session()->has('error'))
        <p class="red-text">{{ session('error') }}</p>
    @endif

    @if(session()->has('success'))
        <p class="green-text">{{ session('success') }}</p>
    @endif

    <button wire:click="finalizarPedido" class="btn waves-effect waves-light green btn-responsive"
    style="font-size: 1.2em; margin:0; width: 50%; justify-content: center; align-items: center;">
        <span>Finalizar Pedido</span>
    </button>
</div>
