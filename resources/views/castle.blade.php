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
                        <h1 class="display-4 mb-4 text-primary">{{ __('AUTO-GPT') }}</h1>
                        <p class="lead">Fill in OpenAI API-token, hit the button and soon you'll experience it first
                            hand</p>
                        <div class="form-group row mx-auto">
                            <div class="col">
                                <input id="token" type="text"
                                       class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}"
                                       name="token" value="{{ $user->token }}" autofocus>

                                @if ($errors->has('token'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <style>
                        .btn-shiny {
                            position: relative;
                            overflow: hidden;
                            width: 400px; /* Angiv ønsket bredde */
                            height: 120px; /* Angiv ønsket højde */
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            text-align: center;
                            border-radius: 10px; /* Tilføj en smule afrunding af kanterne */
                            background-color: #4CAF50; /* Angiv ønsket baggrundsfarve */
                            color: #ffffff; /* Angiv ønsket tekstfarve */
                            z-index: 1;
                        }

                        .btn-shiny:before {
                            content: "";
                            position: absolute;
                            top: -50%;
                            left: -50%;
                            width: 200%;
                            height: 200%;
                            background-image: radial-gradient(circle, #ffffff 0%, rgba(255, 255, 255, 0) 60%);
                            transform: rotate(45deg);
                            opacity: 0.5;
                            animation: snowfall 1.5s linear infinite;
                        }

                        .btn-shiny .btn-text {
                            font-size: 24px; /* Angiv ønsket størrelse på teksten */
                        }

                        @keyframes snowfall {
                            0% {
                                transform: rotate(45deg) translateY(-100%);
                                opacity: 0;
                            }
                            100% {
                                transform: rotate(45deg) translateY(100%);
                                opacity: 0.5;
                            }
                        }
                    </style>

                    <div class="d-flex justify-content-center mb-3">
                        <a class="btn btn-success btn-xxl btn-shiny" href="{{ route('home') }}">
                            <span class="btn-text">{{__('GO GO GO!')}}</span>
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><a
                                        href={{route('credentials.index')}}> {{ __('Click here, if you want to check out tokens and keys before hitting that nice, green buttonm') }}</a>
                            </li>
                            <li class="list-group-item"><a
                                        href={{route('run_sets.index')}}> {{ __('Go to overview of instances') }}</a>
                            </li>

                        </ul>
                    </div>
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
