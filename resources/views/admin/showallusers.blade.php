@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        @include('partials.msg')

        <div class="card">
            <div class="card-header">
                {{__('showallusers.all_registered_users')}}
                <p class="text-right">
                    <a href="{{ action('UserController@new', ['name' => 'Nuovo']) }}" class="btn btn-success">
                        {{__('showallusers.new_user')}}
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
            <div class="card-body">

                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>{{__('showallusers.user')}}</th>
                            <th>{{__('showallusers.name')}}</th>
                            <th>{{__('showallusers.surname')}}</th>
                            <th>{{__('showallusers.CF')}}</th>
                            <th>{{__('showallusers.company')}}</th>
                            <th>{{__('showallusers.e_mail')}}</th>
                            <th>{{__('showallusers.vpn_type')}}</th>
                            <th>{{__('showallusers.action')}}</th>
                            <th>{{__('showallusers.delete')}}</th>
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
                                        <a  href="{{ action('UserController@edit', ['user' => $user]) }}" class="btn btn-success"title="{__('showallusers.edit_user')}}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a  href="{{ action('UserController@show_from_name', ['name' => $user->name]) }}" class="btn btn-success"title="{{__('showallusers.show_user')}}">
                                            <i class="fas fa-user"></i>
                                        </a>
                                    @endif

                                </td>
                                <td>
                                    @if(Auth::user()->isAdmin())
                                    <a href="{{ action('UserController@del', ['user' => $user]) }}" class="btn btn-danger" title="{{__('delete_user')}}">
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
