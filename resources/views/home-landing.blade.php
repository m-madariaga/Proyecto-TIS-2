@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
@endsection

@section('js')
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/easing.js"></script>
    <script src="assets/js/custom.js"></script>
@endsection

@section('content')
    <div class="main_slider" style="background-image:url(assets/images/s_foto1.jpg)">
        <div class="container fill_height">
            <div class="row align-items-center fill_height">
                <div class="col">
                    <div class="main_slider_content">
                        <h6>Nueva colección de ropa para mujer </h6>
                        <h1>Bienvenidos a nuestra página web</h1>
                        <div class="red_button shop_now_button"><a href="{{ route('women') }}">Comprar ahora</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner -->

    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="banner_item align-items-center"
                        style="background-image:url(assets/images/chaleco_banner.jpeg)">
                        <div class="banner_category">
                            <a href="{{ route('women') }}">MUJER</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner_item align-items-center"
                        style="background-image:url(assets/images/photo_hombre.jpg)">
                        <div class="banner_category">
                            <a href="{{ route('men') }}">HOMBRE</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner_item align-items-center" style="background-image:url(assets/images/photo_niña.jpeg)">
                        <div class="banner_category">
                            <a href="{{ route('kids') }}">NIÑOS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Arrivals -->

    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Lo más vendido</h2>
                    </div>
                </div>
            </div>
            <!-- <div class="row align-items-center">
                                    <div class="col text-center">
                                        <div class="new_arrivals_sorting">
                                            <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
                                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".women">women's</li>
                                                <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".accessories">accessories</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
            <div class="container">
                <div class="row ajustify-content-center">
                    <div class="col d-flex flex-column align-items-center">
                        <div class="product-grid"
                            data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

                            <!-- Product 1 -->

                            <div class="product-item men">
                                <div class="product discount product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_1.png" alt="">
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    <div
                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                        <span>-$20</span>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Polerón Cacao Mujer</a></h6>
                                        <div class="product_price">$15.000<span>$20.000</span></div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>

                            <!-- Product 2 -->

                            <div class="product-item women">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_2.png" alt="">
                                    </div>
                                    <div class="favorite"></div>
                                    <div
                                        class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center">
                                        <span>new</span>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Cartera Wilson Mujer</a></h6>
                                        <div class="product_price">$29.990</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al Carrito</a></div>
                            </div>

                            <!-- Product 3 -->

                            <div class="product-item women">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_3.png" alt="">
                                    </div>
                                    <div class="favorite"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Chaleco Mujer</a></h6>
                                        <div class="product_price">$22.900</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>

                            <!-- Product 4 -->

                            <div class="product-item accessories">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_4.png" alt="">
                                    </div>
                                    <div
                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                        <span>sale</span>
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Bolso Sport Mujer</a></h6>
                                        <div class="product_price">$41.000</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>


                            <!-- Product 5 -->

                            <div class="product-item women">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_7.png" alt="">
                                    </div>
                                    <div class="favorite"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Chaleco Mujer</a></h6>
                                        <div class="product_price">$19.000</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>

                            <!-- Product 6 -->

                            <div class="product-item accessories">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_8.png" alt="">
                                    </div>
                                    <div class="favorite"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Billetera Coffe Mujer</a></h6>
                                        <div class="product_price">$25.000</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>

                            <!-- Product 7 -->

                            <div class="product-item men">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_9.png" alt="">
                                    </div>
                                    <div
                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                        <span>sale</span>
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Chaqueta Café Mujer</a></h6>
                                        <div class="product_price">$46.900</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>

                            <!-- Product 8 -->

                            <div class="product-item men">
                                <div class="product product_filter">
                                    <div class="product_image">
                                        <img src="assets/images/product_10.png" alt="">
                                    </div>
                                    <div class="favorite"></div>
                                    <div class="product_info">
                                        <h6 class="product_name"><a href="#">Polera manga larga Mujer</a></h6>
                                        <div class="product_price">$18.000</div>
                                    </div>
                                </div>
                                <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Deal of the week -->

    <div class="sale" style="">
        <div class="container fill_height">
            <div class="row align-items-center fill_height ">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="sale_content align-items-center flex">
                        <h1>Sección de Promociones</h1>
                        <div class="productos-oferta justify-content-center align-middle flex">
                            @if ($promociones->isNotEmpty())
                                @foreach ($promociones as $promocion)
                                    <div class="product-item men flex-inline">
                                        <div class="product product_filter ">
                                            <div class="product_image">
                                                <img src="/assets/images/images-products/{{ $promocion->product->imagen }}"
                                                    alt="">
                                            </div>
                                            <div class="favorite"></div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a>{{$promocion->product->nombre}}</a>
                                                </h6>
                                                <div class="product_price">{{$promocion->product->precio - $promocion->descuento}}</div>
                                            </div>
                                        </div>
                                        <div class="red_button add_to_cart_button"><a href="#">Añadir al carrito</a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="red_button sale_button"><a href="#">Sale</a></div>
                            @else
                                <h3>No hay productos en promoción</h3>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Benefit -->

    <div class="benefit mb-4">
        <div class="container">
            <div class="row benefit_row">
                <div class="col-lg-4 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>ZONA DESPACHO</h6>
                            <p>Para todas las regiones del país</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>PAGO EFECTIVO</h6>
                            <p>Excluivamente en Chillán y San Fernando</p>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-4 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>ENTREGA PRESENCIAL</h6>
                            <p>Solo ciudad de Chillán y San fernando</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($results) && count($results) > 0)
        <div class="container">
            <h2>Search Results</h2>
            <ul>
                @foreach ($results as $result)
                    <li>{{ $result }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
