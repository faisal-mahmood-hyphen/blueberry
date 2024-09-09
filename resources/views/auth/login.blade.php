<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Session Status -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username" placeholder="Email" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password"  class="form-control" name="password"
                           required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="row">
                    {{--<div class="col-8">
                        <div class="icheck-primary">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>--}}
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->

            <p class="mb-1">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">I forgot my password</a>
                @endif
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

</x-guest-layout>
