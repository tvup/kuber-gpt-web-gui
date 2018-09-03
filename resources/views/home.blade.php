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

                    {{$rule}}
                    @if(($rule == 'ADMIN') || ($rule == 'MANAGER_RO'))
                    <ul>
                        
                        <li><a href={{route('admin.admin_popolatedb')}}> Apri la dashboard dei certificati</a></li>
                        <li><a href={{route('admin.admin_showallusers')}}> Mostra tutti gli utenti registrati</a></li>
                        
                    </ul>

                    @else
                    
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    


                    @endif


                  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
