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

        <form action="{{route('admin.cidades.adicionar')}}" method="POST">
            {{-- cross-site request forgery csrf --}}
            @csrf
            <div class="input-field">
                <input type="text" class="text" name="nome" id="nome">
                <label for="nome">Nome</label>
                @error('nome')
                    <span class="red-text text-accent-3"><small>{{$message}}</small></span>
                @enderror
                <input type="text" class="text" name='sigla' id='sigla'>
                <label for="sigla">Estado</label>
                


            </div>

            <div class="right-align">
                <a class="btn-flat waves-effect" href="{{url()->previous()}}">Cancelar</a>
                <button class="btn waves-effect waves-light" type="submit">
                    SALVAR
                </button>
            </div>

        </form>
    </section>
@endsection
