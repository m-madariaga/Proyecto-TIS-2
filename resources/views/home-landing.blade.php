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
                <div class="banner_item align-items-center" style="background-image:url(assets/images/chaleco_banner.jpeg)">
                    <div class="banner_category">
                        <a href="{{ route('women') }}">MUJER</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="banner_item align-items-center" style="background-image:url(assets/images/photo_hombre.jpg)">
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
                    <h2>Nuestros productos</h2>
                </div>
            </div>
        </div>
      
    </div>
</div>

<div class="card mt-4 card_product_landing">
    <div class="card-body mt-4">
        <div id="recommendedCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($recommendedProducts->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row justify-content-center">
                        @foreach ($chunk as $recommendedProduct)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="d-flex flex-column align-items-center">
                                <a href="{{ route('product.show', $recommendedProduct->id) }}">
                                    <div class="card">
                                        <div class="product-image-container">
                                            <img src="{{ asset('assets/images/images-products/' . $recommendedProduct->imagen) }}" class="img-thumbnail" alt="{{ $recommendedProduct->nombre }}">
                                        </div>
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <h5>{{ $recommendedProduct->nombre }}</h5>
                                            <p class="text-body-secondary precio_product">
                                                <strong>
                                                    Precio:
                                                    ${{ $recommendedProduct->precio }}
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#recommendedCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black; filter: invert(1);"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#recommendedCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black; filter: invert(1);"></span>
                <span class="sr-only">Siguiente</span>
            </a>
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
                                    <img src="/assets/images/images-products/{{ $promocion->product->imagen }}" alt="">
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