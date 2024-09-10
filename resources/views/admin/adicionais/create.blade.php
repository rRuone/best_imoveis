<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Dog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>
    <section class="section container">
        <h4>Adicionar Adcional</h4>
    @if($errors->any())
    <span style="color: #ff0000">
        @foreach ($errors->all() as $error)
            {{ $error}}<br>
        @endforeach
    </span>
    <br>
    @endif

    <form action="{{route('admin.adicionais.store')}}" method="POST">
        @csrf
        
        <div class='input-field'>
            <label for="nome">Nome do Adicional</label>
            <input type="text" id="nome" name="nome" value="{{old('nome')}}">
        </div>

        <div class="input-field">
            <label for="preco">Preço do Adicional</label>
            <input type="text" id="preco" name="preco" value="{{old('preco')}}">
        </div>
        
        <button type="submit" class="btn waves-effect waves-light">Salvar</button>
    </form>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>