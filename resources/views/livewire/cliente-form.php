<div>
    <form wire:submit.prevent="submit">

        <!-- Campo para Telefone -->
        <div class="input-field">
            <input 
                type="text" 
                id="telefone" 
                wire:model="telefone" 
                required 
                placeholder="(DD) 9XXXX-XXXX" 
                onfocus="this.placeholder=''" 
                onblur="if(!this.value) this.placeholder='(DDD) 9XXXX-XXXX'"
            >
        </div>

        <!-- Campo para Nome -->
        <div class="input-field">
            <input 
                type="text" 
                id="nome" 
                wire:model="nome" 
                required 
                placeholder="Nome" 
                onfocus="this.placeholder=''" 
                onblur="if(!this.value) this.placeholder='Nome'"
            >
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn">Avançar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

   
</div>
