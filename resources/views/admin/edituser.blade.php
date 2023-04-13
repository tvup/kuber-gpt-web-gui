@extends('layouts.app')

@section('content')
    <style>
        .card-header-custom {
            background-color: #007bff;
            color: white;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.msg')

                <div class="card">
                    <div class="card-header card-header-custom">{{ __('edituser.register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.admin_updateuser',['user' => $user]) }}" aria-label="{{ __('edituser.save') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('edituser.user_matches_the_certificate') }}</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ $user->user_name }}" required autofocus readonly>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('edituser.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('edituser.surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname }}" autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vat_number" class="col-md-4 col-form-label text-md-right">{{ __('edituser.vat_number') }}</label>

                                <div class="col-md-6">
                                    <input id="vat_number" type="text" class="form-control{{ $errors->has('vat_number') ? ' is-invalid' : '' }}" name="vat_number" value="{{ $user->vat_number }}" autofocus>

                                    @if ($errors->has('vat_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vat_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('edituser.company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $user->company }}" autofocus>

                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('edituser.email_address_unique') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}"  required readonly>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('edituser.save') }}
                                    </button>
                                    <a class="btn btn-primary justify-content-center" href=" {{ action('UserController@index') }} "> {{__('edituser.go_back_to_users')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
