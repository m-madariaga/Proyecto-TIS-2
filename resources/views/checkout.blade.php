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
        <h4 class="pb-1 pt-4">Datos Cliente</h4>
        <div class="row mt-4">

            <div class="card-header">Make a payment</div>

                <div class="card-body">
                    <form action="{{ route('pay') }}" method="POST" id="paymentForm">
                        @csrf

                        <div class="row">
                            <div class="col-auto">
                                <label>How much you want to pay?</label>
                                <input
                                    type="number"
                                    min="5"
                                    step="0.01"
                                    class="form-control"
                                    name="value"
                                    value="{{ mt_rand(500, 100000) / 100 }}"
                                    required
                                >
                                <small class="form-text text-muted">
                                    Use values with up to two decimal positions, using dot "."
                                </small>
                            </div>
                            <div class="col-auto">
                                <label>Currency</label>
                                <select class="custom-select" name="currency" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->iso }}">
                                            {{ strtoupper($currency->iso) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Select the desired payment platform:</label>
                                <div class="form-group" id="toggler">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @foreach ($paymentPlatforms as $paymentPlatform)
                                            <label
                                                class="btn btn-outline-secondary rounded m-2 p-1"
                                                data-target="#{{ $paymentPlatform->name }}Collapse"
                                                data-toggle="collapse"
                                            >
                                                <input
                                                    type="radio"
                                                    name="payment_platform"
                                                    value="{{ $paymentPlatform->id }}"
                                                    required
                                                >
                                                <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}">
                                            </label>
                                        @endforeach
                                    </div>
                                    @foreach ($paymentPlatforms as $paymentPlatform)
                                        <div
                                            id="{{ $paymentPlatform->name }}Collapse"
                                            class="collapse"
                                            data-parent="#toggler"
                                        >
                                            @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-auto">
                                <p class="border-bottom border-primary rounded">
                                    @if (! optional(auth()->user())->hasActiveSubscription())
                                       Would you like a discount every time?
                                       <a href="{{ route('subscribe.show') }}">Subscribe</a>

                                    @else
                                       You get a <span class="font-weight-bold">10% off</span> as part of your subscription (will be applied in the checkout)
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" id="payButton" class="btn btn-primary btn-lg">Pay</button>
                        </div>
                    </form>
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
@endsection
