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
                            <h2>Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                            @foreach ($productos as $index => $producto)
                                <!-- Product 1 -->
                                <div class="product-item">
                                    <div class="product discount product_filter">
                                        <div class="product-image" style="width: 100%; height: 300px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;"
                                                src="/assets/images/images-products/{{ $producto->imagen }}"
                                                class="product-image__img" alt="{{ $producto->nombre }}">
                                        </div>
                                        <div class="product_info">
                                            <h5 class="product_name"><a href="#">{{ $producto->nombre }}</a></h5>
                                            <div class="product_price">${{ $producto->precio }}</div>
                                        </div>
                                    </div>
                                    <form action="{{ route('additem') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id[]" value="{{ $producto->id }}">
                                        <button class="red_button add_to_cart_button" type="submit">Add to Cart</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
