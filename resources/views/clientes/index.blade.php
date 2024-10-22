@extends('admin.layouts.principal')

@section('conteudo-principal')

<section class="section">
    <table class="highlight">
        <thead>
            <tr>
                <th>Cliente</th>
                <th class="right-align">Telefone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td class="right-align">{{ $cliente->telefone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Não existem clientes cadastrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

@endsection
