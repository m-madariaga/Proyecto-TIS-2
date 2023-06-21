@extends('layouts-landing.welcome')

@section('css')
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
        .btn_darlike {
            position: absolute;
            width: 38px;
            height: 38px;
            top: 15px;
            right: 15px;
            background-color: white;
            color: black;
            border: 0;
            padding: 0;
            border-radius: 50%;
            cursor: pointer;

        }
        .btn_darlike i{
            font-size: 18px;
        }
        .isLike {
            color: #8c034e;
        }
    </style>
@endsection

@section('js')
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
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="new_arrivals">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Mujer</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col justify-content-center">
                    <div class="product-grid d-flex justify-content-center"
                        data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        @foreach ($productos as $index => $producto)
                            <div class="product-item {{ $producto->stock <= 0 ? 'out-of-stock' : '' }}">
                                <a href="{{ route('product.show', $producto->id) }}">
                                    <div class="product product_filter">
                                        <div class="product_image">
                                            <img src="/assets/images/images-products/{{ $producto->imagen }}"
                                                class="product-image__img" alt="{{ $producto->nombre }}">
                                        </div>
                                        <div class="product_info">
                                            <h5 class="product_branch"><a href="#">{{ $producto->marca->nombre }}</a>
                                            </h5>
                                            <h5 class="product_name"><a href="#">{{ $producto->nombre }}</a></h5>
                                            <div class="product_price">${{ $producto->precio }}</div>
                                        </div>
                                    </div>
                                    @if (Auth::check())
                                        <form action="{{ route('like-product') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button
                                                class="btn btn_darlike  {{ Auth::user()->product_desired->contains('product_id', $producto->id) === true ? 'isLike' : '' }}"
                                                type="submit">
                                                <i class="bi bi-heart-fill " aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
