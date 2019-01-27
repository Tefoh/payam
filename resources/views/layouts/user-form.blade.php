<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
        body {
            direction: ltr;
        }
        .container-login100 {
            background: linear-gradient(-135deg, #f8f8f8, #363636);
        }
        .input100 {
            padding: 0 68px 0 30px;
            direction: rtl;
        }
        .symbol-input100 {
            right: 0;
            left: auto;
            padding-right: 35px;
            padding-left: 0;
            direction: rtl;
        }
        .show-pass {
            position: absolute;
            margin-top: -2.4em;
            margin-left: 1em;
        }
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            @yield('content')
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{ asset('js/app.js') }}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>

</body>
</html>