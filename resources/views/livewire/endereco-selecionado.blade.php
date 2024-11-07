<div>
    <ul>
        @foreach($enderecos as $endereco)
            <li>
                <label>
                    <input type="radio" name="endereco_id" wire:click="atualizarEndereco({{ $endereco->id }})"
                        @if($enderecoSelecionado == $endereco->id && !$retirar) checked @endif />
                    <span>{{ $endereco->logradouro }} - {{$endereco->numero}}, {{ $endereco->bairro }}</span>
                </label>
            </li>
        @endforeach
    </ul>

    <div>
        <label>
            <input type="radio" name="retirar" wire:click="atualizarEndereco('')" @if($retirar) checked @endif />
            <span>Retirada no Balcão</span>
        </label>
    </div>
</div>
