@extends('layouts-landing.welcome')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="cart-items">
            <h2>Cart Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->subtotal }}</td>
                            <td>
                                <form action="{{ route('removeitem') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                    <button type="submit" class="btn btn-danger">Remove</button>
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
        </div>
    </div>
@endsection