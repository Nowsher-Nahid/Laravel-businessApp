@extends('layouts/frontend-layout')
@section('title', 'Register')
@section('content')

<div id="titlebar" class="gradient mb-0"></div>

<div class="container margin-top-100">
	<div class="row">
		<div class="col-xl-6 offset-xl-3">
            <div class="login-register-page">
                <div class="welcome-text">
                    <h3 style="font-size: 26px;">Let's Verify your account!</h3>
                    <span>Already have an account? <a href="{{ route('login') }}">Log In!</a></span>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('verification.select') }}" method="POST" id="register-account-form">
                @csrf
                <label for="verification_method">Verification Method</label>
                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-check"></i>
                        <select class="input-text with-border" id="verification_method" name="verification_method" style="padding: 0 62px;" required>
                            <option>Select a Method</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                    <button type="submit" class="button button-sliding-icon ripple-effect margin-top-20 w-100 margin-bottom-80">Verify Account <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="margin-top-100"></div>

@endsection
