<div>
    <ul>
        @foreach($enderecos as $endereco)
            <li>
                <label>
                    <input type="radio" name="endereco_id" wire:click="atualizarEndereco({{ $endereco->id }})"
                        @if($enderecoSelecionado == $endereco->id && !$retirar) checked @endif />
                    <span style="font-size: 1.5em;">{{ $endereco->logradouro }} - {{$endereco->numero}}, {{ $endereco->bairro }}</span>
                </label>
            </li>
        @endforeach
    </ul>
     <!-- Botão para cadastrar um segundo endereço -->
     <a href="{{ route('enderecos.create') }}" class="btn-small waves-effect waves-light" style="margin-top: 10px; padding: 0 10px; font-size: 0.9em;">
        Adicionar Novo Endereço
    </a>
    
    <hr style="opacity: 0.3">
    <div>
        <label>
            <input type="radio" name="retirar" wire:click="atualizarEndereco('')" @if($retirar) checked @endif />
            <span style="font-size: 1.5em;">Retirar no estabelecimento</span> <br>
            <span style="font-size: 1.3em;">Travessa Alda De Andrade Krelling, 317 - Morada Do Sol</span>
        </label>
    </div>
</div>
