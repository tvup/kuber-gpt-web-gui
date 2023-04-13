@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">{{__('home.main_menu')}} - {{ $role }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(($role == \App\Enums\UserRoleEnum::Admin) || ($role == \App\Enums\UserRoleEnum::Manager))
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item"><a href={{route('admin.admin_popolatedb')}}> {{ __('home.open_certificate_dashboard') }}</a></li>
                                <li class="list-group-item"><a href={{route('admin.admin_showallusers')}}> {{ __('home.show_all_registered_users') }}</a></li>

                            </ul>

                        @else

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="{{ route('user_downloadmycert') }}" class="btn btn-success">
                                        {{ __('home.download_vpn_access') }}
                                        <i class="fas fa-download"></i>
                                    </a>
                                </li>
                                <hr>
                                <li class="list-group-item">
                                    <a href="https://swupdate.openvpn.org/community/releases/openvpn-install-2.4.6-I602.exe" class="btn btn-info">
                                        {{ __('home.download_openvpn_client') }}
                                        <i class="fas fa-download"></i>
                                    </a>
                                </li>
                                <hr>
                                <li class="list-group-item">
                                    <a href="#" class="btn btn-primary">
                                        {{__('home.guide_in_progress')}}
                                        <i class="fas fa-spinner"></i>
                                    </a>
                                </li>

                                <hr>
                                <li class="list-group-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('auth.logout') }}
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
