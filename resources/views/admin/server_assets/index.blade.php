@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                @include('partials.msg')
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4>{{__('index.all_server_assets')}}</h4>
                        <a href="{{ route('admin.server-asset.create') }}" class="btn btn-success">
                            {{__('index.new_server_asset')}}
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped table-hover">
                            <thead>
                            <tr>
                                <th>{{__('index.id')}}</th>
                                <th>{{__('index.nick_name')}}</th>
                                <th>{{__('index.local_ip')}}</th>
                                <th>{{__('index.public_ip')}}</th>
                                <th>{{__('index.applications')}}</th>
                                <th>{{__('index.tags')}}</th>
                                <th>{{__('index.action')}}</th>
                                <th>{{__('index.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($serverAssets as $serverAsset)
                                <tr>
                                    <td>{{$serverAsset->id}}</td>
                                    <td>
                                        <a href="{{ action('ServerAssetController@show', ['serverAsset' => $serverAsset]) }}"
                                           class="text-primary font-weight-bold">{{$serverAsset->nice_name}} </a>
                                    </td>
                                    <td>{{$serverAsset->local_ip}}</td>
                                    <td>{{$serverAsset->public_ip}}</td>
                                    <td>{{$serverAsset->applications}}</td>
                                    <td>{{$serverAsset->tags}}</td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ action('ServerAssetController@edit', ['serverAsset' => $serverAsset]) }}"
                                               class="btn btn-warning" title="{{__('index.edit_server_asset')}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ action('ServerAssetController@show', ['serverAsset' => $serverAsset]) }}"
                                               class="btn btn-info" title="{{__('index.show_server_asset')}}">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ action('ServerAssetController@destroy', ['serverAsset' => $serverAsset]) }}"
                                               class="btn btn-danger" title="{{__('index.delete_server_asset')}}">
                                                <i class="fas fa-user-times"></i>
                                            </a>
                                        @endif
                                    </td>
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
