@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            @include('partials.msg')


            <div class="card">
                <div class="card-header">{{ __('edituser.register') }}</div>

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
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cf" class="col-md-4 col-form-label text-md-right">{{ __('CF') }}</label>

                            <div class="col-md-6">
                                <input id="cf" type="text" class="form-control{{ $errors->has('cf') ? ' is-invalid' : '' }}" name="cf" value="{{ $user->cf }}" required autofocus>

                                @if ($errors->has('cf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('edituser.company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $user->company }}" required autofocus>

                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="vpn_type" class="col-md-4 col-form-label text-md-right">{{ __('edituser.vpn_type') }}</label>

                            <div class="col-md-6">

                                <select id="vpn_type" class="form-control{{ $errors->has('vpn_type') ? ' is-invalid' : '' }}" name="vpn_type"  required autofocus>
                                    <option value="TS" {{ ($user->vpn_type == \App\Enums\VPNTypeEnum::TS ? "selected" : "") }} >
                                        {{\App\Enums\VPNTypeEnum::TS->value}}</option>
                                    <option value="FULL" {{ ($user->vpn_type == \App\Enums\VPNTypeEnum::FULL ? "selected" : "") }} >
                                        {{\App\Enums\VPNTypeEnum::FULL->value}}</option>
                                </select>


                                @if ($errors->has('vpn_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vpn_type') }}</strong>
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
