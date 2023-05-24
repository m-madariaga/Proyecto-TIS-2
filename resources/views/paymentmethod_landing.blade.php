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
                            @if ($paymentMethod->visible)
                                <div class="card" data-payment-method-id="{{ $paymentMethod->id }}"
                                    onclick="selectPaymentMethod(this)">
                                    <div class="card-body d-flex flex-column align-items-center selectable-payment-method"
                                        style="cursor: pointer;">
                                        <h5 class="card-title">{{ $paymentMethod->name }}</h5>
                                        <div
                                            class="payment-method-image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{ asset('argon/assets/img/images-paymethods/' . $paymentMethod->imagen) }}"
                                                alt="Imagen del método de pago" class="img-fluid">
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="paymentMethod"
                                                id="paymentMethod{{ $paymentMethod->id }}" value="{{ $paymentMethod->id }}">
                                            <label class="form-check-label" for="paymentMethod{{ $paymentMethod->id }}">
                                                Seleccionar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
        function selectPaymentMethod(element) {
            // Remover la clase 'selected-payment-method' de todos los cards
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                card.classList.remove('selected-payment-method');
            });

            // Agregar la clase 'selected-payment-method' al card seleccionado
            element.parentNode.classList.add('selected-payment-method');

            // Obtener el input de radio dentro del card seleccionado
            var radioInput = element.querySelector('.form-check-input');
            radioInput.checked = true;
        }
    </script>
@endsection
