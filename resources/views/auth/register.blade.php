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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User - coincide con il certificato') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" required autofocus>

                                @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cognome" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="cognome" type="text" class="form-control{{ $errors->has('cognome') ? ' is-invalid' : '' }}" name="cognome" value="{{ old('cognome') }}" required autofocus>

                                @if ($errors->has('cognome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cognome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cf" class="col-md-4 col-form-label text-md-right">{{ __('CF') }}</label>

                            <div class="col-md-6">
                                <input id="cf" type="text" class="form-control{{ $errors->has('cf') ? ' is-invalid' : '' }}" name="cf" value="{{ old('cf') }}" required autofocus>

                                @if ($errors->has('cf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="societa" class="col-md-4 col-form-label text-md-right">{{ __('Societa') }}</label>
    
                                <div class="col-md-6">
                                    <input id="societa" type="text" class="form-control{{ $errors->has('societa') ? ' is-invalid' : '' }}" name="societa" value="{{ old('societa') }}" required autofocus>
    
                                    @if ($errors->has('societa'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('societa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                        <div class="form-group row">
                            <label for="tipo_vpn" class="col-md-4 col-form-label text-md-right">{{ __('Tipo VPN') }}</label>

                            <div class="col-md-6">
                                
                                <select id="tipo_vpn" class="form-control{{ $errors->has('tipo_vpn') ? ' is-invalid' : '' }}" name="tipo_vpn"  required autofocus>
                                    <option value="TS">TS</option>
                                    <option value="FULL">FULL</option>
                                <select>


                                @if ($errors->has('tipo_vpn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo_vpn') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address - Univoco per login') }}</label>

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
                            <label for="rule" class="col-md-4 col-form-label text-md-right">{{ __('Privilegi') }}</label>

                            <div class="col-md-6">
                                
                                <select id="rule" class="form-control{{ $errors->has('rule') ? ' is-invalid' : '' }}" name="rule"  required autofocus>
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                    <option value="manager_ro">manager read only</option>
                                <select>


                                @if ($errors->has('rule'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rule') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control password" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="show-password" class="col-md-4 col-form-label text-md-right">{{ __('Mostra Password') }}</label>

                            <div class="col-md-1">
                                <input id="show-password" type="checkbox" class="form-control" name="show-password" onchange="myFunction()">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="show-password2" class="col-md-4 col-form-label text-md-right">{{ __('Mostra Password') }}</label>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pwdModal">
                                    Suggerisci una password
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


/*
$(document).ready(function(){
    $('#show-password').on('change', function(){
        $('.password').attr('type',$('#show-password').prop('checked')==true?"text":"password"); 
    });
});
*/
</script>
@endsection
