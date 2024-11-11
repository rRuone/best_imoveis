@extends('admin.layouts.principal')

@section('conteudo-principal')

    <div class="container">
        <h4>Detalhes do Pedido # {{ $pedido->id }}</h4>

        <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
        <p><strong>Data de Criação:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('H:i') }}</p>

        @if($pedido->status =='finalizado'  && $pedido->updated_at)
            <p><strong>Data de Finalização:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('H:i') }}</p>
        @endif

        <p><strong>Status:</strong>
            @if($pedido->status == 'em_processo')
                Em Andamento
            @elseif($pedido->status == 'concluido')
                Pronto para entrega
            @else
                {{ ucfirst($pedido->status) }}
            @endif
        </p>


        <p><strong>Método de Pagamento:</strong> {{ ucfirst($pedido->metdPag )}}</p>
        <p><strong>Tempo estimado: </strong> 30 minutos </p>

    </div>

    <div class="container">
    </div>

@endsection
