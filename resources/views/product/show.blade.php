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
                                        @if ($product->stock === 0)
                                        <button class="button_carrito_p btn btn-lg btn-block" type="button" disabled>Sin stock</button>
                                        @else
                                        <button class="button_carrito_p btn btn-lg btn-block" type="submit">Añadir al carrito</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-4 mb-4">
                <div class="card-body">
                    <h3 class="card-title">Reseñas del producto</h3>
                    @auth
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Escribir reseña</h4>
                            <form method="POST" action="{{ route('reviews.store', [ 'productId' => $product->id, 'userId' => Auth::user()->id]) }}">
                                @csrf
                                <input type="text" id="title" name="title" class="form-control mb-1" placeholder="Título" required>
                                <select class="form-select mb-1" id="type" name="type">
                                    <option value="1" selected>Positiva</option>
                                    <option value="0">Negativa</option>
                                </select>
                                <textarea class="form-control mb-1" id="description" name="description" placeholder="Descripción" rows="4" required></textarea>
                                <button type="submit" class="btn">Guardar</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                    @foreach ($reviews as $review)

                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <h4 class="col-4 card-title">{{$review->title}}</h4>
                                <h5 class="col-sm-4 text-right align-self-center mb-2 text-body-secondary">
                                    @if ($review->type == 1)
                                    <i class="fa fa-thumbs-up"></i>
                                    @else
                                    <i class="fa fa-thumbs-down"></i>
                                    @endif
                                </h5>
                            </div>
                            <h5 class="card-subtitle mb-2 text-body-secondary">{{$review->username}}</h5>
                            <p>{{$review->description}}</p>

                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

            <!-- carrusel -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title d-flex flex-column align-items-center">También te podría interesar</h3>
                    <div id="recommendedCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($recommendedProducts->chunk(4) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    @foreach ($chunk as $recommendedProduct)
                                    <div class="col-4 col-md-3 col-lg-2">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="{{ route('product.show', $recommendedProduct->id) }}">
                                                <div class="card">
                                                    <div class="product-image-container">
                                                        <img src="{{ asset('assets/images/images-products/' . $recommendedProduct->imagen) }}" class="img-thumbnail" alt="{{ $recommendedProduct->nombre }}">
                                                    </div>
                                                    <div class="card-body d-flex flex-column align-items-center">
                                                        <h5>{{ $recommendedProduct->nombre }}</h5>
                                                        <p class="text-body-secondary">Precio: ${{ $recommendedProduct->precio }}</p>
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
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;
    filter: invert(1);"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#recommendedCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"  style="background-color: black;
    filter: invert(1);"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#recommendedCarousel').carousel();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.querySelector('.decrease-qty');
        const increaseBtn = document.querySelector('.increase-qty');
        const qtyBtn = document.querySelector('#qty');
        const quantityInput = document.querySelector('#quantity');
        const stock = {
            {
                $product - > stock
            }
        }; // Get the stock value from the server-side variable

        let quantity = 1;

        decreaseBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                qtyBtn.textContent = quantity;
                quantityInput.value = quantity;
            }
        });

        increaseBtn.addEventListener('click', () => {
            if (quantity < stock) { // Check if quantity is less than stock
                quantity++;
                qtyBtn.textContent = quantity;
                quantityInput.value = quantity;
            }
        });
    });
</script>
@endsection