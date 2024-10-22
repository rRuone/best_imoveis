@extends('admin.layouts.principal')

@section('conteudo-principal')

<section class="section">
<table class="highlight">
    <thead>
        <tr>
            <th>Cidade</th>
            <th class="right-align">Opções</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($cidades as $cidade )
            <tr>
                <td>{{$cidade->nome}}</td>
                <td class="right-align">Excluir - Remover</td>
            </tr>
        @empty
            <td colspan="2"> Não existem cidades cadastradas </td>
        @endforelse
    </tbody>
</table>

<div class="fixed-action-btn">
    <a href="{{route('admin.cidades.create')}}" class="btn-floating btn-large waves-effect waves-light">
        <i class="large material-icons">
            add
        </i>
    </a>
</div>



</section>

@endsection


@section('conteudo-secundario')
<p>TExto secundario</p>
@endsection
