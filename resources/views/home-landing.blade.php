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
                        <h6>Spring / Summer Collection 2021</h6>
                        <h1>Get up to 30% Off New Arrivals</h1>
                        <div class="red_button shop_now_button"><a href="#">shop now</a></div>
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
                            <a href="#">vent</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner_item align-items-center"
                        style="background-image:url(assets/images/cartera_banner.jpeg)">
                        <div class="banner_category">
                            <a href="#">accessories</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner_item align-items-center"
                        style="background-image:url(assets/images/pantalon_banner.jpeg)">
                        <div class="banner_category">
                            <a href="#">Pants</a>
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
                        <h2>New Arrivals</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col text-center">
                    <div class="new_arrivals_sorting">
                        <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked"
                                data-filter="*">all</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                                data-filter=".women">women's</li>
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                                data-filter=".accessories">accessories</li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

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
                                    <h6 class="product_name"><a href="#">Fujifilm X100T 16 MP Digital Camera
                                            (Silver)</a></h6>
                                    <div class="product_price">$520.00<span>$590.00</span></div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
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
                                    <h6 class="product_name"><a href="#">Samsung CF591 Series Curved 27-Inch
                                            FHD Monitor</a></h6>
                                    <div class="product_price">$610.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 3 -->

                        <div class="product-item women">
                            <div class="product product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_3.png" alt="">
                                </div>
                                <div class="favorite"></div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">Blue Yeti USB Microphone Blackout
                                            Edition</a></h6>
                                    <div class="product_price">$120.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
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
                                    <h6 class="product_name"><a href="#">DYMO LabelWriter 450 Turbo Thermal
                                            Label Printer</a></h6>
                                    <div class="product_price">$410.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 5 -->

                        <div class="product-item women men">
                            <div class="product product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_5.png" alt="">
                                </div>
                                <div class="favorite"></div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">Pryma Headphones, Rose Gold &
                                            Grey</a></h6>
                                    <div class="product_price">$180.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 6 -->

                        <div class="product-item accessories">
                            <div class="product discount product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_6.png" alt="">
                                </div>
                                <div class="favorite favorite_left"></div>
                                <div
                                    class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                    <span>-$20</span>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="##">Fujifilm X100T 16 MP Digital Camera
                                            (Silver)</a></h6>
                                    <div class="product_price">$520.00<span>$590.00</span></div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 7 -->

                        <div class="product-item women">
                            <div class="product product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_7.png" alt="">
                                </div>
                                <div class="favorite"></div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">Samsung CF591 Series Curved 27-Inch
                                            FHD Monitor</a></h6>
                                    <div class="product_price">$610.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 8 -->

                        <div class="product-item accessories">
                            <div class="product product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_8.png" alt="">
                                </div>
                                <div class="favorite"></div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">Blue Yeti USB Microphone Blackout
                                            Edition</a></h6>
                                    <div class="product_price">$120.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 9 -->

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
                                    <h6 class="product_name"><a href="#">DYMO LabelWriter 450 Turbo Thermal
                                            Label Printer</a></h6>
                                    <div class="product_price">$410.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>

                        <!-- Product 10 -->

                        <div class="product-item men">
                            <div class="product product_filter">
                                <div class="product_image">
                                    <img src="assets/images/product_10.png" alt="">
                                </div>
                                <div class="favorite"></div>
                                <div class="product_info">
                                    <h6 class="product_name"><a href="#">Pryma Headphones, Rose Gold &
                                            Grey</a></h6>
                                    <div class="product_price">$180.00</div>
                                </div>
                            </div>
                            <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deal of the week -->

    <div class="sale" style="background-image:url(assets/images/s_foto1.jpg)">
        <div class="container fill_height">
            <div class="row align-items-center fill_height ">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="sale_content">
                        <h1>Sale Section</h1>
                        <div class="red_button sale_button"><a href="#">Sale</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">

    </div>
    </div>

    <!-- Benefit -->

    <div class="benefit mb-4">
        <div class="container">
            <div class="row benefit_row">
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>free shipping</h6>
                            <p>Suffered Alteration in Some Form</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>cach on delivery</h6>
                            <p>The Internet Tend To Repeat</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>45 days return</h6>
                            <p>Making it Look Like Readable</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>opening all week</h6>
                            <p>8AM - 09PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection