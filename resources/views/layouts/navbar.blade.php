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
        @guest
            <li><a href="{{ route('login') }}">{{_t("Login")}}</a></li>
            <li><a href="{{ route('register') }}">{{_t("Register")}}</a></li>
        @else
            @if(Auth::user()->location_id != null || hasPermission(11))
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false" aria-haspopup="true">{{_t("Alert")}}
                        <span class="label @if($alerts->count() == 0)label-default @else label-danger @endif">
                                    {{$alerts->count()}}</span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($alerts as $alert)
                            <li>
                                <a href="{{route("runthrough.part_1.jumpIn",["id"=>$alert->id])}}">
                                    {{$alert->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false" aria-haspopup="true">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('user.me') }}">
                            {{_t("My Details")}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{_t("Logout")}}
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