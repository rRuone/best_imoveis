@extends('admin.layouts.principal')
@section('conteudo-principal')
    <div class="section container">
        <h4>Adicionar Adicional</h4>
        @if($errors->any())
            <span style="color: #ff0000">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
            <br>
        @endif

        <form action="{{ route('admin.adicionais.store') }}" method="POST">
            @csrf
            <div class='input-field'>
                <label for="nome">Nome do Adicional</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="input-field">
                <label for="preco">Preço do Adicional</label>
                <input type="text" id="preco" name="preco" value="{{ old('preco') }}">
            </div>
        
            <div class="input-field">
                <a href="{{ route('admin.adicionais.index') }}" class="btn waves-effect waves-light grey">Voltar</a>
                <button type="submit" class="btn waves-effect waves-light">Salvar</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endsection
