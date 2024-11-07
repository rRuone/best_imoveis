<div>
    <ul>
        @foreach($enderecos as $endereco)
            <li>
                <label>
                    <input type="radio" name="endereco_id" wire:click="atualizarEndereco({{ $endereco->id }})"
                        @if($enderecoSelecionado == $endereco->id) checked @endif />
                    <span>{{ $endereco->logradouro }} - {{$endereco->numero}},  {{ $endereco->bairro }}</span>
                </label>
            </li>
        @endforeach
    </ul>

    <div>
        Retirada 
    </div>
    
</div>