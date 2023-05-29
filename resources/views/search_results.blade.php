@extends('layouts-landing.welcome')

@section('search_results')



<div class="container-fluid py-4 mb-4">
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Resultados de búsqueda</h2>
                    </div>
                </div>
            </div>

            @if (count($results) > 0)
            <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                @foreach ($results as $product)
                <!-- Product -->
                <div class="product-item">
                    <a href="{{ route('product.show', $product->id) }}">
                        <div class="productn product_filter">
                            <div class="product_image">
                                <img src="{{ asset('assets/images/images-products/' . $product->imagen) }}" class="product-image__img" alt="{{ $product->nombre }}">
                            </div>
                            <div class="product_info">
                                <h5 class="product_name"><a href="#">{{ $product->nombre }}</a></h5>
                                <div class="product_price">${{ $product->precio }}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
           
            <div class="row">
                <div class="col text-center">
                    <div class="new_arrivals_title">
                    <h4>No hay resultados encontrados</h4>
                    </div>
                </div>
            </div>

            @endif

        </div>
    </div>
</div>


@endsection