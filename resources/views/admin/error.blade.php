@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">{{ __('Errore:') }}</div>

                    <div class="card-body">

                        <p class="text-danger">
                            {{ $errore }}
                        </p>


                        <div class="form-row text-center">
                            <div class="col-12">
                                <a class="btn btn-primary justify-content-center"
                                   href=" {{ action('CertificateController@popolate_db') }} "> Torna all DashBoard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

