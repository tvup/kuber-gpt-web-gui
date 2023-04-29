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
                                        <td><a class="btn" href="{{ route('credentials.store') }}" data-toggle="modal" data-target="#createKeySet"><i class="fas fa-plus"></i></a></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @else
                                            <td>&nbsp;</td>
                                            <td><a class="btn" href="{{ route('credentials.update') }}"><i class="fas fa-edit"></i></a></td>
                                            <td><a class="btn" href="{{ route('credentials.delete') }}"><i class="fas fa-trash"></i></a></td>
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

    <div class="mt-5 text-left">
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAccount">{{ __('editprofile.delete_account') }}</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createKeySet" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="createKeySetLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountLabel">{{ __('editprofile.are_you_sure_your_want_to_delete_your_account') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('editprofile.once_your_account_is_deleted_all_of_its_resources_and_data_will_be_permanently_deleted_please_enter_your_password_to_confirm_you_would_like_to_permanently_delete_your_account') }}</p>
                        <div class="form-group">
                            <label for="password">{{ __('editprofile.password') }}</label>
                            <input type="password" class="form-control" name="password" id="password_deletion">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('editprofile.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('editprofile.delete_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script type="module">
    $.ajax({
        url: '{{route('credentials.store')}}',
        type: 'post',
        cache: false,
        success: function(data) {
            stream = data;
        },
        error: function() {
            alert('Something went to wrong.Please Try again later...');
        }
    })
</script>
