<div style="margin-bottom: 80px;">
    <div  class="collection mb-0 grey lighten-5">
         <h5 class="h5-header" style="font-size: 1rem;">Subtotal:</h5>
        <p>R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
        <hr>
        <h5 class="h5-header" style="font-size: 1rem;">Taxa de Entrega:</h5>
        <p>R$ {{ number_format($taxaEntrega, 2, ',', '.') }}</p>
        <hr>
        <h5 class="h5-header">Total:</h5>
        <p><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></p>

    </div>
   
 

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

</div>


