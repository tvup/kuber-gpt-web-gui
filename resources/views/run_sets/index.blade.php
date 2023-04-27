@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                @include('partials.msg')
                <div>
                    <p>Add a run set to prepare the AI</p>
                    <p>Then click launch</p>
                    <p>Hit that F5 - we haven't made the page active yet - you'll be looking for an IP-address to access your ai</p>
                    <p>Happy ai'ing</p>
                </div>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4>{{__('index.all_run_sets')}}</h4>
                        <a href="{{ route('run_sets.create') }}" class="btn btn-success">
                            {{__('index.new_run_set')}}
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped table-hover">
                            <thead>
                            <tr>
                                <th>{{__('index.nick_name')}}</th>
                                <th>{{__('index.created_at')}}</th>
                                <th>{{__('index.public_ip')}}</th>
                                <th>{{__('index.status')}}</th>
                                <th>{{__('index.tags')}}</th>
                                <th>{{__('index.action')}}</th>
                                <th>{{__('index.edit_delete')}}</th>
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
                            @foreach($run_sets as $runSet)
                                <tr>
                                    <td>
                                        <a href="{{ action('RunSetController@show', ['run_set' => $runSet]) }}"
                                           class="text-primary font-weight-bold">{{$runSet->nick_name}} </a>
                                    </td>
                                    <td>{{$runSet->created_at}}</td>
                                    <td><a href="http://{{auth()->user()->running_port . ':50001'}}">{{auth()->user()->running_port . ':50001'}}</a></td>
                                    <td>{{$runSet->status}}</td>
                                    <td>
                                        @foreach(is_array($runSet->tags) ? $runSet->tags : [$runSet->tags] as $tag)
                                            <h5><span class="badge badge-pill {{$collection->random()}}">{{$tag}}</span>
                                            </h5>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{route('conductor.launch',['run_set' => $runSet])}}"
                                            method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button class="btn btn-danger">
                                                <i class="fas fa-user-times">LAUNCH</i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ action('RunSetController@edit', ['run_set' => $runSet]) }}"
                                           class="btn btn-warning" title="{{__('index.edit_run_set')}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ action('RunSetController@show', ['run_set' => $runSet]) }}"
                                           class="btn btn-info" title="{{__('index.show_run_set')}}">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <form
                                            action="{{action([App\Http\Controllers\RunSetController::class, 'destroy'],['run_set' => $runSet])}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button class="btn btn-danger">
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                        </form>
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
