@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">{{__('credentials.all_credentials')}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th>{{__('credentials.name')}}</th>
                                <th>{{__('credentials.key')}}</th>
                                <th>{{__('credentials.token')}}</th>
                                <th>{{__('credentials.created_at')}}</th>
                                <th>{{__('credentials.updated_at')}}</th>
                                <th>{{__('credentials.edit')}}</th>
                                <th>{{__('credentials.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\CredentialsSet::$keys as $credentialKey)
                                @if ($credentials->has($credentialKey) && !empty($credentials->get($credentialKey)))
                                    <tr class="table-success">
                                @else
                                    <tr class="table-danger">
                                        @endif
                                        @php
                                            $credential = $credentials->where('key', $credentialKey)->first();
                                        @endphp
                                        <td> {{ $credential?->name }}  </td>
                                        <td> {{ $credentialKey }} </td>
                                        <td> {{ $credential?->value }} </td>
                                        <td> {{ $credential?->created_at }} </td>
                                        <td> {{ $credential?->updated_at }} </td>
                                        <td><a href="{{ route('credentials.edit') }} </a></td>
                                        <td><a href="{{ route('credentials.delete') }} </a></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

