<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"> {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
                <div class="input-group mb-3">
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Email Password Reset Link') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
    <!-- Session Status -->
</x-guest-layout>
