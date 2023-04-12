@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


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
                    {{ \Illuminate\Support\Str::random(8) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>




            <div class="card">
                <div class="card-header">{{ __('register.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('register.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('register.user_matches_the_certificate') }}</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') ? : ($user_name ?? '') }}" required {{ isset($user_name) ? 'readonly' : '' }} autofocus>

                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('register.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('register.surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" autofocus>

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
                                <input id="vat_number" type="text" class="form-control{{ $errors->has('vat_number') ? ' is-invalid' : '' }}" name="vat_number" value="{{ old('vat_number') }}" autofocus>

                                @if ($errors->has('vat_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vat_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('register.company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" autofocus>

                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('register.e_mail_address_unique') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('register.privileges') }}</label>

                            <div class="col-md-6">

                                <select id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role"  required autofocus>
                                    <option value="{{ \App\Enums\UserRoleEnum::User->value }}">{{ __('register.'.\App\Enums\UserRoleEnum::User->value) }}</option>
                                    <option value="{{ \App\Enums\UserRoleEnum::Admin->value }}">{{ __('register.'.\App\Enums\UserRoleEnum::Admin->value) }}</option>
                                    <option value="{{ \App\Enums\UserRoleEnum::Manager->value }}">{{ __('register.'.\App\Enums\UserRoleEnum::Manager->value) }}</option>
                                <select>


                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('register.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('register.confirm_password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control password" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="show-password" class="col-md-4 col-form-label text-md-right">{{ __('register.show_password') }}</label>

                            <div class="col-md-1">
                                <input id="show-password" type="checkbox" class="form-control" name="show-password" onchange="myFunction()">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="show-password2" class="col-md-4 col-form-label text-md-right">{{ __('register.show_password') }}</label>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pwdModal">
                                    {{__('register.suggest_password')}}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('register.register') }}
                                </button>
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

<script type="text/javascript">
function myFunction() {
    let x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


</script>
@endsection
