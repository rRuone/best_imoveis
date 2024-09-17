@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s4">
            <div class="card-panel orange lighten-1 center-align">
                <div class="valign-wrapper">
                    <i class="material-icons white-text"><strong>search</strong></i>
                    <h5 class="white-text" style="margin-left: 8px;"><strong>Em análise</strong></h5>
                </div>
                @if($produtosPendentes->isNotEmpty())
                    @foreach($produtosPendentes as $pedido)
                    <style>
                        .pedido-info-header {
                            display: flex; /* Define o layout flex para alinhar os elementos horizontalmente */
                            justify-content: space-between; /* Distribui espaço entre os elementos */
                            align-items: center; /* Alinha os itens verticalmente no centro */
                        }
                    </style>
                    
                    <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                        <div class="pedido-info-header">
                            <p><strong>Pedido:</strong> {{ $pedido->id }} 
                                <span style="margin-left: 20px;">
                                    <i class="material-icons" style="vertical-align: middle;"> <strong>access_time</strong></i>
                                     {{ $pedido->hora }}</span>
                            
                        </div>
                        <hr>
                        <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                        <p><strong>Valor Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                        <hr>
                        <p><strong>Endereço:</strong></p>
                        <!-- Botão para avançar o pedido para a próxima etapa -->
                        <form action="{{ route('admin.pedidos.avancar', $pedido->id) }}" method="POST" style="display:inline;">
                            @csrf 
                            <button type="submit" class="waves-effect waves-light btn btn-custom">
                                <strong>Avançar</strong>
                                <i class="material-icons">chevron_right</i>
                            </button>
                        </form>
                    </div>
                        <hr>
                    @endforeach
                @else
                    <p>Nenhum pedido no momento</p>
                @endif
            </div>
        </div>
        <div class="col s4">
            <div class="card-panel yellow lighten-1 center-align">
                <i class="material-icons">build</i>
                <h5>Em produção</h5>
                <p>Receba pedidos e visualize os que estão em produção</p>
            </div>
        </div>
        <div class="col s4">
            <div class="card-panel green lighten-1 center-align">
                <i class="material-icons">check_circle</i>
                <h5>Prontos para entrega</h5>
                <p>0</p>
                <p>Receba pedidos e visualize os prontos para entrega.</p>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col s6">
            <p>Balcão: Não informado</p>
        </div>
        <div class="col s6">
            <a class="waves-effect waves-light btn">Editar Delivery</a>
        </div> --}}
    </div>
</div>
@endsection
