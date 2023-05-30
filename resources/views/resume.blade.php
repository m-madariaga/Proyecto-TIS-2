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

        .text{
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

    <div class="container-fluid overflow-hidden" id="container-payment">
        <div class="row justify-content-center mt-4">
            <div class="col-md-3">
                <h4 class="pb-1 pt-4">Productos</h4>
                <div class="card">
                    <div class="card-body" style="max-width: 300px;">
                        @foreach ($cart as $item)
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <a href="#" class="show-picture-modal"
                                        data-img-url="{{ $item->options->urlfoto }}">
                                        <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="70">
                                    </a>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="card-title">{{ $item->name }}</h6>
                                        </div>
                                        <div class="col-12">
                                            <p class="card-text">Color: {{ $item->color }}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="card-text">Talla: {{ $item->talla }}</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end" style="padding-left: 1rem;">
                                                <p class="card-text">Precio: ${{ $item->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <div class="card mb-5">
                    <div class="card-body">
                        @foreach ($cart as $item)
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <p class="card-text text-end">Total a Pagar: ${{ $item->subtotal }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check form-check-info text-end">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    style="margin-left:1.1rem">
                                <label class="form-check-label d-flex align-items-center" for="flexCheckDefault"
                                    style="margin-left: 1rem;">
                                    <span>Estoy de acuerdo con</span>
                                    <a href="#modal-terminos" class="text-dark font-weight-bolder modal-trigger ms-2"><b>
                                            Términos y Condiciones</b></a>

                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <h4 class="pb-1 pt-4">Resumen Información</h4>
                <div class="card mb-4">

                    <div class="card-body">
                        <p>Número de Celular: {{ Auth::user()->phone_number }}</p>
                        <p>Correo Electrónico: {{ Auth::user()->email }}</p>

                        <p>Dirección: {{ Auth::user()->address }}, {{ Auth::user()->city->name }}</p>
                        <p>Método de Envío: {{ $shipment_type }}</p>
                        <p>Método de Pago: {{ $paymentMethodName }}</p>
                    </div>
                </div>

                <div class="button-container">
                    <a href="{{ route('showcart') }}" class="btn btn-secondary">Cancelar</a>
                    <form action="{{ route('confirmcart') }}" method="POST" id="shipment-form">
                        @csrf
                        <button type="submit" class="btn btn-primary">Realizar Pedido</button>
                    </form>
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
    </div>
@endsection
