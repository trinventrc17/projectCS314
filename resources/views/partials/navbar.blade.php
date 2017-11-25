<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Good Times Movie Lounge
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                    <li><a href="{{ url('expenses') }}">Expenses</a></li>
                    <li><a href="{{ url('posrooms') }}">Rooms</a></li>
                    <li><a href="{{ url('products') }}">Products</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Printables <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/printables/index/sales') }}">Sales</a></li>
                            <li><a href="{{ url('inventories/adjustments') }}">Earnings and Expenses</a></li>
                            <li><a href="{{ url('inventories/trackings') }}">Products</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inventories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
<!--                             <li><a href="{{ url('inventories/receivings') }}">Receivings</a></li>
                            <li><a href="{{ url('inventories/adjustments') }}">Adjustments</a></li> -->
                            <li><a href="{{ url('inventories/trackings') }}">Trackings</a></li>
                            <li><a href="{{ url('stocks') }}">Stocks</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Reports <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('reports/sales') }}">Sales</a></li>
                            <li><a href="{{ url('productsReport') }}">Products</a></li>
                            <li><a href="{{ url('productsReport/rooms') }}">Room</a></li>
                            <li><a href="{{ url('productsReport/earnings') }}">Earnings Summary</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li><a href="{{ url('/users') }}">Users</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('settings/profile') }}">Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>