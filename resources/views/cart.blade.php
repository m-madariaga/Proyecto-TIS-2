@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="assets/css/cart_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

@section('js')
   
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="cart-items">
            <h2>Cart Items</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $index => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="50">
                            </td>
                            <td>{{ $item->price*$item->qty }}</td>
                            <td>
                                <div class="container-quantity">
                                    <div>
                                        <div class="product-count">
                                            <a href="{{ route('decrementitem', ['id' => $item->id]) }}" class="btn bt-succes">-</a>
                                            <button type="button">{{ $item->qty }}</button>
                                            <a href="{{ route('incrementitem', ['id' => $item->id]) }}" class="btn bt-succes">+</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->subtotal }}</td>
                            <td>
                                <form action="{{ route('removeitem') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-link"><i class="far fa-times-circle" style="color: #bd2130;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total:</td>
                        <td>{{ Cart::subtotal() }}</td>
                    </tr>
                </tfoot>
            </table>
            <form action="{{ route('confirmcart') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="far fa-times-circle"></i> Finalizar Pedido</button>
            </form>
        </div>
    </div>
@endsection
