<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        <div class="container bg-white mt-5 mb-5 rounded">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
                        <span class="font-weight-bold">{{ $user->name }}</span>
                        <span class="text-black-50">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-3 py-5">
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success" role="alert">
                                {{ __('editprofile.profile_updated') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">{{ __('editprofile.profile_settings') }}</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('editprofile.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ __('editprofile.email') }}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('editprofile.language') }}</label>
                            <div class="form-check">
                                <input class="form-check-input" {{ $user->locale === 'en_US' ? 'checked' : '' }} id="localEnUs" type="radio" name="locale" value="en_US">
                                <label class="form-check-label" for="localEnUs">🇺🇸 {{ __('editprofile.english') }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" {{ $user->locale === 'da_DK' ? 'checked' : '' }} id="localeDaDk" type="radio" name="locale" value="da_DK">
                                <label class="form-check-label" for="localeDaDk">🇩🇰 {{ __('editprofile.danish') }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" {{ $user->locale === 'it_IT' ? 'checked' : '' }} id="localeItIt" type="radio" name="locale" value="it_IT">
                                <label class="form-check-label" for="localeDaDk">🇮🇹 {{ __('editprofile.italian') }}</label>
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
