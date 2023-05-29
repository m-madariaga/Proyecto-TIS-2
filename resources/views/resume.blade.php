@extends('layouts-landing.welcome')

@section('css')
    @parent
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
    </style>
@endsection

@section('content')
    <div class="header_resume">
        <div class="header-content">
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img"
                style="max-height: 20rem; width: auto;" alt="main_logo">
        </div>
    </div>

    <div class="container-fluid overflow-hidden" id="container-payment">
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        @foreach ($cart as $item)
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <a href="#" class="show-picture-modal"
                                        data-img-url="{{ $item->options->urlfoto }}">
                                        <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="70">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="card-title">{{ $item->name }}</h6>
                                    <p class="card-text">Precio: ${{ $item->price }}</p>
                                    <p class="card-text">Cantidad: {{ $item->qty }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Método de envío</h5>
                        <p>Método de envío: {{ $shipment_type }}</p>
                        <p>Dirección: {{ Auth::user()->address }}, {{ Auth::user()->city->name }}</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Métodos de Pago</h5>
                        <div class="form-check">
                            <p>Método de envío: {{ $paymentMethodName }}</p>
                        </div>

                    </div>
                </div>
                <div class="button-container">
                    <a href="#" class="btn btn-secondary">Cancelar</a>
                    <form action="{{ route('confirmcart') }}" method="POST" id="shipment-form">
                        @csrf
                        <button type="submit" class="btn btn-primary">Realizar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
