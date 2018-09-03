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
                <div class="card-header">{{ __('Detail') }} - {{ $user->name }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>CF</th>
                                <th>Societ&agrave;</th>
                                <th>E-Mail</th>
                                <th>TipoVPN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">{{ $user->name }}</td>
                                <td>{{ $user->nome }} </td>
                                <td>{{ $user->cognome }} </td>
                                <td>{{ $user->cf }} </td>
                                <td>{{ $user->societa }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->tipo_vpn }} </td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pwdModal">
                                       V. Password
                                    </button>
                                    @if(Auth::user()->isAdmin())
                                        <a  href="{{ action('CertificatoController@release', ['user' => $user]) }}" class="btn btn-success">
                                            <i class="fas fa-plus"></i></a>
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Stato</th>
                                <th>Scadenza</th>
                                <th>Revoca</th>
                                <th>Action</th>
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
                                            <a href="{{ action('CertificatoController@revoke', ['cert' => $cert]) }}" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i></a>
                                        @endif
                                    @endif
                                </td>
                            </tr>    
                            @endforeach
                            
                        </tbody>
                    </table>


                    <div class="form-row text-center">
                        <div class="col-12">
                            <a class="btn btn-primary justify-content-center" href=" {{ action('CertificatoController@popolate_db') }} "> Torna all DashBoard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

