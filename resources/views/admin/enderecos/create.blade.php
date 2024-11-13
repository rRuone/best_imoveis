@extends('admin.layouts.principal')

@section('conteudo-principal')
    <div class="section container">
        <div class="header-container">
            <h4>Adicione Seu Endereço</h4>
            <hr>
        </div>
        <form action="{{ route('enderecos.store') }}" method="POST">
            @csrf

            <!-- Campo oculto para cliente_id -->
            <input type="hidden" name="cliente_id" value="{{ session('cliente_id') }}" />

            <!-- Campo de seleção para cidades -->
            <div class="input-field">
                <select name="cidades_id" id="cidades_id">
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                    @endforeach
                </select>
                <label for="cidades_id">Cidade</label>
                @error('cidades_id')
                    <span class="helper-text red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de texto para logradouro -->
            <div class="input-field">
                <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}" />
                <label for="logradouro">Rua</label>
                @error('logradouro')
                    <span class="helper-text red-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-field">
                <input type="text" name="numero" id="numero" value="{{ old('numero') }}" />
                <label for="numero">Número</label>    
                @error('numero')
                    <span class="helper-text red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de seleção para bairro -->
            <div class="input-field">
                <select name="bairro" id="bairro">
                    <option value="" disabled selected>Escolha um bairro</option>
                    <option value="Almirante">Almirante</option>
                    <option value="Alvorada">Alvorada</option>
                    <option value="Arapongas">Arapongas</option>
                    <option value="Araucária">Araucária</option>
                    <option value="Centro">Centro</option>
                    <option value="Bailly">Bailly</option>
                    <option value="Bancarios">Bancários</option>
                    <option value="Bela Vista">Bela Vista</option>
                    <option value="Bom Sucesso">Bom Sucesso</option>
                    <option value="Canta Galo">Canta Galo</option>
                    <option value="Castrolanda">Castrolanda</option>
                    <option value="Castroville">Castroville</option>
                    <option value="Dona Helena">Dona Helena</option>
                    <option value="Invernada do Matadouro">Invernada do Matadouro</option>
                    <option value="Nacoes">Nações</option>      
                    <option value="Nossa Senhora das Gracas">Nossa Senhora das Graças</option> 
                    <option value="Morada do Sol">Morada do Sol</option>
                    <option value="Padre Piva">Padre Piva</option>
                    <option value="Pandorf">Pandorf</option>
                    <option value="Primavera">Primavera</option>
                    <option value="Rio Branco">Rio Branco</option>
                    <option value="Santa Cruz">Samambaia</option>     
                    <option value="Santa Cruz">Santa Cruz</option>
                    <option value="Rio Branco">Termas Riveira</option>
                    <option value="Vila do Rosário">Vila do Rosário</option>
                    <option value="Vila Farias">Vila Farias</option>
                    <option value="Vila Frei Mathias">Vila Frei Mathias</option>

                </select>
                <label for="bairro">Bairro</label>
                @error('bairro')
                    <span class="helper-text red-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de texto para complemento -->
            <div class="input-field">
                <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}" />
                <label for="complemento">Complemento</label>
                @error('complemento')
                    <span class="helper-text red-text">{{ $message }}</span>
                @enderror
            </div>

            <button class="btn-small waves-effect waves-light" type="submit">Salvar Endereço</button>
        </form>
    </div>

    <!-- Inicializa o componente select do Materialize -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
@endsection
