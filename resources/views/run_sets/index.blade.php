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
                <div>
                    <ul>
                        <li>{{__('run_sets/index.add_a_run_set_to_prepare_the_ai')}}</li>
                        <li>{{__('run_sets/index.then_click_launch')}}</li>
                        <li>{{__('run_sets/index.hit_that_f5_we_havent_made_the_page_active_yet_youll_be_looking_for_an_ip_address_to_access_your_ai')}}</li>
                        <li>{{__('run_sets/index.happy_aiing')}}</li>
                    </ul>
                </div>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4>{{__('run_sets/index.all_run_sets')}}</h4>
                        <a href="{{ route('run_sets.create') }}" class="btn btn-success">
                            {{__('run_sets/index.new_run_set')}}
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped table-hover">
                            <thead>
                            <tr>
                                <th>{{__('run_sets/index.nick_name')}}</th>
                                <th>{{__('run_sets/index.ai_self_name')}}</th>
                                <th>{{__('run_sets/index.run_set_id')}}</th>
                                <th>{{__('run_sets/index.created_at')}}</th>
                                <th>{{__('run_sets/index.public_ip')}}</th>
                                <th>{{__('run_sets/index.status')}}</th>
                                <th>{{__('run_sets/index.tags')}}</th>
                                <th>{{__('run_sets/index.action')}}</th>
                                <th>{{__('run_sets/index.edit_delete')}}</th>
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
                                    <td>{{($runSet->ai_self_name) ? : ' '}}</td>
                                    <td><a href="{{route('credentials.index')}}">{{($runSet->id) ? : ' '}}</a></td>
                                    <td>{{$runSet->created_at}}</td>
                                    <td>
                                        <a id="show_public_ip" href="http://{{$runSet->public_ip ? $runSet->public_ip . ':50001' : auth()->user()->running_port . ':50001'}}">{{$runSet->public_ip ? $runSet->public_ip . ':50001' : auth()->user()->running_port . ':50001'}}</a>
                                    </td>
                                    <td>{{$runSet->status}}</td>
                                    <td>
                                        @foreach(is_array($runSet->tags) ? $runSet->tags : [$runSet->tags] as $tag)
                                            <h5><span class="badge badge-pill {{$collection->random()}}">{{$tag}}</span>
                                            </h5>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="run_set_id" value="{{$runSet->id}}">
                                            <button class="btn btn-danger launch-button" data-run_set_id="{{ $runSet->id }}">
                                                <i class="fas fa-user-times">LAUNCH</i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ action('RunSetController@edit', ['run_set' => $runSet]) }}"
                                           class="btn btn-warning" title="{{__('run_sets/index.edit_run_set')}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ action('RunSetController@show', ['run_set' => $runSet]) }}"
                                           class="btn btn-info" title="{{__('run_sets/index.show_run_set')}}">
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

@section('scripts')
    <script type="module">
        document.addEventListener("DOMContentLoaded", () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var channel = Pusher.subscribe('private-my-channel');
            channel.bind('ip-from-conductor-event', function (data) {
                console.log(data.ip);
                var newUrl = 'http://' + data.ip + ':50001';
                $('#show_public_ip').attr("href", newUrl);
                $('#show_public_ip').text(newUrl);
                $("#show_public_ip").find(".fa-spinner").remove();
                console.log(data.ip.ip);
            });


            $('.launch-button').each(function( index, element )  {
                $(element).on('click', function (e) {
                    e.preventDefault();

                    var run_set_id = $(this).data('run_set_id');
                        $('#show_public_ip').text('');
                    $('#show_public_ip').prepend('<i class="fa fa-spinner fa-spin"></i>');

                    $.ajax({
                        type: "POST",
                        url: '{{route('conductor.launch')}}',
                        data: {run_set: run_set_id},
                        success: function () {
                            Swal.fire(
                                'AutoGPT is on the way!',
                                'It might take 5-10 minutes to become ready. You can see the IP on this page, when it\'s ready',
                                'success'
                            )
                        },
                        error: function () {
                            Swal.fire(
                                'Techsolutionstuff!',
                                'Something went to wrong. Please Try again later...!',
                                'error'
                            )
                        }
                    });
                });
            } );



        });

    </script>
@endsection
