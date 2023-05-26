<!DOCTYPE html>
<html lang="en">

<head>
    <title>Que guay!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    @yield('css')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/easing.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('js')

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .super_container {
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <div class="super_container">
        <header class="header trans_300">
            @include('layouts-landing.navbar-landing')
            @include('layouts-landing.main-navigation')
        </header>

        <div style="margin-top: 8rem; margin-bottom: 5rem">
            @yield('content')
            
            @yield('search_results')
        </div>
    </div>

    <!-- Footer -->
    @include('layouts-landing.footer-landing')

    @yield('js')
</body>

</html>
