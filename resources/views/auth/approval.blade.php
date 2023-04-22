@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('waiting_for_approval') }}</div>

                    <div class="card-body">
                        {{ __('account_review') }}
                        <br />
                        {{ __('check_back_later') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
