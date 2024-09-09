<section>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{ __('Profile Information') }}</h3>
        </div>
        <div class="row">
            <div class="col-12 m-2">
                {{ __("Update your account's profile information and email address.") }}
            </div>
        </div>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('profile.update') }}" class="form-horizontal">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" type="text" class="form-control" placeholder="{{ __('Name') }}" value="{{old('name', $user->name)}}" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" value="{{old('email', $user->email)}}" required autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                @if (session('status') === 'profile-updated')
                    <div class="alert-success mt-4 p-3">
                        {{ __('Profile Updated successfully!') }}</div>
                @endif
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</section>
