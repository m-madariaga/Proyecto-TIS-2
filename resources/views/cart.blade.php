@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/cart_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('.show-picture-modal').on('click', function() {
                var imgUrl = $(this).data('img-url');
                $('#pictureModalImage').attr('src', imgUrl);
                $('#pictureModal').modal('show');
            });
        });
    </script>
@endsection
@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="cart-items mt-1">
                    <h2>Cart Items</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>Price</th>
                                <th>Quantity</th>
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
                                                data-img-url="{{ $item->options->urlfoto }}">
                                                <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}"
                                                    width="70">
                                            </a>
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <div class="container-quantity">
                                                <div>
                                                    <div class="product-count">
                                                        <a href="{{ route('decrementitem', ['id' => $item->rowId]) }}"
                                                            class="btn bt-succes">-</a>
                                                        <button id="qty" type="button">{{ $item->qty }}</button>
                                                        <a href="{{ route('incrementitem', ['id' => $item->rowId]) }}"
                                                            class="btn bt-succes">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->subtotal }}</td>
                                        <td>
                                            <form action="{{ route('removeitem', ['id' => $item->rowId]) }}"
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
                                <td>{{ Cart::subtotal() }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    @if (Auth::check())
                        <form action="{{ route('confirmcart') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Checkout</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Checkout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pictureModalLabel">Picture Preview</h5>
                    <button type="submit" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close" style=""><i
                            class="far fa-times-circle"></i></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="pictureModalImage" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Inicia sesión para continuar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Debes iniciar sesión para continuar con la compra.</p>
                    <p>Haz clic en el siguiente enlace para iniciar sesión:</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
@endsection