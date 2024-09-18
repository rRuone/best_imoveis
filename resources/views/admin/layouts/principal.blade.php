<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Dog</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

{{-- Menu Topo --}}
<nav class="orange darken-4">
    <div class="nav-wrapper container">
        <a href="{{route('home.index')}}" class="brand-logo">Master Dog</a>
            <ul class="right">
                <li><a href="{{ route('home.index') }}">Início</a></li>
                <li><a href="">Pedidos</a></li>
                <li><a href="{{url('/carrinho')}}">Carrinho</a></li>
            </ul>
    </div> 
</nav>

{{-- Conteudo Principal --}}
<div class="container">
    @yield('conteudo-principal')
</div>

<script>
    @if (session('sucesso'))

    M.toast({html: '{{session('sucesso')}}'});


    @endif
</script>
{{-- Conteudo secundário --}}
<div>
    @yield('conteudo-secundario')
</div>
</body>
</html>
