<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
<!--    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

     {!! MaterializeCSS::include_full() !!}


     
</head>
<body>
    
        <!-- Definisco il menu a discesa per pc e mobile --> 
        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            @guest
                <li>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li>
                    <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

        <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Navbar Link</a></li>
                <li><a href="#">Navbar Link2</a></li>
                @guest
                <li>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li>
                    <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <!-- FINE - Definisco il menu a discesa --> 

            <nav class="light-blue lighten-1" role="navigation">
                    <div class="nav-wrapper container">
                        <a id="logo-container" class="brand-logo" 
                            href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                      <ul class="right hide-on-med-and-down">
                        <li><a href="#">Navbar Link</a></li>
                        <li><a href="#">Navbar Link2</a></li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#" data-target="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>
                      </ul>
                
                      
                      <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                          <i class="material-icons">menu</i>
                        </a>
                    </div>
            </nav>

    <div class="section no-pad-bot" id="app">
        <div class="container">
            
                @yield('content')
            
        </div>
    </div>



    <script language="javascript">
            $(".dropdown-trigger").dropdown();
            $('.sidenav').sidenav();
    </script>



</body>


</html>

 
