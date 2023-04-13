<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center;">
                @switch(config('app.env'))
                    @case('local')
                        <span class="badge badge-danger">LOCAL</span>
                        @break
                    @case('testing')
                        <span class="badge badge-warning">TESTING</span>
                        @break
                    @case('staging')
                        <span class="badge badge-primary">STAGING</span>
                        @break
                    @case('demo')
                        <span class="badge badge-info">DEMO</span>
                        @break
                    @case('production')
                        @break
                    @default
                        <span class="badge badge-dark">UNKNOWN ENV</span>
                @endswitch
                <span class="app-name" style="margin-left: 5px;">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Main menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.admin_popolatedb') }}">Certificate dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">User list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.server_assets.index') }}">Server assets</a>
                    </li>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->user_name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="bg-dark text-white py-3 position-fixed bottom-0 w-100">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contact</h4>
                    <ul class="list-unstyled">
                        <li>Dybendal Alle 12, Taastrup</li>
                        <li>Phone: 77 77 46 63</li>
                        <li>E-mail: contact@torbenit.dk</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>About the project</h4>
                    <p>With great thanks forked from <a href="https://github.com/MaoX17">MaoX17</a>.<br/> The graphics are by ChatGPT4 who has helped and been the driving force behind it.</p>
                </div>
                <div class="col-md-4">
                    <h4>Follow</h4>
                    <ul class="list-unstyled social-icons">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>2023 Torben IT ApS</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</div>

@yield('scripts');

</body>
</html>
