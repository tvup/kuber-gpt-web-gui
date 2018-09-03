@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
        <div class="card">
            <div class="card-header">Tutti i Certificati</div>
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
                            <th>Stato</th>
                            <th>Scadenza  </th>
                            <th>Revocato </th>
                            <th>User</th>
                            <!--   <th>User ID </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certs as $cert)
                            @if ($cert->stato == 'V')
                                <tr class="table-success">
                            @else 
                                <tr class="table-danger">
                            @endif
                              
                                <!--  <td> {{$cert->id}} </td> -->
                                <td> {{$cert->stato}} </td>
                                <td>{{ (new \Carbon\Carbon($cert->dt_scadenza))->format('d/m/Y') }}</td>
                                <td> {{--$cert->dt_revoca--}} 
                                    @if ($cert->dt_revoca != "")
                                        {{ (new \Carbon\Carbon($cert->dt_revoca))->format('d/m/Y') }}
                                    @endif
                                </td>
                                <td> <a href="{{ action('UserController@show_from_name', ['name' => $cert->user]) }}" >{{$cert->user}} </a></td>
                                <!-- <td> {{$cert->user_id}} </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
            </div>
        </div>
        </div>

        
        <div class="col-md-5">
        <div class="card">
            <div class="card-header">Certificati scaduti e in scadenza</div>

            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                              
                                <th>Stato</th>
                                <th>Scadenza  </th>
                                <th>User</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certs as $cert)
                                @if (($cert->stato == 'V') && ( ((new \Carbon\Carbon($cert->dt_scadenza))->isPast()) || (((new \Carbon\Carbon($cert->dt_scadenza))->isFuture()) && ((new \Carbon\Carbon($cert->dt_scadenza))->isCurrentMonth())) )) 
                                    @if ((new \Carbon\Carbon($cert->dt_scadenza))->isPast())
                                    <tr class="table-danger">
                                    @elseif (((new \Carbon\Carbon($cert->dt_scadenza))->isFuture()) && ((new \Carbon\Carbon($cert->dt_scadenza))->isCurrentMonth()))
                                    <tr class="table-warning">
                                    @endif
                                
                                  <td> {{$cert->stato}} </td>
                                  <td>{{ (new \Carbon\Carbon($cert->dt_scadenza))->format('d/m/Y') }}</td>
                                
                                <td> <a href="{{ action('UserController@show_from_name', ['name' => $cert->user]) }}" >{{$cert->user}} </a></td>
                                
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
