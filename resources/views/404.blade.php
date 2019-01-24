<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title></title>

    <script src="cdn-cgi/apps/head/gmXC2gL9CEI5yG32ZFrDP6Fm73k.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('components/bootstrap/dist/css/bootstrap.min.css')}}" />

    <script src="js/demo-rtl.js"></script>


    <link rel="stylesheet" href="{{asset('css/libs/font-awesome.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/compiled/theme_styles.css')}}" />


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body id="error-page">
<div class="container rtl">
    <div class="row">
        <div class="col-xs-12">
            <div id="error-box">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="error-box-inner">
                            <img src="{{asset('images/error-404-v3.png')}}" alt="پیدا نشد!!!" />
                        </div>
                        <h1>ERROR 404</h1>
                        <p>
                            صفحه مورد نظر پیدا نشد.<br />
                            اگه دنبال صفحه خاصی می گردید به ما خبر دهید
                        </p>
                        <p>
                            بازگشت به <a href="{{route('home')}}">صفحه اصلی</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('components/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js')}}"></script>


<script src="{{asset('js/scripts.js')}}"></script>

</body>

</html>