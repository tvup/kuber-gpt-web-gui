@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        @include('partials.msg')

        <div class="card">
            <div class="card-header">
                Tutti gli Utenti Registrati
                <p class="text-right">
                    <a href="{{ action('UserController@new', ['name' => 'Nuovo']) }}" class="btn btn-success">
                        Nuovo Utente
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
            <div class="card-body">

                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>CF</th>
                            <th>Societ&agrave;</th>
                            <th>E-Mail</th>
                            <th>Tipo VPN</th>
                            <th>Action</th>
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td> <a href="{{ action('UserController@show_from_name', ['name' => $user->name]) }}" >{{$user->name}} </a></td>
                                <td>{{$user->nome}}</td>
                                <td>{{$user->cognome}}</td>
                                <td>{{$user->cf}}</td>
                                <td>{{$user->societa}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->tipo_vpn}}</td>
                                <td>
                                    @if(Auth::user()->isAdmin())
                                        <a  href="{{ action('UserController@edit', ['user' => $user]) }}" class="btn btn-success"title="Edit Utente">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a  href="{{ action('UserController@show_from_name', ['name' => $user->name]) }}" class="btn btn-success"title="Mostra Utente">
                                            <i class="fas fa-user"></i>
                                        </a>
                                    @endif

                                </td>
                                <td>
                                    @if(Auth::user()->isAdmin())
                                    <a href="{{ action('UserController@del', ['id' => $user->id]) }}" class="btn btn-danger" title="Elimina Utente">
                                        <i class="fas fa-user-times"></i>
                                    </a>

                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        </div>




    </div>
</div>
@endsection
