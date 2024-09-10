@extends('admin.layouts.principal')

@section('conteudo-principal')
    
    <section class="section container">
        <h4> Adicionar Categorias</h4>
    @if($errors->any())
    <span style="color: #ff0000">
        @foreach ($errors->all() as $error)
            {{ $error}}<br>
        @endforeach
    </span>
    <br>
    @endif

    <form action="{{route('admin.categorias.store')}}" method="POST">
        @csrf
        <div class='input-field'>
            <label for="nome">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" value="{{old('nome')}}">
        </div>
        <button type="submit" class="btn waves-effect waves-light">Salvar</button>
    </form>
    </section>
@endsection