<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
    </div>
    <a href="/dashboard" class="logo"><img src="assets/img/logo_new.png"
                                 height="30px" width="150px"></a>
    <div class="top-nav notification-row">
        <ul class="nav pull-right top-menu">
            @if(Auth::check())
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        {{--<span class="username">{{Sentinel::getUser()->first_name." ".Sentinel::getUser()->last_name}}</span>--}}
                        {{ Auth::user()->first_name." ".Auth::user()->last_name }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li class="">
                            <a href="/change/password"><i class="icon_lock"></i>Change Password</a>
                        </li>

                        <li>
                            <a href=href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon_key_alt"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                        @else
                        <li>
                            <a href="{{ route('login') }}"><i class="icon_lock"></i>Login</a>
                        </li>
                            @endif
                    </ul>
                </li>
            {{--@else--}}
                {{--<li>--}}
                    {{--<a href="/portal/Login">--}}
                        {{--Login--}}
                    {{--</a>--}}
                    {{--@endif</li>--}}

        </ul>
    </div>
</header>