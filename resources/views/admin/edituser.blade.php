@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            @include('partials.msg')


            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.admin_updateuser',['user' => $user]) }}" aria-label="{{ __('Salva') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User - coincide con il certificato') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus readonly>

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
                                <input id="nome" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nome" value="{{ $user->nome }}" required autofocus>

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
                                <input id="cognome" type="text" class="form-control{{ $errors->has('cognome') ? ' is-invalid' : '' }}" name="cognome" value="{{ $user->cognome }}" required autofocus>

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
                                <input id="cf" type="text" class="form-control{{ $errors->has('cf') ? ' is-invalid' : '' }}" name="cf" value="{{ $user->cf }}" required autofocus>

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
                                    <input id="societa" type="text" class="form-control{{ $errors->has('societa') ? ' is-invalid' : '' }}" name="societa" value="{{ $user->societa }}" required autofocus>
    
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
                                    <option value="TS" {{ ($user->tipo_vpn == 'TS' ? "selected" : "") }} >TS</option>
                                    <option value="FULL" {{ ($user->tipo_vpn == 'FULL' ? "selected" : "") }} >FULL</option>
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
                                    {{ __('Salva') }}
                                </button>
                                <a class="btn btn-primary justify-content-center" href=" {{ action('UserController@index') }} "> Torna su Utenti</a>
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
$(document).ready(function(){
    $('#show-password').on('change', function(){
        $('.password').attr('type',$('#show-password').prop('checked')==true?"text":"password"); 
    });
});
</script>
@endsection
