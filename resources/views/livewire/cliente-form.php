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

        <div class="footer-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #F5F5F5; border-top: 1px solid #ddd; padding: 10px 0; text-align: center; display: flex; justify-content: center; align-items: center;">
            <button type="submit" class="btn waves-effect waves-light green btn-responsive"
                style="font-size: 1.2em; margin:0; width: 50%; justify-content: center; align-items: center;">
                <span>Avançar</span>
            </button>
        </div>
        
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

   
</div>
