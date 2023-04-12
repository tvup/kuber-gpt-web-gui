@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{__('certdashboard.all_certificates')}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>{{__('certdashboard.state')}}</th>
                                <th>{{__('certdashboard.expiration')}}  </th>
                                <th>{{__('certdashboard.revoked')}} </th>
                                <th>{{__('certdashboard.user')}}</th>
                                <!--   <th>User ID </th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certificates as $certificate)
                                @if ($certificate->status == \App\Enums\StatusEnum::V)
                                    <tr class="table-success">
                                @else
                                    <tr class="table-danger">
                                        @endif

                                        <!--  <td> {{$certificate->id}} </td> -->
                                        <td> {{ Str::title($certificate->status->value) }} </td>
                                        <td>{{ (new \Carbon\Carbon($certificate->expires_at))->format('d/m/Y') }}</td>
                                        <td> {{--$cert->dt_revoca--}}
                                            @if ($certificate->revoked_at != "")
                                                {{ (new \Carbon\Carbon($certificate->revoked_at))->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        @if($certificate->user)
                                            <td>
                                                <a href="{{ action('UserController@show_from_name', ['name' => rawurlencode($certificate->user->user_name)]) }}">{{$certificate->user->user_name}} </a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ action('UserController@new', ['name' => rawurlencode($certificate->cert)]) }}">{{$certificate->cert}} </a>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{__('certdashboard.expired_and_expiring_certificates')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>

                                <th>{{__('certdashboard.state')}}</th>
                                <th>{{__('certdashboard.expiration')}}  </th>
                                <th>{{__('certdashboard.user')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certificates as $certificate)
                                @if (($certificate->status == 'V') && ( ((new \Carbon\Carbon($certificate->expires_at))->isPast()) || (((new \Carbon\Carbon($certificate->expires_at))->isFuture()) && ((new \Carbon\Carbon($certificate->expires_at))->isCurrentMonth()) && ((new \Carbon\Carbon($certificate->expires_at))->isCurrentYear()) ) ))
                                    @if ((new \Carbon\Carbon($certificate->dt_scadenza))->isPast())
                                        <tr class="table-danger">
                                    @elseif (((new \Carbon\Carbon($certificate->expires_at))->isFuture()) && ((new \Carbon\Carbon($certificate->expires_at))->isCurrentMonth()))
                                        <tr class="table-warning">
                                            @endif

                                            <td> {{$certificate->status}} </td>
                                            <td>{{ (new \Carbon\Carbon($certificate->expires_at))->format('d/m/Y') }}</td>

                                            <td>
                                                <a href="{{ action('UserController@show_from_name', ['name' => $certificate->user]) }}">{{$certificate->user}} </a>
                                            </td>

                                        </tr>
                                    @endif
                                    @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
