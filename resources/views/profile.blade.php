@extends('layouts.mail')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading row" style="margin:0">
                        <h4 class="col-md-6 pull-left">ویرایش اطلاعات جدید</h4>
                        {!! Form::model($user, ['method'=>'DELETE', 'action'=> ['UserController@destroy', $user->id],'class'=>'col-md-6 form-horizontal','id'=>'destroy-user']) !!}

                        <button class="btn btn-danger pull-right" onclick='return confirm("آیا مطمئن هستید میخواهید این حساب کاربری را پاک کنید؟")'>حذف حساب کاربری</button>

                        {!! Form::close() !!}
                    </div>

                    <div class="panel-body">
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['UserController@update', $user->id], 'files'=>true,'class'=>'form-horizontal','id'=>'edit-user']) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <div class="col-md-6 pull-right">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autocomplete="off" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label for="name" class="col-md-2 control-label pull-right">نام</label>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <div class="col-md-6 pull-right">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" autocomplete="off" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="username" class="col-md-2 control-label pull-right">نام کاربری</label>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-6 pull-right">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="email" class="col-md-2 control-label pull-right">ادرس ایمیل</label>
                            </div>

                            <div class="form-group">

                                <div class="col-md-6 pull-right">
                                    {!! Form::file('profile_photo',['id'=>'profile_photo','accept'=>'image/*']) !!}
                                </div>
                                <label for="profile_photo" class="col-md-2 control-label pull-right">عکس حساب کاربری</label>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <div class="col-md-6 pull-right">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="password" class="col-md-2 control-label pull-right">رمز عبور</label>
                            </div>

                            <div class="form-group">

                                <div class="col-md-6 pull-right">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                                <label for="password-confirm" class="col-md-2 control-label pull-right">تکرار رمز عبور</label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت اطلاعات جدید
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
