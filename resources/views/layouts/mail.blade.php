<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'قاصدک') }}</title>

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
        @include('layouts.header')
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
                                        @section('navigation')
                                            @include('layouts.navigation')
                                        @show
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