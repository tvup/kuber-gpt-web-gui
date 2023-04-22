@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    @if(($role == \App\Enums\UserRoleEnum::Admin) || ($role == \App\Enums\UserRoleEnum::Manager))
                        <div class="card-header bg-primary text-white">{{__('home.main_menu')}} - {{ $role }}</div>
                    @else
                        <div class="card-header bg-primary text-white">{{__('home.choose_product')}} - {{ $user->name }}</div>
                    @endif

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(($role == \App\Enums\UserRoleEnum::Admin) || ($role == \App\Enums\UserRoleEnum::Manager))
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item"><a href={{route('admin.admin_popolatedb')}}> {{ __('home.open_certificate_dashboard') }}</a></li>
                                <li class="list-group-item"><a href={{route('admin.users.index')}}> {{ __('home.show_all_registered_users') }}</a></li>

                            </ul>

                        @else

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="{{ route('user.download-user-cert') }}" class="btn btn-success">
                                        {{ __('home.do_it_your_self') }}
                                        <i class="fas fa-download"></i>
                                    </a>
                                </li>
                                <hr>
                                <li class="list-group-item">
                                    <a href="https://swupdate.openvpn.org/community/releases/openvpn-install-2.4.6-I602.exe" class="btn btn-info">
                                        {{ __('home.bronze') }}
                                        <i class="fas fa-download"></i>
                                    </a>
                                </li>
                                <hr>
                                <li class="list-group-item">
                                    <a href="#" class="btn btn-primary">
                                        {{__('home.silver')}}
                                        <i class="fas fa-spinner"></i>
                                    </a>
                                </li>

                                <hr>
                                <li class="list-group-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('home.gold') }}
                                            <i class="fas fa-sign-out-alt"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
