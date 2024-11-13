<div>
    <footer class="footer-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #F5F5F5; border-top: 1px solid #ddd; padding: 10px 0;
     text-align: center; display: flex; justify-content: center; align-items: center; z-index: 10;">
        <form action="{{ route('carrinho.avancar') }}" method="POST" style="width: 100%; max-width: 800px; padding: 0 10px;">
            @csrf
            <button type="submit" class="btn waves-effect waves-light green btn-responsive"
                style="width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;"
                @if(empty(session()->get('pedido'))) disabled @endif>
                <span style="font-size: 1.2em; margin: 0;">Avançar</span>
                <span style="font-size: 1.2em; margin: 0;">R$ {{ number_format($total, 2, ',', '.') }}</span>
            </button>
        </form>
    </footer>
</div>

<style>
    /* Estilos responsivos para o botão "Avançar" */
    @media (max-width: 600px) {
        .btn-responsive {
            font-size: 1em; /* Reduz o tamanho do texto em telas menores */
            padding: 10px 15px;
        }
    }

    @media (min-width: 601px) {
        .btn-responsive {
            font-size: 1.2em;
            padding: 15px 20px;
        }
    }
</style>
