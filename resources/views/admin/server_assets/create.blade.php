@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">{{ __('create.register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('ServerAssetController@store') }}" aria-label="{{ __('create.register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nick_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.nick_name') }}</label>
                                <div class="col-md-6">
                                    <input id="nick_name" type="text"
                                           class="form-control{{ $errors->has('nick_name') ? ' is-invalid' : '' }}"
                                           name="nick_name" value="{{ old('nick_name') ? : '' }}"
                                           required autofocus>
                                    @if ($errors->has('nick_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="local_ip"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.local_ip') }}</label>
                                <div class="col-md-6">
                                    <input id="local_ip" type="text"
                                           class="form-control{{ $errors->has('local_ip') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('local_ip') }}" autofocus>
                                    @if ($errors->has('local_ip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('local_ip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="public_ip"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.public_ip') }}</label>
                                <div class="col-md-6">
                                    <input id="public_ip" type="text"
                                           class="form-control{{ $errors->has('public_ip') ? ' is-invalid' : '' }}"
                                           name="public_ip" value="{{ old('public_ip') }}" autofocus>
                                    @if ($errors->has('public_ip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('public_ip') }}</strong>
                                                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="applications"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.applications') }}</label>
                                <div class="col-md-6">
                                    <input id="applications" type="text"
                                           class="form-control{{ $errors->has('applications') ? ' is-invalid' : '' }}"
                                           name="applications" value="{{ old('applications') }}" autofocus>
                                    @if ($errors->has('applications'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('applications') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tags"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.tags') }}</label>
                                <div class="col-md-6">
                                    <input id="tags" type="text"
                                           class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                                           name="tags" value="{{ old('tags') }}" autofocus>
                                    @if ($errors->has('tags'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('create.register') }}
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
@endsection

