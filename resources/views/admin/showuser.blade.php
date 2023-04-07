@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">


            <!-- Modal -->
            <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="pwdModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pwdModalLabel">Password: </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $user->password_clear }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>


            @include('partials.msg')


            <div class="card">
                <div class="card-header">{{ __('showallusers.detail') }} - {{ $user->name }}</div>

                <div class="card-body">
                    <table class="table">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">{{ $user->user_name }}</td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->surname }} </td>
                                <td>{{ $user->cf }} </td>
                                <td>{{ $user->company }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->vpn_type }} </td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pwdModal">
                                       <i class="fas fa-key"></i>
                                    </button>
                                    @if(Auth::user()->isAdmin())
                                        <a  href="{{ action('UserController@edit', ['user' => $user]) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a  href="{{ action('CertificateController@release', ['user' => $user]) }}" class="btn btn-success">
                                            <i class="fas fa-plus"></i>
                                        </a>

                                    @endif
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('showallusers.state')}}</th>
                                <th>{{__('showallusers.expiration')}}</th>
                                <th>{{__('showallusers.revoke')}}</th>
                                <th>{{__('showallusers.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certs as $cert)
                            <tr>
                                <td scope="row"> {{ $cert->stato }} </td>
                                <td>{{ (new \Carbon\Carbon($cert->dt_scadenza))->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($cert->dt_revoca != "")
                                        {{ (new \Carbon\Carbon($cert->dt_revoca))->format('d/m/Y H:i') }}
                                    @endif

                                </td>
                                <td>
                                    @if(Auth::user()->isAdmin())
                                        @if ($cert->stato == "V")
                                            <a href="{{ action('CertificateController@revoke', ['cert' => $cert]) }}" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i></a>
                                            <a href="{{ action('CertificateController@download', ['cert' => $cert]) }}" class="btn btn-success">
                                            <i class="fas fa-download"></i></a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>


                    <div class="form-row text-center">
                        <div class="col-12">
                            <a class="btn btn-primary justify-content-center" href=" {{ action('CertificateController@popolate_db') }} "> {{__('showallusers.return_to_dashboard')}}</a>
                            <a class="btn btn-primary justify-content-center" href=" {{ action('UserController@index') }} "> {{__('showallusers.users')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

