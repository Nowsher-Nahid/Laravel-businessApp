{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts/frontend-layout')
@section('title', 'Login')
@section('content')

<div id="titlebar" class="gradient mb-0"></div>

<div class="container">
	<div class="row">
		<div class="col-xl-6 offset-xl-3">
            <div class="login-register-page">
                <div class="welcome-text">
                    <h3>Reset your password!</h3>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" id="email" placeholder="Email Address" required>
                        @if ($errors->has('email'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" placeholder="New Password" required/>
                        @if ($errors->has('password'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password_confirmation" placeholder="Confirm Password" required/>
                        @if ($errors->has('password'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="button button-sliding-icon ripple-effect margin-top-10 w-100">Reset Password <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>

            </div>
        </div>
	</div>
</div>

<div class="margin-top-70"></div>

@endsection
