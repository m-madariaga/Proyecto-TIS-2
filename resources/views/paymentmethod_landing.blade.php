@extends('layouts-landing.welcome')

@section('css')
<link rel="stylesheet" href="assets/css/paymethod_style.css">
@endsection

@section('js')
@endsection

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center mt-4">
            <div class="payment-method-section">
                <h2>Método de Pago</h2>


                <p>Seleccione un método de pago:</p>
                <div class="card-deck">
                    @foreach ($paymentMethods as $paymentMethod)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $paymentMethod->name }}</h5>
                                
                            </div>
                        </div>
                    @endforeach
                </div>


                <button onclick="proceedToCheckout()">Proceder con la compra</button>

            </div>
        </div>
    </div>
@endsection
