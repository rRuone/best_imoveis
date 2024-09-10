@extends('admin.layouts.principal')

@section('conteudo-principal')
    
    <section class="section">
        <h4>Lista de Catogoria</h4>
        <table class="highight">
            <thead>
                <tr>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{$categoria ->nome}}</td>
                        
                        <td class="right-align">Excluir - Remover</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Não existe categorias</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
