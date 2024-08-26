{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="role">Role</label><br>
            <select id="role" name="role" class="form-control" required>
                <option value="business_owner">Business Owner</option>
                <option value="customer">Customer</option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="verify_by">Verification Method</label><br>
            <select id="verify_by" name="verify_by" class="form-control" required>
                <option value="email">Email</option>
                <option value="phone_number">Phone Number</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout> --}}

@extends('layouts/frontend-layout')
@section('title', 'Register')
@section('content')

<div id="titlebar" class="gradient mb-0"></div>

<div class="container">
	<div class="row">
		<div class="col-xl-6 offset-xl-3">
            <div class="login-register-page">
                <div class="welcome-text">
                    <h3 style="font-size: 26px;">Let's create your account!</h3>
                    <span>Already have an account? <a href="{{ route('login') }}">Log In!</a></span>
                </div>

                <form action="{{ route('register') }}" method="POST" id="register-account-form">
                @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-feather-user"></i>
                        <input type="text" class="input-text with-border" name="name" placeholder="Enter name" required/>
                        @if ($errors->has('name'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" placeholder="Email Address" required/>
                        @if ($errors->has('email'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left">
                        <i class="icon-line-awesome-phone-square"></i>
                        <input type="text" class="input-text with-border" name="phone" placeholder="Phone number" required/>
                        @if ($errors->has('phone'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
                        @if ($errors->has('password'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password" required/>
                        @if ($errors->has('password'))
                            <p class="text-danger mb-0 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="button button-sliding-icon ripple-effect margin-top-10 w-100">Register <i class="icon-material-outline-arrow-right-alt"></i></button>
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
