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
     @livewireStyles
     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

{{-- Menu Topo --}}
<nav>
    <div class="container">
        <div class="nav-wrapper">
                <a href="" class="brand-logo">Best Imoveis</a>
                <ul class="right">
                    <li><a href="">Imóveis</a></li>
                    <li><a href="">Cidades</a></li>
                    <li><a href=""></a></li>
                </ul>
        </div>
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
    @yield('scripts')

{{-- Conteudo secundário --}}
    <div>
        @yield('conteudo-secundario')
    </div>

    @livewireScripts
</body>
</html>
