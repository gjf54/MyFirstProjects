<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/js/script.js') }}" rel="text/javascript">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>@yield('title')</title>
    <script>

    </script>
</head>

<body>
    <nav>
        <?php
        if (session()->has('user-login')) {
            $name = 'Profile';
            $link = '/profile';
        } else {
            $name = 'Sign In / Up';
            $link = '/registration';
        }
        ?>
        <div class="site-menu row align-items-start">
            <div class="site-menu-item col-sm-6 col-md-3"><a href="/"><span>home</span></a></div>
            <div class="site-menu-item col-sm-6 col-md-3"><a href="/catalog"><span>catalog</span></a></div>
            <div class="site-menu-item col-sm-6 col-md-3"><a href="/"><span>about us</span></a></div>
            <div class="site-menu-item col-sm-6 col-md-3"><a href="<?= $link ?>"><span><?= $name ?></span></a></div>
        </div>
    </nav>
    @yield('content')
</body>

</html>