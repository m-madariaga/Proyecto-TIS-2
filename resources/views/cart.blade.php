@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="assets/css/cart_style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.show-picture-modal').click(function() {
                var imgUrl = $(this).attr('src');
                $('#modalImage').attr('src', imgUrl);
                $('#pictureModal').modal('show');
            });
        });
    </script>
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade mt-4" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Picture" id="modalImage" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="cart-items mt-4">
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
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}"
                                                width="50" class="show-picture-modal"
                                                data-img-url="{{ $item->options->urlfoto }}">
                                        </td>
                                        <td>{{ $item->price * $item->qty }}</td>
                                        <td>
                                            <div class="container-quantity">
                                                <div>
                                                    <div class="product-count">
                                                        <a href="{{ route('decrementitem', ['id' => $item->id]) }}"
                                                            class="btn bt-succes">-</a>
                                                        <button type="button">{{ $item->qty }}</button>
                                                        <a href="{{ route('incrementitem', ['id' => $item->id]) }}"
                                                            class="btn bt-succes">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->subtotal }}</td>
                                        <td>
                                            <form action="{{ route('removeitem') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
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
                    <form action="{{ route('paymentmethods') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="far fa-times-circle"></i> Finalizar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
