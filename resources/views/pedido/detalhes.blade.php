@extends('admin.layouts.principal')

@section('conteudo-principal')
<div class="container">
    <h4>Detalhes do Pedido #{{ $pedido->id }}</h4>
    <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
    <p><strong>Telefone:</strong>
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

    <!-- Tabela de itens do pedido -->
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Qtd</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->pedidoItems as $item)
                <tr>
                    <td>1</td>
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
    
    <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

    <hr>


    <p><strong>Método de Pagamento:</strong> {{ ucfirst($pedido->metdPag )}}</p>
    <p><strong>Data de Criação:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->data_Pedido)->format('H:i') }}</p>
    @if($pedido->status == 'finalizado' && $pedido->updated_at)
        <p><strong>Data de Finalização:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y') }} - <strong>Horário:</strong> {{ \Carbon\Carbon::parse($pedido->updated_at)->format('H:i') }}</p>

        <!-- Cálculo do tempo decorrido -->
        @php
            $createdAt = \Carbon\Carbon::parse($pedido->data_Pedido);
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
    }, 10000); // Recarrega a página a cada 10 segundos
</script>
@endsection
