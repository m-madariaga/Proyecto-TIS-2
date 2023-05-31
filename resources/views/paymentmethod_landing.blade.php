@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/method_style.css') }}">
    <style>
        /* Agrega estilos específicos para esta vista */
        /* Por ejemplo, para ocultar elementos */
        .header {
            display: none;
        }

        .footer {
            display: none;
        }

        .header_resume {
            position: relative;
            background-image: url("assets/images/lienzo.jpg");
            background-size: cover;
            background-position: center;
            height: 100px;
        }

        .header-content {
            display: flex;
            align-items: center;
            height: 100%;
            padding-left: 15px;
        }

        .navbar-brand-img {
            height: 70%;
            width: 300px;
            margin-left: 18rem;
            object-fit: contain;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .button-container button {
            margin: 0 0.5rem;
        }

        .super_container {
            margin-top: -8rem;
            margin-bottom: 5rem;
        }

        .multiline-text span {
            display: block;
            line-height: 1.2;
        }

        .container-fluid {
            padding: 0px 25rem 0px;
        }

        .cart-text {
            color: black;
        }
    </style>
@endsection

@section('content')
    <div class="header_resume">
        <div class="header-content">
            <a class="navbar-brand m-0" href="{{ route('home-landing') }}">
                <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img"
                    style="max-height: 4rem; width: auto;" alt="main_logo">
            </a>
        </div>
    </div>

    <div class="container-fluid overflow-hidden py-4" id="container-payment">
        <div class="row mt-4">
            <div class="col-md-8">
                <h4 class="pb-1 pt-4">Productos</h4>
                <div class="list-group-item text-center" style="padding-bottom: 1rem;">
                    @foreach ($cart as $item)
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <a href="#" class="show-picture-modal" data-img-url="{{ $item->options->urlfoto }}">
                                    <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="120">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <hr>
                                <span class="card-text">Cantidad: {{ $item->qty }}</span>
                                <br>
                                <span class="card-text">Precio: ${{ $item->price }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <h4 class="pb-1 pt-4">Métodos de Envío</h4>
                <div class="list-group-item">
                    <span style="font-size: 1rem;"> Método: {{ $shipment_type }}</span>
                    <hr>
                    <span> Dirección: {{ Auth::user()->address }}, {{ Auth::user()->city_fk }}</span>
                </div>
                <h4 class="pb-1 pt-4">Métodos de Pago</h4>
                <div class="card-deck">
                    @foreach ($paymentMethods as $paymentMethod)
                        @if ($paymentMethod->visible)
                            <div class="card" data-payment-method-id="{{ $paymentMethod->id }}"
                                onclick="selectPaymentMethod(this)">
                                <div class="card-body d-flex flex-column align-items-center selectable-payment-method"
                                    style="cursor: pointer;">
                                    <div
                                        class="payment-method-image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('argon/assets/img/images-paymethods/' . $paymentMethod->imagen) }}"
                                            alt="Imagen del método de pago" class="img-fluid" style="max-height: 100px;">
                                    </div>
                                    <h6 class="card-title text-truncate text-center multiline-text"
                                        style="margin-top:1rem;size: 0.6rem; height: auto; overflow: hidden; white-space: normal; word-break: break-all;">
                                        {{ $paymentMethod->name }}
                                    </h6>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                            id="paymentMethod{{ $paymentMethod->id }}" value="{{ $paymentMethod->id }}">
                                        <label class="form-check-label"
                                            for="paymentMethod{{ $paymentMethod->id }}">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="button-container">
                        <a href="{{ route('showcart') }}" class="btn btn-secondary">Volver al carrito</a>
                        <form action="{{ route('resume_checkout') }}" method="POST" id="shipment-form">
                            @csrf
                            <input type="hidden" name="paymentMethod" id="paymentMethod" value="">
                            <input type="hidden" name="shipment_type" id="shipment_type" value="{{ $shipment_type }}">
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="alert alert-warning" role="alert">
                    Debes estar conectado para continuar con la compra. Haz clic <a href="{{ route('login') }}">aquí</a>
                    para iniciar sesión.
                </div>
            </div>
        </div>
    @endguest
@endsection

@section('js')
    <script>
        window.onload = function() {
            if (window.performance && window.performance.navigation.type === 1) {
                // La página se ha cargado debido a un evento de recarga
                alert("Advertencia: la página se ha recargado. Verifique los datos antes de continuar.");
            }
        };
    </script>
    <script>
        function selectPaymentMethod(element) {
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                card.classList.remove('selected-payment-method');
            });

            element.classList.add('selected-payment-method');

            var radioInput = element.querySelector('.form-check-input');
            radioInput.checked = true;

            var paymentMethodId = element.getAttribute('data-payment-method-id');
            document.getElementById('paymentMethod').value = paymentMethodId;
        }

        // Validación del formulario antes de enviarlo
        document.getElementById('shipment-form').addEventListener('submit', function(event) {
            var selectedPaymentMethod = document.querySelector('.card.selected-payment-method');

            if (!selectedPaymentMethod) {
                event.preventDefault(); // Detiene el envío del formulario

                // Muestra un mensaje de error
                alert('Por favor, selecciona un método de pago antes de continuar.');
            }
        });
    </script>
@endsection
