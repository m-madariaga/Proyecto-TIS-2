<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/easing.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.hamburger_container').click(function() {
                $(this).toggleClass('open');
                $('.navbar_menu').toggleClass('show');
            });

            $('.search_form').submit(function(e) {
                e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

                var query = $('#search-input').val()
            .trim(); // Obtiene el valor del campo de búsqueda y elimina los espacios en blanco

                if (query !== '') { // Verifica si el campo de búsqueda no está vacío
                    $(this).unbind('submit').submit(); // Envía el formulario de búsqueda
                }
            });
        });
    </script>
    @yield('js')
</body>

</html>
