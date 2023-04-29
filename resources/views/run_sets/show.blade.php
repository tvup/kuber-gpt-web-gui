@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                @include('partials.msg')

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ __('show.detail') }} - {{ $serverAsset->nick_name }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped">
                            <thead>
                            <tr>
                                <th>{{__('show.id')}}</th>
                                <th>{{__('show.local_ip')}}</th>
                                <th>{{__('show.public_ip')}}</th>
                                <th>{{__('show.applications')}}</th>
                                <th>{{__('show.tags')}}</th>
                                <th>{{__('show.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td scope="row">{{ $serverAsset->id }}</td>
                                <td>{{ $serverAsset->local_ip }} </td>
                                <td>{{ $serverAsset->public_ip }} </td>
                                <td>@json($serverAsset->applications)</td>
                                <td>@json($serverAsset->tags) </td>
                                <td class="d-flex">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ action('RunSetController@edit', ['server_asset' => $serverAsset]) }}"
                                           class="btn btn-warning mr-2  ">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{action([App\Http\Controllers\RunSetController::class, 'destroy'],['server_asset' => $serverAsset])}}"
                                              method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-row text-center">
                            <div class="col-12">
                                <a class="btn btn-primary justify-content-center"
                                   href=" {{ action([App\Http\Controllers\RunSetController::class, 'index']) }} "> {{__('show.server_assets')}}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

