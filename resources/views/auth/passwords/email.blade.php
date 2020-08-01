@extends('layouts.auth')
@section('title', 'Forget Password')

@section('content')
    <div class="kt-login__forgot" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ __('Reset Password') }}</h3>
            <div class="kt-login__desc">Enter your email to reset your password:</div>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="kt-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <input placeholder="{{ __('E-Mail Address') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="kt-login__actions">
                <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>&nbsp;&nbsp;
                <a href="{{route('login')}}">
                    <button type="button" class="btn btn-light btn-elevate kt-login__btn-secondary">{{__('Login')}}</button>
                </a>
            </div>
        </form>
    </div>
@endsection
