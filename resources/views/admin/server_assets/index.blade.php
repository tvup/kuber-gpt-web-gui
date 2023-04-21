@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                @include('partials.msg')
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4>{{__('index.all_server_assets')}}</h4>
                        <a href="{{ route('admin.server_assets.create') }}" class="btn btn-success">
                            {{__('index.new_server_asset')}}
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped table-hover">
                            <thead>
                            <tr>
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
                            @php
                                $collection = collect([
                                    'badge-primary',
                                    'badge-secondary',
                                    'badge-success',
                                    'badge-danger',
                                    'badge-warning',
                                    'badge-info',
                                    'badge-light',
                                    'badge-dark',
                                ]);
                            @endphp
                            @foreach($serverAssets as $serverAsset)
                                <tr>
                                    <td>
                                        <a href="{{ action('ServerAssetController@show', ['server_asset' => $serverAsset]) }}"
                                           class="text-primary font-weight-bold">{{$serverAsset->nick_name}} </a>
                                    </td>
                                    <td>{{$serverAsset->local_ip}}</td>
                                    <td>{{$serverAsset->public_ip}}</td>
                                    <td>
                                        @foreach(is_array($serverAsset->applications) ? $serverAsset->applications : array_filter([$serverAsset->applications]) as $application)
                                            <h5><a href="{{$application['url']}}" class="badge badge-secondary">{{$application['name']}}</a></h5>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(is_array($serverAsset->tags) ? $serverAsset->tags : [$serverAsset->tags] as $tag)
                                            <h5><span class="badge badge-pill {{$collection->random()}}">{{$tag}}</span></h5>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ action('ServerAssetController@edit', ['server_asset' => $serverAsset]) }}"
                                               class="btn btn-warning" title="{{__('index.edit_server_asset')}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ action('ServerAssetController@show', ['server_asset' => $serverAsset]) }}"
                                               class="btn btn-info" title="{{__('index.show_server_asset')}}">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->isAdmin())
                                            <form action="{{action([App\Http\Controllers\ServerAssetController::class, 'destroy'],['server_asset' => $serverAsset])}}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <button class="btn btn-danger">
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </form>
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
