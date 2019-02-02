<header class="navbar" id="header-navbar">
    <div class="container">
        <a href="{{route('home.index')}}" id="logo" class="navbar-brand">
            <img src="{{asset('images/logo.png')}}" alt="" class="normal-logo logo-white"/>
            <img src="{{asset('images/logo-black.png')}}" alt="" class="normal-logo logo-black"/>
            <img src="{{asset('images/logo-small.png')}}" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
        </a>
        <div class="clearfix">
            <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse"
                    type="button">
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
                            <img src="{{route('home')}}/images/{{Auth::user()->profile_photo ?? 'user.png'}}" alt=""/>
                            <span class="hidden-xs">{{Auth::user()->name}}</span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('user.edit',Auth::id())}}"><i
                                            class="fa fa-user"></i>پروفایل</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>