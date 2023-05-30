@extends('layouts-landing.welcome')

@section('css')
@endsection



@section('content')
<div class="container-fluid py-4 mt-4">
    <div class="product_detalle">
        <div class="container py-4 mb-4">
            <div class="row">
                <div class="col-12 col-md-6 order-md-first mb-3">
                    <div class="card d-flex align-items-center">
                        <img src="{{ asset('assets/images/images-products/' . $product->imagen) }}" class="img-thumbnail" alt="{{ $product->nombre }}">
                    </div>
                </div>

                <div class="col-12 col-md-6 order-md-last">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->nombre }}</h3>
                            <h5 class="card-subtitle mb-2 text-body-secondary">Precio: ${{ $product->precio }}</h5>
                            <p class="card-text">Descripción: {{ $product->descripcion }}</p>

                            <div class="row">
                                <div class="col">
                                    <div class="container-quantity mb-4">
                                        <div class="product-count">
                                            <div class="stock">Stock:{{ $product->stock }}</div>


                                            <h5 class="card-subtitle mb-2 text-body-secondary">Cantidad:</h5>
                                            <a href="#" class="button_succes btn decrease-qty">-</a>
                                            <button id="qty" type="button" class="btn-quantity btn">1</button>
                                            <a href="#" class="button_succes btn increase-qty">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('additem') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id[]" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" id="quantity" value="1">
                                        <button class="button_carrito_p btn btn-lg btn-block" type="submit">Añadir al carrito</button>
                                    </form>
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

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.querySelector('.decrease-qty');
        const increaseBtn = document.querySelector('.increase-qty');
        const qtyBtn = document.querySelector('#qty');
        const quantityInput = document.querySelector('#quantity');

        let quantity = 1;

        decreaseBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                qtyBtn.textContent = quantity;
                quantityInput.value = quantity;
            }
        });

        increaseBtn.addEventListener('click', () => {
            quantity++;
            qtyBtn.textContent = quantity;
            quantityInput.value = quantity;
        });
    });
</script>
@endsection