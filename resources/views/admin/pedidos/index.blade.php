@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m6 l4">
            <div class="card-panel orange lighten-1 center-left">
                <div class="valign-wrapper">
                    <i class="material-icons white-text"><strong style="margin-right: 10px;">
                        search</strong></i>
                    <span>
                        <h5 class="white-text flow-text" style="display:flex; align-items:center;">
                            <strong style="margin-right:190px;">Pendentes</strong>
                            <span >{{ $numeroPedidosPendentes }} </span>
                         </h5>
                    </span>  
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
                            <p class="flow-text"><strong>Pedido:</strong> {{ $pedido->id }} 
                                <span style="margin-left: 100px;">
                                    <i class="material-icons" style="vertical-align: middle;"> <strong>access_time</strong></i>
                                    {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}</span>
                            </p>
                        </div>
                        <hr style="margin-top: 0.2px; margin-bottom: 1px;">
                        <p>
                            <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                            <span style="margin-left:100px">
                                <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                            </span>
                            <br>
                            <p>
                                @php
                                    $telefone = $pedido->cliente->telefone;
                                    if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                        $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                    } else {
                                        $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                    }
                                @endphp
                                {{$telefoneFormatado}}
                            </p>
                        </p>
                        <hr>
                        {{-- <p><strong>Endereço:</strong> {{ $pedido->cliente->endereco->logradouro }}</p> --}}
                        <!-- Botão para avançar o pedido para a próxima etapa -->
                        <form action="{{ route('admin.pedidos.avancar', $pedido->id) }}" method="POST" style="display:inline;">
                            @csrf 
                            <button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                <strong>Avançar</strong>
                                <span style="margin-left: 20px;">
                                    <i class="material-icons">arrow_forward</i>
                                </span>
                            </button>
                        </form>
                    </div>
                        
                    @endforeach
                @else
                    <p>Nenhum pedido no momento</p>
                @endif
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card-panel yellow lighten-1">
                <div class="valign-wrapper" style="display: flex; justify-content: space-between;">
                    <h5 class="black-text flow-text">
                        <strong>Em produção</strong>
                    </h5>
                    <span class="black-text" style="font-size: 24px;">
                        {{ $numeroPedidosEmProcesso }}
                    </span>
                </div>
                @if($pedidosEmProcesso->isNotEmpty())
                    @foreach($pedidosEmProcesso as $pedido)
                        <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                            <div>
                                <p class="flow-text">
                                    <strong>Pedido:</strong> {{ $pedido->id }}
                                    <span span style="margin-left: 100px;">
                                        <i class="material-icons">access_time</i>
                                        {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
                                    </span>
                                </p>
                            </div>
                            <hr>
                            <p>
                                <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                                <span style="margin-left:100px">
                                    <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                </span>
                                <br>
                                <p>
                                    @php
                                        $telefone = $pedido->cliente->telefone;
                                        if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                            $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                        } else {
                                            $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                        }
                                    @endphp
                                    {{$telefoneFormatado}}
                                </p>
                            </p>
                            <hr>
                            {{-- <p><strong>Endereço:</strong></p> --}}
                            <form action="{{route('admin.pedidos.avancarPr', $pedido->id)}}" method="POST">
                                @csrf
                                <button  button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                    <strong>Avançar</strong>
                                    <span>
                                        <i class="material-icons">arrow_forward</i>
                                    </span>
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>Nenhum Pedido em Produção</p>
                @endif
            </div>
        </div>
        
        <div class="col s12 m6 l4">
            <div class="card-panel green lighten-1 center-left">
                <div>
                   
                    <span>
                        
                        <h5 class="white-text flow-text" style="display:flex; align-items:left;">
                            <i class="material-icons black-text"><strong style="margin-right:10px;">
                            check_circle</strong>
                            </i>
                            <strong style="margin-right:50px;">Prontos para entrega</strong>
                            <span>{{$numeroPedidosConcluidos}}</span>
                        </h5>
                    </span>
                </div>
                @if($pedidosConcluidos->isNotEmpty())
                    @foreach($pedidosConcluidos as $pedido)
                        <div class="pedido-info" style="border: 1px solid #ccc; padding: 15px; border-radius: 15px; background-color: #fff; margin-bottom: 20px;">
                            <div>
                                <p class="flow-text"><strong>Pedido:</strong> {{ $pedido->id }} 
                                    <span style="margin-left: 120px;">
                                        <i class="material-icons" style="vertical-align: middle;"> <strong>access_time</strong></i>
                                        {{ \Carbon\Carbon::parse($pedido->created_at)->format('H:i') }}
                                    </span>
                                </p>
                            </div>
                            <hr>
                            <p>
                                <strong>Cliente:</strong> {{ explode(' ', trim($pedido->cliente->nome))[0] }}
                                <span style="margin-left:100px">
                                    <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                </span>
                                <br>
                                <p>
                                    @php
                                        $telefone = $pedido->cliente->telefone;
                                        if(strlen($telefone) == 11) { // Verifica se o número tem 11 dígitos (incluindo DDD)
                                            $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                                        } else {
                                            $telefoneFormatado = $telefone; // Caso não tenha 11 dígitos, exibe o número como está
                                        }
                                    @endphp
                                    {{$telefoneFormatado}}
                                </p>

                            </p>
                            <hr>
                            {{-- <p><strong>Endereço:</strong></p> --}}
                            <form action="" method="POST">
                                @csrf
                                <button  button type="submit" style="margin-left:110px" class="waves-effect waves-light btn btn-custom">
                                    <strong>Finalizar</strong>
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                <p>Receba pedidos e visualize os prontos para entrega.</p>
                @endif
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
