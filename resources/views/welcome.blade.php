@extends('layouts.app')

@section('content')
    <div id="app" class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <!-- <a href="{{ route('register') }}">Register</a> -->
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                {{ __('welcome.vpn_manager') }}
            </div>
            <div>
                {{ __('welcome.prato_commune') }}
            </div>
            <div class="m-b-md">
                {{ __('welcome.certificate_manager_and_related_users') }}
            </div>

            @guest
                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
            @else
                <a class="btn btn-success" href="{{ route('home') }}"> Dashboard </a>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
@endsection
