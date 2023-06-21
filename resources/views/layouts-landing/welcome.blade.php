<!DOCTYPE html>
<html lang="en">

<head>
    <title>¡Qué guay!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @yield('css')

    <style>
        html,
        body {
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            margin-top: 8rem;
            margin-bottom: 5rem;
        }

        .footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header class="header trans_300">
            @include('layouts-landing.navbar-landing')
            @include('layouts-landing.main-navigation')
        </header>

        <div class="super_container">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>

        <footer class="footer trans_300">
            @include('layouts-landing.footer-landing')
        </footer>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/easing.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('js')
</body>

</html>
