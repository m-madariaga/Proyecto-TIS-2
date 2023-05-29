@extends('layouts-landing.welcome')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<div class="container-fluid py-4 mb-4">
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Productos Hombre</h2>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        @foreach ($productos as $index => $producto) -->
                        <!-- Product 1 -->
                        <!-- <div class="product-item">
                            <div class="product discount product_filter">
                                <div class="product-image" style="width: 100%; height: 300px;">
                                    <img style="width: 100%; height: 100%; object-fit: cover;" src="/assets/images/images-products/{{ $producto->imagen }}" class="product-image__img" alt="{{ $producto->nombre }}">
                                </div>
                                <div class="product_info">
                                    <h5 class="product_name"><a href="#">{{ $producto->nombre }}</a></h5>
                                    <div class="product_price">${{ $producto->precio }}</div>
                                </div>
                            </div>
                            <form action="{{ route('additem') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id[]" value="{{ $producto->id }}">
                                <button class="red_button add_to_cart_button" type="submit">Aañadir al carro</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

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