@extends('layouts-landing.welcome')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <style>
        .product-item.out-of-stock {
            opacity: 0.5;
            position: relative;
        }

        .product-item.out-of-stock::after {
            content: "No hay stock";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            max-width: 300px;
            height: 25%;
            max-height: 200px;
            background-color: #000;
            color: #fff;
            font-size: 18px;
            text-align: center;
            padding: 20px;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script>
        document.getElementById("searchButton").addEventListener("click", searchProducts);
        document.getElementById("productSearch").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                searchProducts();
            }
        });

        function searchProducts() {
            var searchValue = document.getElementById("productSearch").value.toLowerCase();
            var productItems = document.getElementsByClassName("product-item");

            for (var i = 0; i < productItems.length; i++) {
                var productName = productItems[i].getElementsByClassName("product_name")[0].innerText.toLowerCase();
                if (productName.includes(searchValue)) {
                    productItems[i].style.display = "block";
                } else {
                    productItems[i].style.display = "none";
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {

            var $grid = $('#productContainer').isotope({
                itemSelector: '.product-item',
                layoutMode: 'fitRows'
            });


            var $filterButton = $(".btn.btn-white.w-100.border.border-secondary");
            var $categoryCheckboxes = $(".category-checkbox");
            var $brandCheckboxes = $("#panelsStayOpen-collapseTwo .form-check-input");
            var $sizeCheckboxes = $("#panelsStayOpen-collapseFour .form-check-input");
            var $minPriceInput = $("#panelsStayOpen-collapseThree .col-6:first-child input");
            var $maxPriceInput = $("#panelsStayOpen-collapseThree .col-6:last-child input");

            $filterButton.on('click', function() {
                var selectedCategories = [];
                var selectedBrands = [];
                var selectedSizes = [];
                var minPrice = $minPriceInput.val() || 0;
                var maxPrice = $maxPriceInput.val() || Infinity;

                $categoryCheckboxes.each(function() {
                    if (this.checked) selectedCategories.push(this.value);
                });

                $brandCheckboxes.each(function() {
                    if (this.checked) selectedBrands.push($(this).next("label").text().trim());
                });

                $sizeCheckboxes.each(function() {
                    if (this.checked) selectedSizes.push($(this).next("label").text().trim());
                });


                function filterFunction() {
                    var $item = $(this);
                    var productCategory = $item.attr("data-category");
                    var productPrice = parseFloat($item.find(".product_price").text().replace('$', ''));
                    var productBrand = $item.attr("data-brand");
                    var productSize = $item.attr("data-size");

                    return (
                        selectedCategories.includes(productCategory) &&
                        productPrice >= minPrice &&
                        productPrice <= maxPrice &&
                        selectedBrands.includes(productBrand) &&
                        selectedSizes.includes(productSize)
                    );
                }


                $grid.isotope({
                    filter: filterFunction
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="new_arrivals">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 mt-5">

                        <button class="btn btn-outline-secondary mb-3 w-100 d-lg-none" type="button"
                            data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span>Mostrar Filtros</span>
                        </button>

                        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseOne"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            Categorías
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne">
                                        <div class="accordion-body">
                                            <ul class="list-unstyled">
                                                @php
                                                    $uniqueCategories = [];
                                                @endphp
                                                @foreach ($productos as $producto)
                                                    @if (!in_array($producto->categoria->nombre, $uniqueCategories))
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input category-checkbox"
                                                                    type="checkbox"
                                                                    value="{{ $producto->categoria->nombre }}"
                                                                    id="categoryCheckbox{{ $loop->index }}" checked>
                                                                <label class="form-check-label"
                                                                    for="categoryCheckbox{{ $loop->index }}">{{ $producto->categoria->nombre }}</label>
                                                            </div>
                                                        </li>

                                                        @php
                                                            $uniqueCategories[] = $producto->categoria->nombre;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Marcas
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div>
                                                @php
                                                    $uniqueSizes = [];
                                                @endphp

                                                @foreach ($productos as $producto)
                                                    @if (!in_array($producto->marca->nombre, $uniqueSizes))
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheck{{ $loop->iteration }}" checked />
                                                            <label class="form-check-label"
                                                                for="flexCheck{{ $loop->iteration }}">{{ $producto->marca->nombre }}</label>
                                                            <span
                                                                class="badge badge-secondary float-end">{{ $producto->marca->products->count() }}</span>
                                                        </div>

                                                        @php
                                                            $uniqueSizes[] = $producto->marca->nombre;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Precio
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        Min
                                                    </p>
                                                    <div class="form-outline">
                                                        <input type="number" id="typeNumber" class="form-control" />
                                                        <label class="form-label"
                                                            for="typeNumber">${{ $productos->min('precio') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        Max
                                                    </p>
                                                    <div class="form-outline">
                                                        <input type="number" id="typeNumber" class="form-control" />
                                                        <label class="form-label"
                                                            for="typeNumber">${{ $productos->max('precio') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseFour"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            Talla
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <div>
                                                @php
                                                    $uniqueSizes = [];
                                                @endphp

                                                @foreach ($productos as $producto)
                                                    @if (!in_array($producto->talla, $uniqueSizes))
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="flexCheck{{ $loop->iteration }}"
                                                                checked />
                                                            <label class="form-check-label"
                                                                for="flexCheck{{ $loop->iteration }}">{{ $producto->talla }}</label>

                                                        </div>

                                                        @php
                                                            $uniqueSizes[] = $producto->talla;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="btn btn-white w-100 border border-secondary">Filtrar</button>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col text-center">
                                <div class="section_title new_arrivals_title">
                                    <h2>Mujer</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product-grid"
                                    data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'
                                    id="productContainer">
                                    @foreach ($productos as $index => $producto)
                                        <div class="product-item {{ $producto->stock === 0 ? 'out-of-stock' : '' }}"
                                            data-category="{{ $producto->categoria->nombre }}"
                                            data-brand="{{ $producto->marca->nombre }}"
                                            data-size="{{ $producto->talla }}">
                                            <a href="{{ route('product.show', $producto->id) }}">
                                                <div class="product product_filter">
                                                    <div class="product_image">
                                                        <img src="/assets/images/images-products/{{ $producto->imagen }}"
                                                            class="product-image__img" alt="{{ $producto->nombre }}">
                                                    </div>
                                                    <div class="product_info">
                                                        <h5 class="product_branch"><a href="#">{{ $producto->marca->nombre }}</a></h5>
                                                        <h5 class="product_name"><a
                                                                href="#">{{ $producto->nombre }}</a></h5>
                                                        <div class="product_price">${{ $producto->precio }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <form action="{{ route('additem') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id[]" value="{{ $producto->id }}">
                                                <button class="red_button add_to_cart_button" type="submit"
                                                    {{ $producto->stock === 0 ? 'disabled' : '' }}>
                                                    {{ $producto->stock === 0 ? 'Sin stock' : 'Añadir al carrito' }}
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
