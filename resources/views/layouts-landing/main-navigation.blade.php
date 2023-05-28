<head>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toggle Hamburger -->
    <script>
        $(document).ready(function() {
            $('.hamburger_container').click(function() {
                $(this).toggleClass('open');
                $('.navbar_menu').toggleClass('show');
            });
        });
    </script>


</head>

<div class="main_nav_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
              
                <div class="logo_container">
                    <a href="{{ route('home-landing') }}">
                        <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img"
                            style="max-height: 3rem;" alt="main_logo">
                    </a>
                </div>
                <nav class="navbar">

                    <ul class="navbar_menu">
                        <li><a href="{{ route('men') }}">Hombre</a></li>
                        <li><a href="{{ route('women') }}">Mujer</a></li>
                        <li><a href="{{ route('kids') }}">Niños</a></li>
                        <li><a href="{{ route('accesorie') }}">Accesorios</a></li>
                        <li>
                            <div class="search-container">
                                <form action="{{ route('search') }}" method="POST" class="search_form">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="query" class="form-control" placeholder="Buscar"
                                            aria-label="Buscar" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary"><i
                                                    class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar_user">

                        <li class="checkout">
                            <a href="{{ route('showcart') }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="checkout_items" class="checkout_items">{{ Cart::count() }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="hamburger_container">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

@yield('search_results')
