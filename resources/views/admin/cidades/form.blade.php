@extends('admin.layouts.principal')

@section('conteudo-principal')
    <section class="section">
    {{-- @if ($errors->any())

    <div class="red-text">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>
    </div>

    @endif --}}

        <form action="{{$action}}" method="POST">
            {{-- cross-site request forgery csrf --}}
            @csrf
            @isset($cidade)
                @method('PUT')
            @endisset

            <div class="input-field">
                <input type="text" class="text" name="nome" id="nome" value="{{old('nome', $cidade->nome ?? '')}}">
                <label for="nome">Nome</label>
                @error('nome')
                    <span class="red-text text-accent-3"><small>{{$message}}</small></span>
                @enderror

            </div>

            <div class="right-align">
                <a class="btn-flat waves-effect" href="{{route('admin.cidades.index')}}">Cancelar</a>
                <button class="btn waves-effect waves-light" type="submit">
                    SALVAR
                </button>
            </div>

        </form>
    </section>
@endsection
