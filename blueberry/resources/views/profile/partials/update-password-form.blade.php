<section>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ __('Update Password') }}</h3>
        </div>
        <div class="row">
            <div class="col-12 m-2">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </div>
        </div>
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
            <div class="card-body">
                <div class="form-group row">
                    <label for="current_password" class="col-sm-2 col-form-label">{{ __('Current Password') }}</label>
                    <div class="col-sm-10">
                        <input id="current_password" name="current_password" type="password" class="form-control" placeholder="{{ __('Current Password') }}" value="" required autofocus autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">{{ __('New Password') }}</label>
                    <div class="col-sm-10">
                        <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('New Password') }}" value="" required autofocus autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                    <div class="col-sm-10">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" value="" required autofocus autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                @if (session('status') === 'password-updated')
                    <div class="alert-success mt-4 p-3">
                        {{ __('Password Updated successfully!') }}</div>
                @endif
            </div>
        </form>
    </div>

</section>
