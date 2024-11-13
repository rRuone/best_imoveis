@extends('admin.layouts.principal')

@section('conteudo-principal')
<div class="container">
    <h4>Detalhes do Pedido #{{ $pedido->id }}</h4>
    <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
    <p><strong>Telefone:</strong>
        @php
        $telefone = $pedido->cliente->telefone;
        if(strlen($telefone) == 11) { 
            $telefoneFormatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
        } else {
            $telefoneFormatado = $telefone;
        }
        @endphp
        {{$telefoneFormatado}}
    </p>

    <p><strong>Tempo de espera:</strong> 40 minutos</p>

    <p><strong>Endereço de entrega:</strong>
        @if($pedido->endereco)
            {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }}, {{ $pedido->endereco->bairro }}
            <br>
            {{ $pedido->endereco->complemento }}
        @else
            Retirar no estabelecimento.
        @endif
    </p>

    <hr>

    <!-- Calcular a taxa de entrega com base no endereço -->
    @php
        $taxaEntrega = 0;
        if (!$pedido->retirar && $pedido->endereco) {
            $bairro = $pedido->endereco->bairro;
            if (in_array($bairro, ['Alvorada', 'Almirante'])) {
                $taxaEntrega = 10.00;
            } elseif (in_array($bairro, ['Santa Cruz', 'Bela Vista'])) {
                $taxaEntrega = 8.00;
            } elseif (in_array($bairro, ['Castrolanda'])) {
                $taxaEntrega = 20.00;
            } else {
                $taxaEntrega = 7.00;
            }
        }
        $totalComTaxa = $pedido->total - $taxaEntrega;
    @endphp

    <!-- Tabela de itens do pedido -->
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Quantidade</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->pedidoItems as $item)
                <tr>
                    <td>{{ $item->quantidade }}</td>
                    <td>
                        {{ $item->itemCardapio->nome }}
                        @if($item->adicionais->isNotEmpty())
                            <ul>
                                @foreach($item->adicionais as $pedidoItemAdicional)
                                    <li>{{ $pedidoItemAdicional->adicional->nome }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>R$ {{ number_format($item->itemCardapio->preco, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <p><strong>SubTotal:</strong> R$ {{ number_format($totalComTaxa, 2, ',', '.') }}</p>
    <p><strong>Taxa de Entrega:</strong> R$ {{ number_format($taxaEntrega, 2, ',', '.') }}</p>
    <p style="font-size: 1.5em; font-weight: bold;">
        <strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}
    </p>

    <hr>

    <p><strong>Método de Pagamento:</strong> {{ ucfirst($pedido->metdPag) }}</p>
    <p><strong>Data de Criação:</strong> {{ \Carbon\Carbon::parse($pedido->data_pedido)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->data_pedido)->format('H:i') }}</p>
    @if($pedido->status == 'finalizado' && $pedido->updated_at)
        <p><strong>Data de Finalização:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('H:i') }}</p>

        <!-- Cálculo do tempo decorrido -->
        @php
            $createdAt = \Carbon\Carbon::parse($pedido->data_pedido);
            $updatedAt = \Carbon\Carbon::parse($pedido->updated_at);
            $tempoDecorridoEmMinutos = $createdAt->diffInMinutes($updatedAt);
            $tempoDecorridoEmHoras = $createdAt->diffInHours($updatedAt);
            $tempoDecorrido = ($tempoDecorridoEmHoras >= 1) ? $tempoDecorridoEmHoras . ' hora(s)' : $tempoDecorridoEmMinutos . ' minuto(s)';
        @endphp
        <p><strong>Tempo Decorrido:</strong> {{ $tempoDecorrido }}</p>
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
</div>

<script>
    setInterval(function() {
        location.reload();
    }, 10000);
</script>
@endsection
