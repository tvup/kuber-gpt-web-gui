@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                @include('partials.msg')
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4>{{__('showallusers.all_registered_users')}}</h4>
                        <a href="{{ action('UserController@create') }}" class="btn btn-success">
                            {{__('showallusers.new_user')}}
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped table-hover">
                            <thead>
                            <tr>
                                <th>{{__('showallusers.user')}}</th>
                                <th>{{__('showallusers.name')}}</th>
                                <th>{{__('showallusers.surname')}}</th>
                                <th>{{__('showallusers.vat_number')}}</th>
                                <th>{{__('showallusers.company')}}</th>
                                <th>{{__('showallusers.e_mail')}}</th>
                                <th>{{__('showallusers.action')}}</th>
                                <th>{{__('showallusers.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.user.show-by-user-name', ['name' => $user->name]) }}"
                                           class="text-primary font-weight-bold">{{$user->name}} </a>
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->vat_number}}</td>
                                    <td>{{$user->company}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ action('UserController@edit', ['user' => $user]) }}"
                                               class="btn btn-warning" title="{{__('showallusers.edit_user')}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.user.show-by-user-name', ['name' => $user->name]) }}"
                                               class="btn btn-info" title="{{__('showallusers.show_user')}}">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <form action="{{ action('UserController@destroy', ['user' => $user]) }}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </form>
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
