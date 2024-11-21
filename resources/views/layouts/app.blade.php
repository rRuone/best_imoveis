<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Master Dog') }}</title>

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    @livewireStyles
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        /* Remove underline from links inside list items */
        nav a{
            text-decoration: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="orange darken-4">
            <div class="nav-wrapper container">
                <a href="{{ url('/admin/dashboard') }}" class="brand-logo">{{ config('app.name', 'Master Dog') }}</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdownCardapio">
                            Menu<i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    @endauth

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @endif
                    @else
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <ul id="dropdownCardapio" class="dropdown-content">
            <li><a href="{{ url('/admin/index-adicionais') }}">Adicionais</a></li>
            <li><a href="{{ url('/admin/index-itemCardapio') }}">Cardápio</a></li>
            <li><a href="{{ url('/admin/index-categorias') }}">Categorias</a></li>
            <li><a href="{{ url('/admin/index-cliente') }}">Cliente</a></li>
            <li><a href="{{ url('/admin/dashboard/historico') }}">Histórico</a></li>
            <li><a href="{{ url('/admin/dashboard') }}">Pedidos</a></li>
        </ul>

        <!-- Dropdown Structure for user-->
        <ul id="dropdown1" class="dropdown-content">
            {{-- <li><a href="#!">Meu Perfil</a></li> --}}
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   {{ __('Logout') }}
                </a>
            </li>
        </ul>

        <!-- Mobile Menu -->
        <ul class="sidenav" id="mobile-demo">
            @auth
            <li><a href="{{ url('/admin/index-adicionais') }}">Adicionais</a></li>
            <li><a href="{{ url('/admin/index-item') }}">Cardápio</a></li>
            <li><a href="{{ url('/admin/index-categorias') }}">Categorias</a></li>
            <li><a href="{{ url('/admin/index-cliente') }}">Clientes</a></li>
            <li><a href="{{ url('/admin/dashboard/historico') }}">Histórico</a></li>
            <li><a href="{{ url('/admin/dashboard') }}">Pedidos</a></li>
            @endauth

            @guest
                @if (Route::has('login'))
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @endif
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif
            @else
                <li><a href="#!">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
            @endguest
        </ul>

        {{-- <main class="py-4">
            @yield('content')
        </main> --}}

    </div>
    <div class="container">
        @yield('content')
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Initialize Materialize components -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);

            var dropdownElems = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(dropdownElems, { coverTrigger: false });
        });
    </script>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @livewireScripts
</body>

<style>

.modal {
    width: 90%;

    max-width: 500px;
    padding: 20px;
    border-radius: 8px;
}

.modal-content {
    padding: 15px 24px;
    line-height: 1.6;
    font-size: 16px; /* Tamanho de fonte aumentado */
}

.help-list {
    list-style-type: none;
    padding: 0;
    margin-top: 10px;
}

.help-list li {
    margin-bottom: 8px;
}

.help-list strong {
    color: #1565c0; /* Azul mais suave */
}

.modal-footer {
    padding: 10px;
    display: flex;
    justify-content: flex-end; /* Alinha o botão Fechar à direita */
}

.modal-footer .btn {
    background-color: #757575;
    color: white;
    font-weight: bold;
    padding: 5px 15px;
    text-transform: uppercase; /* Mantém o texto em letras maiúsculas */
}

@media (max-width: 600px) {
    .modal {
        max-width: 100%;
        padding: 10px;
    }
}.modal {
    width: 90%;
    max-width: 600px;
    padding: 20px;
    border-radius: 8px;
}

.modal-content {
    padding: 15px 24px;
    line-height: 1.6;
    font-size: 16px;
}

.help-list {
    list-style-type: none;
    padding: 0;
    margin-top: 10px;
}

.help-list li {
    margin-bottom: 8px;
}

.help-list strong {
    color: #1565c0;
}

.modal-footer {
    padding: 0; /* Remove o padding para diminuir o espaço */
    margin-top: 10px; /* Reduz a distância entre o conteúdo e o botão Fechar */
    display: flex;
    justify-content: flex-end;
}

.modal-footer .btn {
    background-color: #757575;
    color: white;
    font-weight: bold;
    padding: 5px 15px;
    text-transform: uppercase;
    margin: 0; /* Remove margem extra no botão */
}


</style>

</html>
