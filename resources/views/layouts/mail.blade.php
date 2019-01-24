<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Payam') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme_styles.css') }}">


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="theme-whbl  pace-done">
<div id="app">
    <div id="theme-wrapper" class="rtl">
        <header class="navbar" id="header-navbar">
            <div class="container">
                <a href="{{route('home.index')}}" id="logo" class="navbar-brand">
                    <img src="img/logo.png" alt="" class="normal-logo logo-white" />
                    <img src="img/logo-black.png" alt="" class="normal-logo logo-black" />
                    <img src="img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden" />
                </a>
                <div class="clearfix">
                    <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="nav-no-collapse navbar-right pull-left hidden-sm hidden-xs">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown hidden-xs">
                                <a class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="count">{{$not_read}}</span>
                                </a>
                                <ul class="dropdown-menu notifications-list messages-list">
                                    <li class="pointer">
                                        <div class="pointer-inner">
                                            <div class="arrow"></div>
                                        </div>
                                    </li>
                                    @foreach($threemessages as $message)
                                        <li class="item">
                                            <a href="{{route('home.show',$message->id)}}">
                                                {{--<img src="{{route('home')}}/images/{{$message->sender->profile_photo}}" alt="" />--}}
                                                <span class="content">
                                            <span class="content-headline">
                                            {{$message->sender->name}}
                                            </span>
                                            <span class="content-text">
                                            {!! $message->body !!}
                                            </span>
                                            </span>
                                                <span class="time"><i class="fa fa-clock-o"></i>{{$message->formatDifference()}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-no-collapse pull-right" id="header-nav">
                        <ul class="nav navbar-nav pull-right">
                            <li class="mobile-search">
                                <a class="btn">
                                    <i class="fa fa-search"></i>
                                </a>
                                <div class="drowdown-search">
                                    <form role="search">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="جستجو...">
                                            <i class="fa fa-search nav-search-icon"></i>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown profile-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{route('home')}}/images/{{Auth::user()->profile_photo}}" alt="" />
                                    <span class="hidden-xs">{{Auth::user()->name}}</span> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('user.edit',Auth::id())}}"><i class="fa fa-user"></i>پروفایل</a></li>
                                </ul>
                            </li><li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div id="page-wrapper" class="container nav-small">
            <div class="row">
                <div id="nav-col">

                    <div id="nav-col-submenu"></div>
                </div>
                <div id="content-wrapper" class="email-inbox-wrapper">
                    <div class="row" style="opacity: 1;">
                        <div class="col-lg-12">
                            <div id="email-box" class="clearfix">
                                @yield('header')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="email-navigation" class="email-nav-nano hidden-xs hidden-sm has-scrollbar">
                                            <div class="email-nav-nano-content" tabindex="0" style="right: -17px;">
                                                <a href="{{route('home.create')}}" class="btn btn-success email-compose-btn">
                                                    <i class="fa fa-pencil-square-o"></i> ارسال پیام
                                                </a>
                                                <ul id="email-nav-items" class="clearfix">
                                                    <li>
                                                        <a href="{{route('home.index')}}">
                                                            <i class="fa fa-inbox"></i>
                                                            صندوق
                                                            <span class="label label-default pull-right">{{$count_messages}}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('home.stared')}}">
                                                            <i class="fa fa-star"></i>
                                                            ستاره دار
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('home.posted')}}">
                                                            <i class="fa fa-envelope"></i>
                                                            ارسال شده
                                                            <span class="label label-default pull-right">{{$send}}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('home.deleted')}}">
                                                            <i class="fa fa-trash-o"></i>
                                                            سطل آشغال
                                                            <span class="label label-default pull-right">{{$deleted}}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div id="email-nav-labels-wrapper">
                                                    <div class="navbar-header email-nav-headline">
                                                        <button type="button" class="btn btn-info" style="width: 183px;padding:6px 15px" data-toggle="collapse" data-target="#email-nav-labels" aria-expanded="false" aria-controls="collapse">
                                                            <span style="float:right;">یرچسب ها</span><span id="collapsed" class="glyphicon glyphicon-collapse-down" style="float:left;"></span>
                                                        </button>
                                                    </div>
                                                    <ul id="email-nav-labels" class="clearfix collapse">
                                                        <li>
                                                            <a href="{{route('home.label','important')}}">
                                                                <i class="fa fa-circle " style="color: #0080c0"></i>
                                                                مهم
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('home.label','work')}}">
                                                                <i class="fa fa-circle green"></i>
                                                                کاری
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('home.label','personal')}}">
                                                                <i class="fa fa-circle red"></i>
                                                                شخصی
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('home.label','document')}}">
                                                                <i class="fa fa-circle yellow"></i>
                                                                اسناد
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div id="email-nav-friends-wrapper">
                                                    <div class="navbar-header email-nav-headline" id="btn-friends-wrapper">
                                                        <button type="button" class="btn btn-info" style="width: 183px" data-toggle="collapse" data-target="#email-friends-labels" aria-expanded="true" aria-controls="collapse">
                                                            <span style="float:right;">ارسال سریع نامه </span><span id="collapsed" class="glyphicon glyphicon-collapse-down" style="float:left;"></span>
                                                        </button>
                                                    </div>

                                                    {!! Form::open(['method'=>'GET', 'action'=>'MessageHomeController@create']) !!}
                                                    <ul id="email-friends-labels" class="clearfix collapse row" aria-expanded="true" style="">
                                                        {!! Form::submit('ارسال', ['class'=>'alert alert-success col-md-12']) !!}
                                                        @foreach($users as $user)
                                                            {!! Form::checkbox('users[]', $user->id, false, ['class'=>'col-md-2']) !!}
                                                            <a href="{{route('home.create').'?users[]='.$user->id}}">
                                                                <li class="col-md-10">{{$user->name}}</li>
                                                            </a>
                                                        @endforeach
                                                    </ul>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        @yield('content')
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</body>

</html>