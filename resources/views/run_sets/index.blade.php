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
                                        <a href="{{ route('run_sets.show', ['run_set' => $runSet]) }}"
                                           class="text-primary font-weight-bold">{{$runSet->nick_name}} </a>
                                        <span id="name_label" class="invalid-feedback" role="alert" style="display: none;">
                                            <strong></strong>
                                        </span>
                                    </td>
                                    <td>{{($runSet->ai_self_name) ? : ' '}}</td>
                                    <td><a href="{{route('credentials.index')}}">{{($runSet->id) ? : ' '}}</a></td>
                                    <td>{{$runSet->created_at}}</td>
                                    <td>
                                        <a id="show_public_ip{{$runSet->id}}" href="http://{{$runSet->public_ip ? $runSet->public_ip . ':50001' : auth()->user()->running_port . ':50001'}}">{{$runSet->public_ip ? $runSet->public_ip . ':50001' : auth()->user()->running_port . ':50001'}}</a>
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
                                            <button class="btn btn-danger launch-button" data-name="{{ $runSet->nick_name }}" data-run_set_id="{{ $runSet->id }}"{{ ($runSet->tags && array_key_exists('submitted', $runSet->tags) && $runSet->tags['submitted'] == true) ? 'disabled' : '' }}>
                                                <i class="fas fa-user-times">LAUNCH</i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('run_sets.edit', ['run_set' => $runSet]) }}"
                                           class="btn btn-warning" title="{{__('run_sets/index.edit_run_set')}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('run_sets.show', ['run_set' => $runSet]) }}"
                                           class="btn btn-info" title="{{__('run_sets/index.show_run_set')}}">
                                            <i class="fas fa-user"></i>
                                        </a>
                                        <form
                                                action="{{ route('run_sets.destroy', ['run_set' => $runSet]) }}"
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

            if(Pusher != undefined) {
                var channel = Pusher.subscribe('private-App.User.{{auth()->user()->id}}');
                channel.bind('ip-from-conductor-event', function (data) {
                    var newUrl = 'http://' + data.ip + ':50001';
                    $('#show_public_ip' + data.run_set_id).attr("href", newUrl);
                    $('#show_public_ip' + data.run_set_id).text(newUrl);
                    $("#show_public_ip" + data.run_set_id).find(".fa-spinner").remove();
                    Swal.fire({
                        title: '<strong>AutoGPT is ready!</strong>',
                        html: 'Click button below to access it directly at <a href="' + newUrl + '">' + newUrl + '</a>',
                        icon: 'success',
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, hit it',
                        cancelButtonText: 'No, not now'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open(newUrl);
                        }
                    })
                });
            }


            $('.launch-button').each(function( index, element )  {
                $(element).on('click', function (e) {
                    e.preventDefault();
                    $('.launch-button').prop('disabled', true);

                    var run_set_id = $(this).data('run_set_id');
                    var name = $(this).data('name');
                    $('#show_public_ip'+run_set_id).text('');
                    $('#show_public_ip'+run_set_id).prepend('<i class="fa fa-spinner fa-spin"></i>');

                    $.ajax({
                        type: "POST",
                        url: '{{route('conductor.launch')}}',
                        data: {run_set: run_set_id, name: name},
                        success: function () {
                            Swal.fire(
                                'AutoGPT is on the way!',
                                'It might take 5-10 minutes to become ready. You can see the IP on this page, when it\'s ready',
                                'success'
                            )
                        },
                        error: function (xhr, status, error) {

                            Swal.fire(
                                'Techsolutionstuff!',
                                'Something went to wrong. Please Try again later...!',
                                'error'
                            )
                            $('#name_label').css("display", "block");
                            $('#name_label').find(">:first-child").append(JSON.parse(xhr.responseText).message);
                            $('.launch-button').prop('disabled', false);
                        }
                    });
                });
            } );



        });

    </script>
@endsection
