@extends('admin.layouts.principal')

@section('conteudo-principal')
    <h1>Lista de Adicionais</h1>
    <section class="section">
        <table class="highight">
            <thead>
                <tr>
                    <th>Adicional</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adicionais as $adicional)
                    <tr>
                        <td>{{$adicional ->nome}}</td>
                        <td class="right-align">{{$adicional->preco}}</td>
                        <td class="right-align">Excluir - Remover</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Não existe adicionais</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
