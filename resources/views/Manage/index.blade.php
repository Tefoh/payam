@extends('layouts.mail')

@section('header')

    <div class="row">
        <div class="col-lg-12">
            <div id="email-header-mobile" class="visible-xs visible-sm clearfix">
                <div id="email-header-title-mobile" class="pull-left">
                    <i class="fa fa-inbox"></i> صندوق
                </div>
                <a href="{{route('home.send')}}" class="btn btn-success email-compose-btn pull-right">
                    <i class="fa fa-pencil-square-o"></i> مدیریت کاربران
                </a>
            </div>
            <header id="email-header" class="clearfix">
                <div id="email-header-title" class="visible-md visible-lg">
                    <i class="fa fa-users"></i> مدیریت کاربران
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
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button onclick="event.preventDefault();" @click="banUsers"
                                id="spam" class="btn btn-primary" type="button" title="محدود کردن" data-toggle="tooltip"
                                data-placement="bottom">
                            <i class="fa fa-exclamation-circle"></i>
                        </button>
                        <button onclick="event.preventDefault();" @click="destroyUsers"
                                id="delete" class="btn btn-primary" type="button" title="پاک کردن" data-toggle="tooltip"
                                data-placement="bottom">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>
                    <!-- roles select for users -->
                    {{--<div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle has-tooltip" type="button"
                                title="برچسب ها">
                            <i class="fa fa-tag"></i> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li id="important">
                                <a href="#"><i class="fa fa-circle" style="color: #0080c0"></i> مهم</a>
                            </li>
                        </ul>
                    </div>--}}
                </div>
                <div style="direction: ltr;">
                    {!! $users->links()  !!}
                </div>
            </header>
        </div>
    </div>
@endsection

@section('navigation')
    @include('layouts.admin.navigation')
@endsection

@section('content')

    <div id="email-content" class="email-content-nano has-scrollbar" style="height: 246px;">
        <div class="email-content-nano-content" style="left: -17px; right: -17px;" tabindex="0">
            <ul id="email-list">
                @foreach($users as $user)
                    <li class="clickable-row" id="mail-{{$user->id}}"
                        data-href="{{route('manage.user.show', $user->id)}}">
                        <div class="chbox">
                            <div class="checkbox-nice">
                                <input id="m-checkbox-{{$user->id}}" type="checkbox" value="{{$user->id}}"
                                       v-model="users">
                                <label for="m-checkbox-{{$user->id}}"></label>
                            </div>
                        </div>
                        <div class="name">
                            {{ $user->name }}
                        </div>
                        <div class="user">
                            {{--{{$user->hasRoles()}}--}}
                            <span class="author-messages"><strong>{{ $user->authorMessages->count() }}</strong> پیام ارسال شده </span>
                            <span class="received-messages"><strong>{{ $user->messages->count() }}</strong> پیام دریافت شده</span>
                        </div>
                        <div class="user-created">
                            <span class="date">{{$user->time()}}</span>
                        </div>
                        <div class="delete-user">
                            <button @click="destroyUser({{$user->id}})">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-user fa-stack-1x"></i>
                                    <i class="fa fa-ban fa-stack-2x has-text-danger"></i>
                                </span>
                            </button>
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
    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    users: [],
                    resUsers: []
                }
            },
            methods: {
                destroyUsers() {
                    axios.delete('{{ route('manage.user.destroy') }}', {
                        deleted: this.users
                    }).then(function (response) {
                        response.data.forEach(function (user) {
                            this.resUsers = user.id
                        })
                    })
                },
                destroyUser(id) {
                    axios.delete('{{ route('manage.user.destroy') }}', {
                        deleted: [id]
                    })
                },
                banUsers() {
                    axios.post('{{ route('manage.user.ban') }}', {
                        ban: this.users
                    }).then(function (response) {
                        response.data.forEach(function (user) {
                            this.resUsers = user.id
                        })
                    })
                }
            }
        })
    </script>
@endsection