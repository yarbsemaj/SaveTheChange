<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    @auth
        <ul class="nav navbar-nav">
            <li class=" @if(Route::currentRouteName() == "home")active @endif"><a
                        href="{{ route('home') }}">{{_t("Home")}}</a>
            </li>
        </ul>
@endauth
<!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if(!validateUserCurrentUser())
            <li><a href="{{ route('login') }}">{{_t("Login")}}</a></li>
            <li><a href="{{ route('register') }}">{{_t("Register")}}</a></li>
        @else
            @endif
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false" aria-haspopup="true">
                    {{getCurrentUser()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{"Logout"}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endguest
    </ul>
</div>