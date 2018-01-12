<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GreenHub Farmer</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Montserrat', sans-serif;
                height: 100vh;
                margin: 0;
            }

            h1 {
                font-size: 8vmin;
                background: linear-gradient(to right, #00ff56ff, #3bf0ffff);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .nav {
                font-size: small;
            }

            .nav > a {
                color: #636b6f;
                text-decoration: underline;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if(Route::has('login'))
                <div class="top-right nav">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        Want to join?
                        <a href="{{ route('login') }}">Login</a>
                        or
                        <a href="{{ route('register') }}">register</a>
                        in seconds.
                    @endauth
                </div>
            @endif
            <div class="content">
                <h1 class="m-b-md">GreenHub Farmer</h1>
                <div class="links">
                    <a href="https://docs.greenhubproject.org">Documentation</a>
                    <a href="https://play.google.com/store/apps/details?id=com.hmatalonga.greenhub">BatteryHub</a>
                    <a href="https://www.npmjs.com/package/greenhub-cli">Lumberjack</a>
                    <a href="https://medium.com/greenhub-blog">Blog</a>
                    <a href="https://github.com/greenhub-project">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
