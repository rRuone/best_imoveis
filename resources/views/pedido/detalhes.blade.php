@extends('admin.layouts.principal')

@section('conteudo-principal')
  
    <div class="container">
        <h4>Detalhes do Pedido # {{ $pedido->id }}</h4>

        <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('H:i') }}</p>
        <p><strong>Status:</strong> 
            @if($pedido->status == 'em_processo')
                Em Andamento
            @else
                {{ ucfirst($pedido->status) }}
            @endif
        </p>
        
        <p><strong>Método de Pagamento:</strong> {{ $pedido->metdPag }}</p>
    </div>

    <div class="container">
        
    </div>

    
@endsection
