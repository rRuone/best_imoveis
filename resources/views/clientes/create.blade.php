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
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
            @error('telefone')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn">Salvar</button>
    </form>
</section>

@endsection
