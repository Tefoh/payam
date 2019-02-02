<div id="email-navigation"
     class="email-nav-nano hidden-xs hidden-sm has-scrollbar">
    <div class="email-nav-nano-content" tabindex="0" style="right: -17px;">
        <a href="{{route('home.create')}}"
           class="btn btn-success email-compose-btn">
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
                <button type="button" class="btn btn-info"
                        style="width: 183px;padding:6px 15px"
                        data-toggle="collapse" data-target="#email-nav-labels"
                        aria-expanded="false" aria-controls="collapse">
                    <span style="float:right;">یرچسب ها</span><span
                            id="collapsed"
                            class="glyphicon glyphicon-collapse-down"
                            style="float:left;"></span>
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
            <div class="navbar-header email-nav-headline"
                 id="btn-friends-wrapper">
                <button type="button" class="btn btn-info" style="width: 183px"
                        data-toggle="collapse"
                        data-target="#email-friends-labels" aria-expanded="true"
                        aria-controls="collapse">
                    <span style="float:right;">ارسال سریع نامه </span><span
                            id="collapsed"
                            class="glyphicon glyphicon-collapse-down"
                            style="float:left;"></span>
                </button>
            </div>

            {!! Form::open(['method'=>'POST', 'action'=>'Front\MessageHomeController@getUsers']) !!}
            <ul id="email-friends-labels" class="clearfix collapse row"
                aria-expanded="true" style="">
                {!! Form::submit('ارسال', ['class'=>'alert alert-success col-md-12']) !!}
                @foreach($users as $user)
                    {!! Form::checkbox('users[]', $user->username, false, ['class'=>'col-md-2']) !!}
                    <a>
                        <li class="col-md-10">{{$user->name}}</li>
                    </a>
                    {{--<a href="{{route('home.create').'?users[]='.$user->id}}">
                        <li class="col-md-10">{{$user->name}}</li>
                    </a>--}}
                @endforeach
            </ul>
            {!! Form::close() !!}
        </div>
    </div>
</div>