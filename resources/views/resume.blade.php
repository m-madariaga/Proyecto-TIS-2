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
            background-image: url("assets/images/lienzo.jpg");
            background-size: cover;
            background-position: center;
            height: 300px;
        }

        .header-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .navbar-brand-img {
            max-height: 100%;
            max-width: 100%;
        }

        @media (max-width: 576px) {
            .header_resume {
                height: 200px;
            }
        }

        /* Agrega estilos para centrar los botones */
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
    </style>
@endsection

@section('content')
    <div class="header_resume">
        <div class="header-content">
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img"
                style="max-height: 20rem; width: auto;" alt="main_logo">
        </div>
    </div>

    <div class="container-fluid py-4 overflow-hidden" id="container-payment">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="resume-section">
                            <h2>Resumen del Pedido</h2>
                            <div class="list-group">
                                @foreach (Cart::content() as $index => $item)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <a href="#" class="show-picture-modal"
                                                    data-img-url="{{ $item->options->urlfoto }}">
                                                    <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}"
                                                        width="70">
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <p class="card-text">Precio: ${{ $item->price }}</p>
                                                <p class="card-text">Cantidad: {{ $item->qty }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="user-info-section">
                            <h2>Datos del Usuario</h2>
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">Nombre: {{ Auth::user()->name }}</p>
                                    <p class="card-text">Dirección: {{ Auth::user()->address }}</p>
                                    <p class="card-text">Dirección: {{ Auth::user()->phone_number }}</p>
                                    <p class="card-text">Ciudad: {{ Auth::user()->city_fk }}</p>
                                    <p class="card-text">Región: {{ Auth::user()->region_fk }}</p>
                                    <p class="card-text">País: {{ Auth::user()->country_fk }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
       
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="col-md-4">
                <div class="button-container">
                    <a href="{{ route('showcart') }}" class="btn btn-secondary">Volver al carrito</a>
                    <form action="{{ route('confirmcart') }}" method="POST">
                        @csrf
                        <!-- Agrega los campos necesarios para enviar los datos del formulario -->
                        <input type="hidden" name="payment_method_id" id="selected-payment-method">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
