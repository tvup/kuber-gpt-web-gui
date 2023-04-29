@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <!-- Modal -->
                <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="pwdModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pwdModalLabel">{{ __('Password') }}:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ $user->password_clear }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                @include('partials.msg')

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ __('showallusers.detail') }} - {{ $user->name }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped">
                            <thead>
                            <tr>
                                <th>{{__('showallusers.name')}}</th>
                                <th>{{__('showallusers.vat_number')}}</th>
                                <th>{{__('showallusers.company')}}</th>
                                <th>{{__('showallusers.e_mail')}}</th>
                                <th>{{__('showallusers.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->vat_number }} </td>
                                <td>{{ $user->company }} </td>
                                <td>{{ $user->email }} </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#pwdModal">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ action('UserController@edit', ['user' => $user]) }}"
                                           class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ action('CertificateController@release', ['user' => $user]) }}"
                                           class="btn btn-success">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-responsive-md table-striped">
                            <thead>
                            <tr>
                                <th>{{__('showallusers.state')}}</th>
                                <th>{{__('showallusers.expiration')}}</th>
                                <th>{{__('showallusers.revoke')}}</th>
                                <th>{{__('showallusers.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->credentialsSets as $certificate)
                                <tr>
                                    <td scope="row"> {{ Str::title($certificate->status->value) }}
                                    </td>
                                    <td>{{ (new \Carbon\Carbon($certificate->expires_at))->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if ($certificate->revoked_at != "")
                                            {{ (new \Carbon\Carbon($certificate->revoked_at))->format('d/m/Y H:i') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            @if ($certificate->status == \App\Enums\CredentialTypeEnum::V)
                                                <a href="{{ action('CertificateController@revoke', ['certificate' => $certificate]) }}"
                                                   class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i></a>
                                                <a href="{{ action('CertificateController@download', ['certificate' => $certificate]) }}"
                                                   class="btn btn-success">
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
                                <a class="btn btn-primary justify-content-center"
                                   href=" {{ action('CertificateController@popolate_db') }} "> {{__('showallusers.return_to_dashboard')}}</a>
                                <a class="btn btn-primary justify-content-center"
                                   href=" {{ action('UserController@index') }} "> {{__('showallusers.users')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

