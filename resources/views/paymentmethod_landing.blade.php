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

        .underline-hover:hover {
            text-decoration: underline;
        }

        .card.selected-payment-method {
            border: 2px solid black;
        }

        .card.selected-payment-method::after {
            content: 'Seleccionado';
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: black;
            color: white;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4 mb-1" style="margin-top: 15rem;">
        <div class="breadcrumb mt-4">
            <div class="col-6">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm text-black active"><a class="opacity-5 text-black"
                            href="{{ route('showcart') }}">Volver al Carrito</a></li>
                    <li class="breadcrumb-item text-sm underline-hover"><a class="opacity-5 text-black"
                            style="cursor: pointer;">Método Envío</a></li>
                    <li class="breadcrumb-item text-sm text-black active"><a class="opacity-5 text-black">Método Pago</a>
                    </li>
                </ol>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <form action="{{ route('resume_checkout') }}" method="POST" id="shipment-form">
                        @csrf
                        <input type="hidden" name="paymentMethod" id="paymentMethod" value="">
                        <input type="hidden" name="shipment_type" id="shipment_type" value="{{ $shipment_type }}">
                        <input type="hidden" name="order" value="{{ json_encode($order) }}">

                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
        @if (!Auth::check())
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="alert alert-warning" role="alert">
                        Debes estar conectado para continuar con la compra. Haz clic <a href="{{ route('login') }}">aquí</a>
                        para iniciar sesión.
                    </div>
                </div>
            </div>
        @else
            <div class="container py-4 mb-4" style="margin-top: 2rem;">
                <div class="row">
                    <div class="col-md-7 col-12">
                        <div class="card">
                            <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-0 fw-bold">{{ __('Productos') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->
                            <div class="card-body" id="profile_card_body">
                                <div class="list-group-item text-center" style="padding-bottom: 1rem;">
                                    @foreach ($cart as $item)
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-md-6">
                                                <a href="#" class="show-picture-modal"
                                                    data-img-url="{{ $item->options->urlfoto }}">
                                                    <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}"
                                                        width="120">
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
                        </div>
                    </div>

                    <div class="col-md-5 col-12">
                        <div class="card">
                            <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-0 fw-bold">{{ __('Métodos de Envios') }}</h4>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="list-group-item">
                                        <span style="font-size: 1rem;"> Método: {{ $shipment_type }}</span>
                                        <hr>
                                        <span> Dirección: {{ Auth::user()->address }},
                                            {{ Auth::user()->city->name }}</span>
                                    </div>
                                </div>
                            </div>
                            {{-- ------------------------------- --}}
                            <hr>
                            {{-- -------------------------------------- --}}
                            <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-0 fw-bold">{{ __('Métodos de Pago') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @foreach ($paymentMethods as $paymentMethod)
                                        @if ($paymentMethod->visible)
                                            <div class="card" data-payment-method-id="{{ $paymentMethod->id }}"
                                                onclick="selectPaymentMethod(this)">
                                                <div class="card-body d-flex flex-column align-items-center selectable-payment-method"
                                                    style="cursor: pointer;">
                                                    <div
                                                        class="payment-method-image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset('argon/assets/img/images-paymethods/' . $paymentMethod->imagen) }}"
                                                            alt="Imagen del método de pago" class="img-fluid"
                                                            style="max-height: 100px;">
                                                    </div>
                                                    <h6 class="card-title text-truncate text-center multiline-text"
                                                        style="margin-top:1rem;size: 0.6rem; height: auto; overflow: hidden; white-space: normal; word-break: break-all;">
                                                        {{ $paymentMethod->name }}
                                                    </h6>

                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                                            id="paymentMethod{{ $paymentMethod->id }}"
                                                            value="{{ $paymentMethod->id }}">
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
                    </div>
                </div>
            </div>
        @endif
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
                    <span> Dirección: {{ Auth::user()->address }}, {{ Auth::user()->city->name }}</span>
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

        // Agrega el siguiente código al final del archivo
        $(document).ready(function() {
            $('.card').click(function() {
                selectPaymentMethod(this);
            });
        });
    </script>
@endsection