@extends('layouts.mail')

@section('header')

    <div class="row">
        <div class="col-lg-12">
            <div id="email-header-mobile" class="visible-xs visible-sm clearfix">
                <div id="email-header-title-mobile" class="pull-left">
                    <i class="fa fa-inbox"></i> صندوق
                </div>
                <a href="{{route('home.send')}}" class="btn btn-success email-compose-btn pull-right">
                    <i class="fa fa-pencil-square-o"></i> ارسال پیام
                </a>
            </div>
            <header id="email-header" class="clearfix">
                <div id="email-header-title" class="visible-md visible-lg">
                    <i class="fa fa-inbox"></i> صفحه اصلی
                </div>
                <div id="email-header-tools">
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle has-tooltip"
                                type="button">
                            <i id="check-square" class="fa fa-square-o"></i> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a id="checkall" href="#">همه</a></li>
                            <li><a id="uncheckall" href="#">هیچ</a></li>
                            <li><a id="read" href="#">خوانده شده</a></li>
                            <li><a id="unread" href="#">نخوانده</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button id="refresh" class="btn btn-primary" type="button" title="تازه کردن"
                                data-toggle="tooltip" data-placement="bottom">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <button id="spam" class="btn btn-primary" type="button" title="اسپم" data-toggle="tooltip"
                                data-placement="bottom">
                            <i class="fa fa-exclamation-circle"></i>
                        </button>
                        <button id="delete" class="btn btn-primary" type="button" title="پاک کردن" data-toggle="tooltip"
                                data-placement="bottom">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle has-tooltip" type="button"
                                title="برچسب ها">
                            <i class="fa fa-tag"></i> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li id="important">
                                <a href="#"><i class="fa fa-circle" style="color: #0080c0"></i> مهم</a>
                            </li>
                            <li id="work">
                                <a href="#"><i class="fa fa-circle green"></i>کاری</a>
                            </li>
                            <li id="personal">
                                <a href="#"><i class="fa fa-circle red"></i> شخصی</a>
                            </li>
                            <li id="document">
                                <a href="#"><i class="fa fa-circle yellow"></i> اسناد</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="direction: ltr;">
                    {!! $messages->links()  !!}
                </div>
            </header>
        </div>
    </div>
@endsection

@section('content')
    <div id="email-content" class="email-content-nano has-scrollbar" style="height: 246px;">
        <div class="email-content-nano-content" style="left: -17px; right: -17px;" tabindex="0">
            <ul id="email-list">
                @foreach($messages as $message)
                    <li class="{{$message->is_read ? '' : 'unread'}} clickable-row" id="mail-{{$message->id}}"
                        data-href="{{route('home.show', $message->id)}}">
                        <div class="chbox">
                            <div class="checkbox-nice">
                                <input id="m-checkbox-{{$message->id}}" type="checkbox" value="{{$message->id}}">
                                <label for="m-checkbox-{{$message->id}}"></label>
                            </div>
                        </div>
                        <div id="{{$message->id}}" class="star">
                            <a {{$message->isStar()}}></a>
                        </div>
                        <div class="name">
                            {{$message->sender ? $message->sender->name : 'کاربر حذف شده'}}
                        </div>
                        <div class="message">
                            {{$message->labels()}}
                            <span class="subject">{{$message->title}}</span>
                            <span class="body">{!! $message->body !!}</span>
                        </div>
                        <div class="meta-info">

                            <span class="date">{{$message->time()}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{csrf_field()}}
        </div>
        <div class="nano-pane" style="display: none;">
            <div class="nano-slider" style=" transform: translate(0px, 0px);"></div>
        </div>
    </div>

@endsection


@section('scripts')
    @include('partials.ajax')
    <script>
        $(document).ready(function () {
            $('#checkall').click(function () {
                $('#email-list').find('input:checkbox').prop('checked', true);
                $('#check-square').removeClass('fa-square-o').addClass('fa-check-square-o');
            });
        });
        $(document).ready(function () {
            $('#uncheckall').click(function () {
                $('#email-list').find('input:checkbox').prop('checked', false);
                $('#check-square').removeClass('fa-check-circle-o').addClass('fa-square-o');
            });
        })
    </script>

@endsection