@extends('layouts.user-form')

@section('content')
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{ asset('images/logo.png') }}" alt="IMG">
    </div>


    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        @csrf
        <span class="login100-form-title">
            ثبت نام
        </span>

        <div class="wrap-input100 validate-input" data-validate = "نام خود را وارد کنید.">
            <input id="name" type="text" class="input100" name="name" placeholder="نام" value="{{ old('name') }}" required autofocus>

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "نام کاربری خود را وارد کنید.">
            <input id="username" type="text" class="input100" name="username" placeholder="نام کاربری" value="{{ old('username') }}" required autofocus>

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "ادرس ایمیل خود را وارد کنید.">
            <input id="email" type="text" class="input100" name="email" placeholder="ایمیل" value="{{ old('email') }}" required autofocus>

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input id="password" type="password" class="input100" name="password" placeholder="رمز عبور" required>

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <button class="show-pass" onclick="event.preventDefault();">
                <span data-toggle="#password" class="fa fa-eye toggle-password"></span>
            </button>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input id="password-confirm" type="password" class="input100" name="password_confirmation" placeholder="تایید رمز عبور" required>

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <button class="show-pass" onclick="event.preventDefault();">
                <span data-toggle="#password-confirm" class="fa fa-eye toggle-password"></span>
            </button>

        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                ثبت نام
            </button>
        </div>

        <div class="text-center p-t-12">
            <span class="txt1">
                قبلا ثبت نام کرده اید؟
            </span>
            <a class="txt2" href="{{ route('login') }}">
                وارد شوید
            </a>
        </div>
        @if ($errors->has('name'))
            <span class="help-block alert alert-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

    </form>
@endsection