<div class="row" style="margin-top: 10px">
    <div class="collection mb-0  grey lighten-3"  >
        <h5 class="h5-header">Endereço de entrega:</h5>
        @if($enderecos->isEmpty())
            <a href="{{ route('enderecos.create') }}" class="btn waves-effect waves-light">Adicionar Novo Endereço</a>
        @else
        <ul>
            @foreach($enderecos as $endereco)
                <li>
                    <label>
                        <input type="radio" name="endereco_id" wire:click="atualizarEndereco({{ $endereco->id }})"
                            @if($enderecoSelecionado == $endereco->id && !$retirar) checked @endif />
                        <span style="font-size: 1.5em;">{{ $endereco->logradouro }}, {{$endereco->numero}} - {{ $endereco->bairro }}</span>
                        <br>
                        
                        <a href="#" wire:click.prevent="excluirEndereco({{ $endereco->id }})" 
                            style="margin-left: 10px; color: red; font-size: 1.5em;">
                             <span>Excluir</span>
                        </a>
                        <hr style="opacity: 0.5">
                    </label>
                </li>
            @endforeach
        </ul>
         <!-- Botão para cadastrar um segundo endereço -->
        <a href="{{ route('enderecos.create') }}" class="btn-small waves-effect waves-light" style="margin-top: 10px; padding: 0 10px; font-size: 0.9em;">
            Adicionar Novo Endereço
        </a>
        @endif
        <hr style="opacity: 0.3">
        <div>
            <label>
                <input type="radio" name="retirar" wire:click="atualizarEndereco('')" @if($retirar) checked @endif />
                <span style="font-size: 1.5em; color:black">Retirar no estabelecimento</span> <br>
                <span style="font-size: 1.3em; margin-left: 30px; color:black">Travessa Alda De Andrade Krelling, 317 - Morada Do Sol</span>
            </label>
        </div>
    </div>
</div>

