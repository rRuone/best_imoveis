<div class="card" style="position: relative; padding-bottom: 60px;">
    <div class="card-content">
        @if(isset($itemCardapio))
            <span class="card-title">{{ $itemCardapio->nome }}</span>
            <p>R$ {{ number_format($itemCardapio->preco, 2, ',', '.') }}</p>
        @else
            <p>Item do cardápio não encontrado.</p>
        @endif

        @if(!empty($adicionais)) 
            <h5>Adicionais:</h5>
            <ul>
                @foreach($adicionais as $adicional)
                    <li>{{ $adicional->nome }}</li> <!-- Acesso ao nome do adicional -->
                @endforeach
            </ul>
        @endif

        <div class="quantity-controls" style="display: flex; align-items: center; gap: 20px; margin-top: 10px; border: 1px solid #ccc; padding: 5px; border-radius: 5px; max-width: 150px; justify-content: center; position: absolute; bottom: 10px; right: 10px;">
            @if($quantidade > 1)
                <button wire:click="decrementar" style="background: none; border: none; cursor: pointer;">
                    <i class="material-icons">remove</i>
                </button>
            @else
                <button wire:click="deletar" style="background: none; border: none; cursor: pointer;">
                    <i class="material-icons">delete</i>
                </button>
            @endif
        
            <span>{{ $quantidade }}</span>
        
            <button wire:click="incrementar" style="background: none; border: none; cursor: pointer;">
                <i class="material-icons">add</i>
            </button>
        </div>
        
        <!-- Formulário para remover o item -->
        <div style="position: absolute; top: 10px; right: 10px;">
            <button wire:click="deletar" class="btn-floating waves-effect waves-light red"><i class="material-icons">clear</i></button>
        </div>
    </div>
</div>


