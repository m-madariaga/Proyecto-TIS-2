@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="assets/css/paymethod_style.css">
@endsection


@section('content')
    <div class="container-fluid py-4" id="container-payment">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="payment-method-section">
                    <h2>Método de Pago</h2>

                    <p>Seleccione un método de pago:</p>
                    <div class="card-deck mb-4">
                        @foreach ($paymentMethods as $paymentMethod)
                            <div class="card" data-payment-method-id="{{ $paymentMethod->id }}">
                                <div class="card-body d-flex flex-column align-items-center selectable-payment-method"
                                    style="cursor: pointer;" onclick="selectPaymentMethod(this)">
                                    <h5 class="card-title">{{ $paymentMethod->name }}</h5>
                                    <div
                                        class="payment-method-image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('argon/assets/img/images-paymethods/' . $paymentMethod->imagen) }}"
                                            alt="Imagen del método de pago" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="checkout-button mt-4">
                        <button onclick="proceedToCheckout()" class="btn btn-primary">Proceder con la compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function selectPaymentMethod(card) {
        var cards = document.getElementsByClassName('card');
        
        // Deseleccionar todas las tarjetas
        for (var i = 0; i < cards.length; i++) {
            cards[i].classList.remove('selected');
        }
        
        // Seleccionar la tarjeta clickeada
        card.classList.add('selected');
    }
    
    function proceedToCheckout() {
        var selectedCard = document.querySelector('.card.selected');
        
        if (selectedCard) {
            var paymentMethodId = selectedCard.getAttribute('data-payment-method-id');
            // Aquí puedes realizar las acciones necesarias con el método de pago seleccionado
            
            console.log('Se seleccionó el método de pago con ID: ' + paymentMethodId);
        } else {
            console.log('No se ha seleccionado ningún método de pago');
        }
    }
</script>

@endsection