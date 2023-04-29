<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('landing-pages.meta-description') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    @vite(['resources/js/app.js'])
    @yield('css')
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
                        <a class="nav-link" href="{{ route('home') }}">{{__('app.main_menu')}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('credentials.index') }}">{{__('app.key_store')}}</a>
                    </li>
                    @if(auth()->user()->role == \App\Enums\UserRoleEnum::Admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">{{__('app.user_list')}}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('run_sets.index') }}">{{__('app.ai_and_run_sets')}}</a>
                    </li>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('app.login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('app.logout') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('app.profile_edit') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                @guest
                    @include('partials.language_switcher_bootstrap')
                @endguest
            </div>
        </div>
    </nav>

    <main class="py-4">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_message') }}
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="bg-dark text-white py-3 position-fixed bottom-0 w-100">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h4>{{__('app.contact') }}</h4>
                    <ul class="list-unstyled">
                        <li>Dybendal Alle 12, Taastrup</li>
                        <li>{{__('app.phone')}}: 77 77 46 63</li>
                        <li>E-mail: contact@torbenit.dk</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>{{__('app.about_the_project')}}</h4>
                    <p>{{__('app.with_great_thanks_forked_from')}} <a href="https://github.com/MaoX17">MaoX17</a>.<br/> {{__('app.the_graphics_are_by_chatgpt4_who_has_helped_and_been_the_driving_force_behind_it')}}</p>
                </div>
                <div class="col-md-4">
                    <h4>{{__('app.follow')}}</h4>
                    <ul class="list-unstyled social-icons">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="https://github.com/tvup/kuber-gpt-web-gui"><i class="fa-brands fa-github"></i></a></li>
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
<script type="module">
    $(function() {
        $(document).ready(function(){
            $(".alert").slideDown(300).delay(10000).slideUp(300);
        });
    });
</script>
</body>
</html>
