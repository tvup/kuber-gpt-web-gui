@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('approval.waiting_for_approval') }}</div>

                    <div class="card-body">
                        {{ __('approval.account_review') }}
                        <br/>
                        {{ __('approval.check_back_later') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
