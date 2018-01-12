<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
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
                        {{ config('app.name', 'GreenHub') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest
                        &nbsp;
                        @else
                            <li class="{{ set_active('dashboard') }}">
                                <a href="{{ url('/dashboard') }}">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="{{ set_active('devices') }}">
                                <a href="{{ url('/devices') }}">
                                    <i class="fa fa-mobile fa-fw" aria-hidden="true"></i>
                                    Devices
                                </a>
                            </li>
                            <li class="{{ set_active('samples') }}">
                                <a href="{{ url('/samples') }}">
                                    <i class="fa fa-cloud-upload fa-fw" aria-hidden="true"></i>
                                    Samples
                                </a>
                            </li>
                            @admin
                            <li class="{{ set_active('members') }}">
                                <a href="{{ url('/members') }}">
                                    <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                                    Members
                                </a>
                            </li>
                            @endadmin
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('settings.account') }}">
                                            <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" @click="showAboutDialog = true">
                                            <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                            About
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <about-dialog v-if="showAboutDialog" @close="showAboutDialog = false"/>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @include('flash')
</body>
</html>
