@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center">
                        <h1 class="display-4 mb-4 text-primary">{{ __('welcome.kuber_gpt') }}</h1>
                        <p class="lead">{{ __('welcome.the_world_is_my_playground') }}</p>
                        <p>{{ __('welcome.gpt_manager') }}</p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    @guest
                        <div class="d-flex justify-content-center mb-3">
                            <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                        </div>
                    @else
                        <div class="d-flex justify-content-center mb-3">
                            <a class="btn btn-success mr-2" href="{{ route('home') }}"> {{__('welcome.main_menu')}} </a>
                            <a class="btn btn-primary" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                    <div class="card-footer bg-transparent">
                        <p class="text-muted"> Torben IT ApS </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background: linear-gradient(135deg, #7f7fd5, #86a8e7, #91eae4);
            background-size: 600% 600%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
@endsection
