<!DOCTYPE html>
<html lang="en">

<head>
    <title>Que guay! </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    @yield('css')
    <!-- Template Main JS File -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/custom.js"></script>
    @yield('js')
</head>


<body>
    <div class="super_container">
        <!-- Header -->

        <header class="header trans_300">

            <!-- Top Navigation -->
            @include('layouts-landing.navbar-landing')
            <!-- Main Navigation -->

            @include('layouts-landing.main-navigation')
        </header>

        @yield('content')

        <!-- Footer -->
        @include('layouts-landing.footer-landing')


    </div>

    @yield('js')
</body>

</html>