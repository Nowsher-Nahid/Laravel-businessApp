{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Register')
@section('content')

<div id="titlebar" class="gradient mb-0"></div>

<div class="container margin-top-100">
	<div class="row">
		<div class="col-xl-6 offset-xl-3">
            <div class="login-register-page">
                <div class="welcome-text text-start mb-3">
                    <h3 class="text-center mb-3">Set a New Password!</h3>
                    <span>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</span>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" id="email" placeholder="Email Address" required/>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                        </div>
                    @endif
                    <button type="submit" class="button button-sliding-icon ripple-effect w-100 margin-bottom-80">Email Password Reset Link</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="margin-top-100"></div>

@endsection
