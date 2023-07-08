@extends('layouts-landing.welcome')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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
                            <h5 class="card-subtitle mb-2 text-body-secondary">Precio: ${{ number_format($product->precio, 0, ',', '.') }}</h5>
                            


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
                                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                                    <div class="text-center">
                                        <p class="display-4" style="color: black">Acceso denegado</p>
                                        <p class="lead" style="color: black">Usted no es un cliente y no puede
                                            realizar compras.</p>
                                    </div>
                                    @else
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body mt-4">
                <h3 class="card-title">Reseñas del producto</h3>
                @auth
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="card-title">Escribir reseña</h4>
                        <form method="POST" action="{{ route('reviews.store', ['productId' => $product->id, 'userId' => Auth::user()->id]) }}">
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
                <hr>
                @foreach ($reviews as $review)
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <h4 class="col-4 card-title">{{ $review->title }}</h4>
                            <h5 class="col-sm-4 text-right align-self-center mb-2 text-body-secondary">
                                @if ($review->type == 1)
                                <i class="fa fa-thumbs-up"></i>
                                @else
                                <i class="fa fa-thumbs-down"></i>
                                @endif
                            </h5>
                        </div>
                        <h5 class="card-subtitle mb-2 text-body-secondary">{{ $review->username }}</h5>
                        <p>{{ $review->description }}</p>

                    </div>
                </div>
                @endforeach


            </div>
        </div>

        <div class="new_arrivals">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title new_arrivals_title">
                            <h2>También te puede interesar</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 card_product_landing">
            <div class="card-body mt-4">
                <div id="recommendedCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($recommendedProducts->chunk(4) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($chunk as $recommendedProduct)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 mb-4">
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

                                                            Precio: ${{ number_format($recommendedProduct->precio, 0, ',', '.') }}
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

    </div>
</div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
            if (quantity < stock) {
                quantity++;
                qtyBtn.textContent = quantity;
                quantityInput.value = quantity;
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        @if(session('success'))
        Swal.fire({
            title: '¡Éxito!',
            text: '{{ session('
            success ') }}',
            icon: 'success',
            timer: 4000, // Tiempo en milisegundos (3 segundos)
            showConfirmButton: true
        });
        @endif
    });
</script>
@endsection