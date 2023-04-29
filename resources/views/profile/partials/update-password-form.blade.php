<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150" src="https://plumbr.io/app/uploads/2015/01/thread-lock.jpeg">
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="row mt-2">
                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success" role="alert">
                                    {{ __('editprofile.password_updated') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">{{ __('editprofile.change_password') }}</h4>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="current_password">{{ __('editprofile.current_password') }}</label>
                                    <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="current-password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password">{{ __('editprofile.new_password') }}</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password_confirmation">{{ __('editprofile.confirm_password') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-left">
                            <button class="btn btn-primary">{{ __('editprofile.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
