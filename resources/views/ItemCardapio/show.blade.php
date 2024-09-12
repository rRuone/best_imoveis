@extends('admin.layouts.principal')

@section('content')
<div class="container">
    <h1>Personalizar Pedido: {{ $itemCardapio->nome }}</h1>

    <!-- Formulário para selecionar adicionais -->
    <form action="{{ route('itemCardapio.adicionais', $itemCardapio->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <h4>Selecione os Adicionais:</h4>

            {{-- <!-- Lista de adicionais com checkbox -->
            @if($itemCardapio->adicionais->isNotEmpty())
                @foreach($itemCardapio->adicionais as $adicional)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="adicionais[]" value="{{ $adicional->id }}" id="adicional_{{ $adicional->id }}">
                        <label class="form-check-label" for="adicional_{{ $adicional->id }}">
                            {{ $adicional->nome }} - R$ {{ number_format($adicional->pivot->preco, 2, ',', '.') }}
                        </label>
                    </div>
                @endforeach
            @else
                <p>Não há adicionais disponíveis para este item.</p>
            @endif --}}
        </div>

        <!-- Botão de avançar para login -->
        <button type="submit" class="btn btn-primary">Avançar para Login</button>
    </form>
</div>
@endsection
