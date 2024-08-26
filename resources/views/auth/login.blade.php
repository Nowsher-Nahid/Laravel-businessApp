{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Login')
@section('content')

<div id="titlebar" class="gradient mb-0"></div>

<div class="container">
	<div class="row">
		<div class="col-xl-6 offset-xl-3">
            <div class="login-register-page">
                <div class="welcome-text">
                    <h3>We're glad to see you again!</h3>
                    <span>Don't have an account? <a href="{{ route('register') }}">Sign Up!</a></span>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" id="email" placeholder="Email Address" required/>
                        @if ($errors->has('email'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
                        @if ($errors->has('password'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="text-end">
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="button button-sliding-icon ripple-effect margin-top-10 w-100">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>

                <div class="social-login-separator"><span>or</span></div>
                <div class="social-buttons margin-top-30">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('auth.facebook') }}" class="btn btn-block facebook">Facebook</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('auth.google') }}" class="btn btn-block google">Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="margin-top-70"></div>

@endsection