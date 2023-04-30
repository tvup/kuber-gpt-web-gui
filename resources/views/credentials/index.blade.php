@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
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
                                <th>{{__('credentials.create')}}</th>
                                <th>{{__('credentials.edit')}}</th>
                                <th>{{__('credentials.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\CredentialsSet::$keys as $credentialKey)
                                @php
                                    $query = $credentials->where('key', $credentialKey);
                                    $hit = $query->count() == 1 && !empty($query->first()?->value);
                                @endphp
                                @if($hit)
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
                                        @if(!$hit)
                                        <td><a class="btn open-create-modal-button" href="javascript:void(0)" data-create_key="{{ $credentialKey }}" data-toggle="modal" data-target="#createKeySet"><i class="fas fa-plus"></i></a></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @else
                                            <td>&nbsp;</td>
                                            <td><a class="btn open-edit-modal-button" href="javascript:void(0)" data-toggle="modal" data-target="#editKeySet" data-edit_name-input="{{$credential?->name}}" data-edit_key-input="{{$credentialKey}}" data-edit_value-input="{{$credential?->value}}"><i class="fas fa-edit"></i></a></td>
                                            <td><a class="btn delete-button" href="javascript:void(0)" data-delete_key="{{ $credentialKey }}"><i class="fas fa-trash"></i></a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="createKeySet" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="createKeySetLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" class="p-6">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCredentialLabel">{{ __('credentials/index.create_credential') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('credentials/index.name') }}</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="key">{{ __('credentials/index.key') }}</label>
                            <input type="text" class="form-control" name="key" id="key" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="value">{{ __('credentials/index.value') }}</label>
                            <input type="text" class="form-control" name="value" id="value">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('credentials/index.close') }}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-credential-button">{{ __('credentials/index.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="editKeySet" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="editKeySetLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" class="p-6">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCredentialLabel">{{ __('credentials/index.update_credential') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">{{ __('credentials/index.name') }}</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" value="">
                        </div>
                        <div class="form-group">
                            <label for="edit_key">{{ __('credentials/index.key') }}</label>
                            <input type="text" class="form-control" name="edit_key" id="edit_key" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit_value">{{ __('credentials/index.value') }}</label>
                            <input type="text" class="form-control" name="edit_value" id="edit_value" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('credentials/index.close') }}</button>
                        <button type="button" id="edit-credential-button" class="btn btn-primary">{{ __('credentials/index.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script type="module">
    document.addEventListener("DOMContentLoaded", () => {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.open-create-modal-button').each(function( index, element )  {
            $(element).on('click', function (e) {
                $('#key').val($(this).data('create_key'));
            });
        } );

        $('#save-credential-button').on('click', function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var key = $('#key').val();
            var value = $('#value').val();
            $.ajax({
                type: "POST",
                url: '{{route('credentials.store')}}',
                data: {name: name, key: key, value: value},
                success: function (data) {
                    Swal.fire(
                        'Techsolutionstuff!',
                        'You clicked the button! <3',
                        'success'
                    ).then(function () { location.reload(); });


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

        $('.open-edit-modal-button').each(function( index, element )  {
            $(element).on('click', function (e) {
                $('#edit_name').val($(this).data('edit_name-input'));
                $('#edit_key').val($(this).data('edit_key-input'));
                $('#edit_value').val($(this).data('edit_value-input'));
            });
        } );

        $('#edit-credential-button').on('click', function (e) {
            e.preventDefault();
            var edit_name = $('#edit_name').val();
            var edit_key = $('#edit_key').val();
            var edit_value = $('#edit_value').val();
            $.ajax({
                type: "PUT",
                url: '{{route('credentials.update')}}',
                data: {name: edit_name, key: edit_key, value: edit_value},
                success: function (data) {
                    Swal.fire(
                        'Techsolutionstuff!',
                        'You clicked the button! <3',
                        'success'
                    ).then(function () { location.reload(); });
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


        $('.delete-button').each(function( index, element )  {
            $(element).on('click', function (e) {
                e.preventDefault();

                var delete_key = $(this).data('delete_key');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: '{{route('credentials.delete')}}',
                            data: {key: delete_key},
                            success: function (data) {
                                Swal.fire(
                                    'Techsolutionstuff!',
                                    'You clicked the button! <3',
                                    'success'
                                ).then(function () {
                                    location.reload();
                                });
                            },
                            error: function () {
                                Swal.fire(
                                    'Techsolutionstuff!',
                                    'Something went to wrong. Please Try again later...!',
                                    'error'
                                )
                            }
                        });
                    }
                });
            });

        });

    });
</script>
