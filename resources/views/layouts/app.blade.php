<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top nvhead">
            <div class="container">

                @if (Auth::guest()) {{--if user is guest, it will change the login, register and logo direct link--}}
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Logo name -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Flexxi') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/') }}">Register</a></li>
                            <li><a href="{{ url('/help') }}">Help</a></li>
                        @else {{--if user is logged in, it will remove the login, register and help and show user name--}}

                            <div class="navbar-header">

                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <!-- Logo name -->
                                <a class="navbar-brand" href="{{ url('/home') }}">
                                    {{ config('app.name', 'Flexxi') }}
                                </a>
                            </div>

                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="nav navbar-nav">
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name }} <span class="caret"></span> {{--display users first name --}}
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>

                                        <a href="{{ url('/profile') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                            Profile
                                        </a>

                                        <form id="profile-form" action="{{ url('/profile') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
