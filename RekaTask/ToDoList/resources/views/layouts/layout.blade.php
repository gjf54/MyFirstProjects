<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/styles/layouts/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/styles/main.css') }}">
    @yield('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    @yield('scripts')
    <title>@yield('title')</title>
</head>

<body>
    <div class="container">
        <nav>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <a href="{{ route('welcome_page') }}" id="nav_title_link"><span id="nav_title">My ToDo</span></a>
                </div>
                <div class="col-md-3 col-sm-4 nav_item">
                    <a href="#"><span>Describes</span></a>
                </div>
                <div class="col-md-3 col-sm-4 nav_item">
                    <a href="#"><span>About</span></a>
                </div>
                <div class="col-md-3 col-sm-4 nav_item">
                    @if(session()->has('user_login'))
                    <a href="{{ route('profile') }}"><span>{{ __('Profile') }}</span></a>
                    @else
                    <a href="{{ route('login') }}"><span>{{ __('Log in') }}</span></a>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
</body>

</html>