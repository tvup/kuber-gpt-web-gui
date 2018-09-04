@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard - {{ $rule }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(($rule == 'ADMIN') || ($rule == 'MANAGER_RO'))
                    <ul>
                        
                        <li><a href={{route('admin.admin_popolatedb')}}> Apri la dashboard dei certificati</a></li>
                        <li><a href={{route('admin.admin_showallusers')}}> Mostra tutti gli utenti registrati</a></li>
                        
                    </ul>

                    @else
                    
                    <ul>
                        <li><a href="{{ route('user_downloadmycert') }}" class="btn btn-success">
                                Scarica il tuo accesso vpn
                                <i class="fas fa-download"></i>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="https://swupdate.openvpn.org/community/releases/openvpn-install-2.4.6-I602.exe" class="btn btn-info">
                                Scarica il client openVPN
                                <i class="fas fa-download"></i>
                            </a></li>
                        <hr>
                        <li>
                            <a href="#" class="btn btn-primary">
                                Guida - In progress
                                <i class="fas fa-spinner"></i>
                            </a>
                        </li>
                        
                        <hr>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                <button type="submit" class="btn btn-danger">
                                    Logout 
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                                                                    
                                    </form>
                            
                        </li>
                    


                    @endif


                  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
