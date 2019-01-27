@extends('layouts.mail')

@section('header')

    <div class="row">
        <div class="col-lg-12">
            <div id="email-header-mobile" class="visible-xs visible-sm clearfix">
                <div id="email-header-title-mobile" class="pull-left">
                    <i class="fa fa-inbox"></i> صندوق
                </div>
                <a href="{{route('home.create')}}" class="btn btn-success email-compose-btn pull-right">
                    <i class="fa fa-pencil-square-o"></i> ارسال ایمیل
                </a>
            </div>
            <header id="email-header" class="clearfix">
                <div id="email-header-tools">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{{route('home.index')}}">
                            بازگشت به صندوق<i class="fa fa-chevron-left"></i>
                        </a>
                    </div>
                </div>
                <div id="email-header-pagination" class="pull-right hidden-xs">
                    <div class="btn-group pagination pull-right">
                        <div id="pagination-result">
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
@endsection


@section('content')
    <div id="email-detail" class="email-detail-nano has-scrollbar" style="height: 148px;">
        <div class="email-detail-nano-content" tabindex="0" style="right: -17px;">
            <div id="email-detail-inner">
                <div id="email-detail-subject" class="clearfix">
                    <span class="subject">موضوع: {{$message->title}}</span>
                    {{$message->labels()}}
                </div>
                <div id="email-detail-sender" class="clearfix">
                    <div class="picture hidden-xs">
                        <img class="rounded-circle" style="border: 2px solid #0080c0" src="{{$sender ? route('home').'/images/'.$sender->profile_photo : ''}}" alt="">
                    </div>
                    <div class="users">
                        <div class="from clearfix">
                            <div class="name">
                                <span>{{$sender ? $sender->name : 'کاربر حذف شده است'}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tools col-md-5">
                        <div class="date">
                            {{$message->time()}} ({{$message->formatDifference()}})
                        </div>
                        <div class="btns">
                            <button class="btn btn-info" onclick="printDiv('email-body')">
                                <i class="fa fa-print"></i>
                            </button>
                            <div class="btn-group">
                                <a class="btn btn-success" type="button" href="{{route('home.create')}}" onclick="event.preventDefault();
                                                     document.getElementById('get-users').submit();">
                                    <i class="fa fa-mail-reply"></i>
                                </a>
                                <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('home.getUsers')}}" onclick="event.preventDefault();
                                                     document.getElementById('get-users').submit();">
                                            <i class="fa fa-mail-reply"></i> جواب
                                        </a>
                                        <form id="get-users" action="{{route('home.getUsers')}}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="users[]" value="{{ $sender->username }}">
                                        </form>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-mail-forward"></i> ارسال این پیام
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="email-body">
                    {!! $message->body !!}
                </div>

            </div>
        </div>
    </div>



@endsection


@section('scripts')

    <script>

        $(document).ready(function () {
            $('#email-list li > .star > a').on('click', function () {
                $(this).toggleClass('starred');
            });

            $(".has-tooltip").each(function (index, el) {
                $(el).tooltip({
                    placement: $(this).data("placement") || 'bottom'
                });
            });

            setHeightEmailContent();

            initEmailScroller();
        });

        $(window).smartresize(function () {
            setHeightEmailContent();

            initEmailScroller();
        });

        function setHeightEmailContent() {
            if ($(document).width() >= 992) {
                var windowHeight = $(window).height();
                var staticContentH = $('#header-navbar').outerHeight() + $('#email-header').outerHeight();
                staticContentH += ($('#email-box').outerHeight() - $('#email-box').height());

                $('#email-detail').css('height', windowHeight - staticContentH);
            } else {
                $('#email-detail').css('height', '');
            }
        }

        function initEmailScroller() {
            if ($(document).width() >= 992) {
                $('#email-navigation').nanoScroller({
                    alwaysVisible: false,
                    iOSNativeScrolling: false,
                    preventPageScrolling: true,
                    contentClass: 'email-nav-nano-content'
                });

                $('#email-detail').nanoScroller({
                    alwaysVisible: false,
                    iOSNativeScrolling: false,
                    preventPageScrolling: true,
                    contentClass: 'email-detail-nano-content'
                });
            }
        }

    </script>

    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

@endsection