@extends('layouts-landing.welcome')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/method_style.css') }}">
    <style>
        /* Estilos generales */
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

        /* Estilos para los datos del cliente */
        .customer-details {
            margin-bottom: 1.5rem;
            font-size: 18px;
        }

        .customer-details h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .customer-details p {
            margin-bottom: 0.3rem;
        }

        /* Estilos para la sección de inicio de sesión */
        .login-section {
            margin-top: 4rem;
            text-align: center;
        }

        .login-section .alert {
            margin-bottom: 1rem;
        }

        .login-section a {
            color: #007bff;
            font-weight: bold;
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

            <div class="container">
                <h1>Checkout con Transferencia Bancaria</h1>

                <div class="customer-details">
                    <h2>Datos del Cliente:</h2>
                    <p><strong>Nombre:</strong> {{ $name }}</p>
                    <p><strong>RUN:</strong> {{ $run }}</p>
                    <p><strong>Email:</strong> {{ $email }}</p>
                </div>

                <div class="customer-details">
                    <h2>Datos de Transferencia Bancaria:</h2>
                    <p><strong>Banco:</strong> {{ $bank }}</p>
                    <p><strong>Tipo de cuenta:</strong> {{ $accountType }}</p>
                    <p><strong>Número de cuenta:</strong> {{ $accountNumber }}</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="container">
                    <h2>Cargar Archivo PDF</h2>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pdf_file">
                        <button type="submit" class="btn btn-primary">Cargar</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="row mt-4">
            <div class="container">
                <form action="{{ route('confirmationcart', ['orderId' => $order->id]) }}" method="POST" id="shipment-form">
                    @csrf
                    <button type="submit" class="btn btn-primary" id="confirmar-carrito">Confirmar Carrito</button>
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
@endsection

@section('js')
@endsection
