<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Dog</title>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    @livewireStyles
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('styles')
</head>
<body>

{{-- Menu Topo --}}
<nav class="orange darken-4">
    <div class="nav-wrapper container">
        <a href="{{route('home.index')}}" class="brand-logo">Master Dog</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('home.index') }}">Início</a></li>
            <li><a href="">Pedidos</a></li>
            <li><a href="{{url('/carrinho')}}">Carrinho</a></li>
        </ul>
    </div>
</nav>

{{-- Menu Lateral (Mobile) --}}
<ul class="sidenav" id="mobile-demo">
    <li><a href="{{ route('home.index') }}">Início</a></li>
    <li><a href="">Pedidos</a></li>
    <li><a href="{{url('/carrinho')}}">Carrinho</a></li>
</ul>

{{-- Conteúdo Principal --}}
<div class="container">
    @yield('conteudo-principal')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        M.Sidenav.init(elems);

        @if (session('sucesso'))
        M.toast({html: '{{session('sucesso')}}'});
        @endif
    });
</script>

@yield('scripts')

{{-- Conteúdo Secundário --}}
<div class="container">
    @yield('conteudo-secundario')
</div>

@livewireScripts
</body>
</html>
