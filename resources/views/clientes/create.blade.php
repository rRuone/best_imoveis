@extends('admin.layouts.principal')

@section('conteudo-principal')

<section class="section container">
    @if($errors->any())
    <span style="color: #ff0000">
        @foreach ($errors->all() as $error)
            {{ $error}}<br>
        @endforeach
    </span>
    <br>
    @endif

    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
        <!-- Campo para Nome -->
        <div class="input-field">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
            @error('nome')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo para Telefone -->
        <div class="input-field">
            <label for="telefone">Telefone (DDD)</label>
            <input type="tel" id="telefone" name="telefone"
                placeholder="(XX) XXXXX-XXXX" required oninput="formatarTelefone(this)">
            @error('telefone')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn">Salvar</button>
    </form>
</section>

<script>
function formatarTelefone(telefone) {
    // Remove todos os caracteres não numéricos
    let numero = telefone.value.replace(/\D/g, '');

    // Formatação do DDD e número de telefone
    if (numero.length > 10) {
        telefone.value = `(${numero.slice(0, 2)}) ${numero.slice(2, 7)}-${numero.slice(7, 11)}`;
    } else if (numero.length > 6) {
        telefone.value = `(${numero.slice(0, 2)}) ${numero.slice(2, 7)}-${numero.slice(7)}`;
    } else if (numero.length > 2) {
        telefone.value = `(${numero.slice(0, 2)}) ${numero.slice(2)}`;
    } else {
        telefone.value = numero;
    }
}
</script>

@endsection
