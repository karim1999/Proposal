@extends('layouts.auth')

@section('title', 'Register')
@section('content')
    <div class="kt-login__signup" style="display: block">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Sign Up</h3>
            <div class="kt-login__desc">Enter your details to create your account:</div>
        </div>
        <form class="kt-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <input placeholder="{{ __('Name') }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="input-group">
                <input placeholder="{{ __('E-Mail Address') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="input-group">
                <input placeholder="{{ __('Password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="input-group">
                <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
{{--            <div class="row kt-login__extra">--}}
{{--                <div class="col kt-align-left">--}}
{{--                    <label class="kt-checkbox">--}}
{{--                        <input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.--}}
{{--                        <span></span>--}}
{{--                    </label>--}}
{{--                    <span class="form-text text-muted"></span>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="kt-login__actions">
                <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">
                    {{ __('Register') }}
                </button>&nbsp;&nbsp;
                <a href="{{route('login')}}">
                    <button type="button" class="btn btn-light btn-elevate kt-login__btn-secondary">
                        {{ __('Login') }}
                    </button>
                </a>
            </div>
        </form>
    </div>
@endsection
