@extends('layouts-landing.welcome')



@section('css')
@endsection

@section('js')
@endsection

@section('content')
<div class="container-fluid py-4 mt-4">
    <div class="product_detalle">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <img src="{{ asset('assets/images/images-products/' . $product->imagen) }}" class="img-thumbnail" alt="{{ $product->nombre }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">


                            <h3 class="card-title">{{ $product->nombre }}</h3>
                            <h5 class="card-subtitle mb-2 text-body-secondary">Precio: ${{ $product->precio }}</h5>
                            <p class="card-text">Descripción: {{ $product->descripcion }}</p>


                            <div class="row">
                                <div class="col">
                                    <div class="container-quantity mb-4">
                                        <div class="product-count">
                                            <h5 class="card-subtitle mb-2 text-body-secondary">Cantidad:</h5>
                                            <a href="" class="button_succes btn">-</a>
                                            <button id="qty" type="button" class="btn-quantity btn"></button>
                                            <a href="" class="button_succes btn">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="button_carrito_p btn btn-lg btn-block" type="button">Añadir al carrito</button>
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