@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    @if(($role == \App\Enums\UserRoleEnum::Admin) || ($role == \App\Enums\UserRoleEnum::Manager))
                        <div class="card-header bg-primary text-white">{{__('home.main_menu')}} - {{ $role }}</div>
                    @else
                        <div class="card-header bg-primary text-white">{{__('home.choose_option')}} - {{ $user->name }}</div>
                    @endif

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <ul class="list-group list-group-flush">

                                <li class="list-group-item"><a href={{route('credentials.index')}}> {{ __('home.open_key_store') }}</a></li>
                                <li class="list-group-item"><a href={{route('run_sets.index')}}> {{ __('home.show_ai_and_run_sets') }}</a></li>

                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
