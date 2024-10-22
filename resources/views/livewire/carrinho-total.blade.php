<div>
    <footer style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #F5F5F5; border-top: 1px solid #ddd; padding: 10px 0; text-align: center; display: flex; justify-content: center; align-items: center;">
        <form action="{{ route('carrinho.avancar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-small waves-effect waves-light green" style="width: 790px; display: flex; justify-content: space-between; align-items: center;">
                <h5 style="margin: 0; font-size: 1.2em;">Avançar</h5>
                <h5 style="margin: 0; font-size: 1.2em;">R$ {{ number_format($total, 2, ',', '.') }}</h5>
            </button>
        </form>
    </footer>
</div>
