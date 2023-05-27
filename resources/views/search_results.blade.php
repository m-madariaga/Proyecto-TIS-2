@extends('layouts-landing.welcome')

@section('search_results')

<div class="container">
    <h2>Resultados de búsqueda</h2>
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
    <p>No hay resultados encontrados</p>
    @endif
</div>
@endsection