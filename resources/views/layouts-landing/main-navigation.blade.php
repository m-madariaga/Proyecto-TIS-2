<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Enlace a la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

</head>

<div class="main_nav_container px-4">
    <div class="row ">
        <div class="col-md-4 col-6">
            <div class="logo_container">
                <a href="{{ route('home-landing') }}">
                    @foreach ($images as $imagen)
                        <img src="{{ asset("imagen_logo/$imagen->nombre_imagen") }}" class="navbar-brand-img"
                            style="max-height: 3rem;" alt="logo">
                    @endforeach
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6 text-center">
            <div class="navbar">
                <ul class="navbar_menu">

                    @foreach ($sections as $section)
                        @if ($section->visible === 1)
                            <li class="nav-item">
                                @if (strtolower($section->nombre) === 'mujer')
                                    <a class="nav-link" href="{{ route('women') }}">{{ $section->nombre }}</a>
                                @elseif (strtolower($section->nombre) === 'hombre')
                                    <a class="nav-link" href="{{ route('men') }}">{{ $section->nombre }}</a>
                                @elseif (strtolower($section->nombre) === 'niños')
                                    <a class="nav-link" href="{{ route('kids') }}">{{ $section->nombre }}</a>
                                @elseif (strtolower($section->nombre) === 'accesorios')
                                    <a class="nav-link" href="{{ route('accesorie') }}">{{ $section->nombre }}</a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    <li>
                        <div class="search-container">
                            <form action="{{ route('search') }}" method="POST" class="search_form">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Buscar"
                                        aria-label="Buscar" id="search-input">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
                <div class="col-md-4 col-6 text-right text-md-left">
                    <div class="hamburger_container" id="hamburger_container">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6 text-left text-md-right">
            <div class="carrito">
                <ul class="navbar_user">
                    <li class="checkout">
                        <a href="{{ route('showcart') }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span id="checkout_items" class="checkout_items">{{ Cart::count() }}</span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="checkout">
                            <a href="{{ route('products-desired', ['user' => Auth::user()]) }}">
                                <i class="bi bi-heart-fill" aria-hidden="true"></i>
                                <span id="" class="checkout_items">
                                    {{ count(Auth::user()->product_desired) }}
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>


@yield('search_results')
