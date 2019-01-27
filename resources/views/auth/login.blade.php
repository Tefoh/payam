@extends('layouts.user-form')

@section('content')
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{ asset('images/logo.png') }}" alt="IMG">
    </div>

    <form class="ogin100-form validate-form " method="POST" action="{{ route('login') }}">
        @csrf
        <span class="login100-form-title">
            ورود کاربران
        </span>

        <div class="wrap-input100 validate-input" data-validate="نام کاربری خود را وارد کنید.">
            <input id="username" type="text" class="input100" name="username" placeholder="نام کاربری"
                   value="{{ old('username') }}" required autofocus>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input id="password" type="password" class="input100" name="password" placeholder="رمز عبور" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <button class="show-pass" onclick="event.preventDefault();"><span data-toggle="#password" class="fa fa-eye toggle-password"></span></button>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Login
            </button>
        </div>

        <div class="text-center p-t-12">
            <span class="txt1">
                قبلا ثبت نام نکرده اید؟
            </span>
            <a class="txt2" href="{{ route('register') }}">
                حساب کاربری جدید بسازید
            </a>
        </div>

    </form>
@endsection