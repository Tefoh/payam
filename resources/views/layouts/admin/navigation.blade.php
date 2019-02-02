<div id="email-navigation"
     class="email-nav-nano hidden-xs hidden-sm has-scrollbar">
    <div class="email-nav-nano-content" tabindex="0" style="right: -17px;">
        <a href="{{route('home.create')}}"
           class="btn btn-success email-compose-btn">
            <i class="fa fa-pencil-square-o"></i> ارسال پیام
        </a>
        <ul id="email-nav-items" class="clearfix">
            <li>
                <a href="{{route('manage.index')}}">
                    <i class="fa fa-lg fa-users"></i>
                    مدیریت کاربران
                    <span class="label label-default pull-right"></span>
                </a>
            </li>
            <li>
                <a href="{{route('manage.permission')}}">
                    <i class="fa fa-lg fa-address-card-o"></i>
                    مدیریت نقش ها
                </a>
            </li>
            <li>
                <a href="{{route('manage.role')}}">
                    <i class="fa fa-lg fa-lock"></i>
                    مدیریت دسترسی ها
                    <span class="label label-default pull-right"></span>
                </a>
            </li>
            <li>
                <a href="{{route('manage.user.baned')}}">
                    <i class="fa fa-lg fa-ban"></i>
                    کاربران محدود
                    <span class="label label-default pull-right"></span>
                </a>
            </li>
        </ul>
    </div>
</div>