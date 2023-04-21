@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">{{ __('create.register') }}</div>
                    <div class="card-body">
                        <form method="POST" id="sa-form" action="{{ action('ServerAssetController@store') }}" aria-label="{{ __('create.register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nick_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('create.nick_name') }}</label>
                                <div class="col-md-6">
                                    <input id="nick_name" type="text"
                                           class="form-control{{ $errors->has('nick_name') ? ' is-invalid' : '' }}"
                                           name="nick_name" value="{{ old('nick_name') ? : '' }}"
                                           required autofocus>
                                    @if ($errors->has('nick_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nick_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="local_ip" class="col-md-4 col-form-label text-md-right">{{ __('create.local_ip') }}</label>
                                <div class="col-md-6">
                                    <input id="local_ip" type="text"
                                           class="form-control{{ $errors->has('local_ip') ? ' is-invalid' : '' }}"
                                           name="local_ip" value="{{ old('local_ip') }}" autofocus>
                                    @if ($errors->has('local_ip'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('local_ip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="public_ip" class="col-md-4 col-form-label text-md-right">{{ __('create.public_ip') }}</label>
                                <div class="col-md-6">
                                    <input id="public_ip" type="text"
                                           class="form-control{{ $errors->has('public_ip') ? ' is-invalid' : '' }}"
                                           name="public_ip" value="{{ old('public_ip') }}" autofocus>
                                    @if ($errors->has('public_ip'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('public_ip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="fields"></div>
                            <div class="form-group row mb-0 m-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="add-fields btn btn-dark">
                                        Add one more application
                                    </button>
                                </div>
                            </div>
                            <div class="tag-fields mt-4"></div>
                            <div class="form-group row m-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="add-tag-fields btn btn-dark">
                                        Add one more tag
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('create.register') }}
                                    </button>
                                    <a href="{{ action([\App\Http\Controllers\ServerAssetController::class, 'index']) }}"
                                       class="btn btn-primary">
                                        {{ __('create.reset') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/x-templates" id="fields-templates">
        <div class="form-group row input-fields">
            <label for="applications" class="col-md-4 col-form-label text-md-right">{{ __('edit.name') }}</label>
            <div class="col-md-6">
                <input name="applications[REPLACE_ME][name]" placeholder="name" class="form-control">
            </div>
            <label for="applications" class="col-md-4 col-form-label text-md-right">{{ __('edit.url') }}</label>
            <div class="col-md-6">
                <input name="applications[REPLACE_ME][url]" placeholder="url" class="form-control">
            </div>
            <div class="col-md-6 offset-md-4">
                <button type="button" class="remove-fields">
                    Remove these fields
                </button>
            </div>
        </div>
    </script>

    <script type="text/x-templates" id="tag-fields-templates">
        <div class="form-group row input-tag-fields">
            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('edit.tag') }}</label>
            <div class="col-md-6">
                <input name="tags[]" placeholder="tag" class="form-control">
            </div>
            <div class="col-md-6 offset-md-4">
                <button type="button" class="remove-tag-fields">
                    Remove this field
                </button>
            </div>
        </div>
    </script>

    <script type="module">
        let i = 0
        $(function () {
            const FIELDS_TEMPLATE = $('#fields-templates').text();
            const TAG_FIELDS_TEMPLATE = $('#tag-fields-templates').text();
            let $form = $('#sa-form');
            let $fields = $form.find('.fields');
            let $tagFields = $form.find('.tag-fields');

            $form.on('click', '.add-fields', function () {
                let newInputSet = FIELDS_TEMPLATE.replaceAll('REPLACE_ME', i);
                $fields.append($(newInputSet));
                i++;
            });

            $form.on('click', '.remove-fields', function (event) {
                $(event.target).closest('.input-fields').remove();
                i--;
            });

            $form.on('click', '.add-tag-fields', function () {
                $tagFields.append($(TAG_FIELDS_TEMPLATE));
                i++;
            });

            $form.on('click', '.remove-tag-fields', function (event) {
                $(event.target).closest('.input-tag-fields').remove();
                i--;
            });
        });
    </script>
@endsection

