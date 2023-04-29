<section>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="mt-5" width="150" src="https://iconarchive.com/download/i19002/iconshock/vista-general/trash.ico">
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="row mt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">{{ __('editprofile.delete_account') }}</h4>
                        </div>
                    </div>
                    <p>{{ __('editprofile.once_your_account_is_deleted_all_of_its_resources_and_data_will_be_permanently_deleted_before_deleting_your_account_please_download_any_data_or_information_that_you_wish_to_retain') }}</p>
                    <div class="mt-5 text-left">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccount">{{ __('editprofile.delete_account') }}</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="deleteAccountLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteAccountLabel">{{ __('editprofile.are_you_sure_your_want_to_delete_your_account') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('editprofile.once_your_account_is_deleted_all_of_its_resources_and_data_will_be_permanently_deleted_please_enter_your_password_to_confirm_you_would_like_to_permanently_delete_your_account') }}</p>
                                        <div class="form-group">
                                            <label for="password">{{ __('editprofile.password') }}</label>
                                            <input type="password" class="form-control" name="password" id="password_deletion">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('editprofile.close') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('editprofile.delete_account') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
