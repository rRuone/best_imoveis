<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Master Dog') }}</title>

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

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
                    <li><a href="{{ url('/index-itemCardapio') }}">Cardápio</a></li>
                    {{-- <li><a href="{{ url('/admin/products') }}">Produtos</a></li>
                    <li><a href="{{ url('/admin/orders') }}">Pedidos</a></li> --}}
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

        <!-- Dropdown Structure -->
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
            <li><a href="{{ url('/index-itemCardapio') }}">Cardápio</a></li>
            <li><a href="{{ url('/admin/products') }}">Produtos</a></li>
            <li><a href="{{ url('/admin/orders') }}">Pedidos</a></li>
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

        <main class="py-4">
            @yield('content')
        </main>
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
</body>
</html>
