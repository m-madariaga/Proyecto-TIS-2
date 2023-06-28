@extends('layouts-landing.welcome')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/cart_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('.show-picture-modal').on('click', function() {
                var imgUrl = $(this).data('img-url');
                $('#pictureModalImage').attr('src', imgUrl);
                $('#pictureModal').modal('show');
            });
        });
        $(document).ready(function() {
            $('#cartButton').on('click', function() {
                var userRole = "{{ Auth::user()->role }}";
                if (userRole !== 'cliente') {
                    Swal.fire({
                        title: 'Acceso denegado',
                        text: 'Usted no es un cliente y no puede realizar compras',
                        icon: 'warning',
                        confirmButtonText: 'Entendido'
                    });
                } else {
                    window.location.href = "{{ route('cart.generateOrder') }}";
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container mt-4">
                    <h2 class="py-2">Carrito Compras</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Imagen Referencial</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $index => $item)
                                @if (!is_null($item))
                                    <tr>
                                        <td><a href="#" class="show-picture-modal"
                                                data-img-url="{{ $item->options->urlfoto }}">{{ $item->name }}</td>
                                        <td>
                                            <a href="#" class="show-picture-modal"
                                                data-img-url="{{ $item->options->urlfoto }}" style="color:black;">
                                                <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}"
                                                    width="70">
                                            </a>
                                        </td>
                                        <td>$ {{ $item->price }}</td>
                                        <td>
                                            <div class="container-quantity">
                                                <div>
                                                    <div class="product-count">
                                                        <a href="{{ route('decrementitem', ['id' => $item->rowId]) }}"
                                                            class="btn bt-succes">-</a>
                                                        <button id="qty" type="button">{{ $item->qty }}</button>
                                                        @if ($item->qty < $item->options->stock)
                                                            <a href="{{ route('incrementitem', ['id' => $item->rowId]) }}"
                                                                class="btn bt-succes">+</a>
                                                        @else
                                                            <a href="#" class="btn bt-succes" disabled>+</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$ {{ $item->subtotal }}</td>
                                        <td>
                                            <form action="{{ route('removeitem', ['rowId' => $item->rowId]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-link"><i
                                                        class="far fa-times-circle"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total:</td>
                                <td>$ {{ Cart::subtotal() }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    @if (Cart::count() > 0)
                        @if (Auth::check() && Auth::user()->hasRole('admin'))
                            <div class="text-center">
                                <p class="display-4" style="color: black">Acceso denegado</p>
                                <p class="lead" style="color: black">Usted no es un cliente y no puede realizar compras.
                                </p>
                            </div>
                        @elseif (Auth::check())
                            <form action="{{ route('cart.generateOrder') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Continuar</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Continuar</button>
                        @endif
                    @else
                        <div class="text-center">
                            <p class="display-4">No hay productos en el carrito</p>
                            <p class="lead">Agrega productos para continuar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Imagen -->
    <div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pictureModalLabel">Imagen Referencial</h5>
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="pictureModalImage" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Debe iniciar sesión -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Debes iniciar sesión para continuar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('login') }}" class="btn btn-primary">Continuar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
