@extends('layouts-landing.welcome')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/method_style.css') }}">
<style>
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
            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img" style="max-height: 4rem; width: auto;" alt="main_logo">
        </a>
    </div>
</div>


<div class="container py-4 mb-4" style="margin-top: 2rem;">
    <div class="breadcrumb mt-4">
        <div class="col-6">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm underline-hove"><a class="opacity-5 text-black" href="{{ route('showcart') }}">Volver al Carrito</a></li>
                <li class="breadcrumb-item text-sm underline-hover"><a class="opacity-5 text-black" style="cursor: pointer;">Método Envío</a></li>
                <li class="breadcrumb-item text-sm underline-hove"><a class="opacity-5 text-black">Método Pago</a>
                </li>
                <li class="breadcrumb-item text-sm text-black active" aria-current="page">Resumen</li>

            </ol>
        </div>

    </div>
    <div class="row">
        <div class="col text-center mb-3">
            <div class="">
                <h2>Verificación de transferencia bancaria</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-12-md-6  mb-3">
            <div class="card">
                <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">{{ __('Detalle de compra') }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->
                <div class="table-responsive">
                    <div class="card-body" id="profile_card_body">
                        <div class="list-group-item text-center" style="padding-bottom: 1rem;">
                            @foreach ($cart as $item)
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-6">
                                    <a href="#" class="show-picture-modal" data-img-url="{{ $item->options->urlfoto }}">
                                        <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="100">
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

        </div>
        <div class="col-md-7 col-12-md-6">
            <div class="card">
                <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">{{ __('Datos para transferencia bancaria') }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->

                <div class="table-responsive">
                    <div class="card-body">
                        <span class="cart-text"><strong>Nombre:</strong> {{ $name }}</span>
                        <hr>
                        <span class="cart-text"><strong>RUN:</strong> {{ $run }}</span>
                        <hr>
                        <span class="cart-text"><strong>Email:</strong> {{ $email }}</span>
                        <hr>
                        <span class="cart-text"><strong>Banco:</strong> {{ $bank }}</span>
                        <hr>
                        <span class="cart-text"><strong>Tipo de cuenta:</strong> {{ $accountType }}</span>
                        <hr>
                        <span class="cart-text"><strong>Número de cuenta:</strong> {{ $accountNumber }}</span>
                        <hr>
                        <span class="cart-text"><strong>Total a Pagar:</strong>$ {{ Cart::subtotal() }}</span>
                        <hr>
                        <div class="mt-4">
                            <h4>Cargar comprobante de transferencia</h4>
                            <form action="{{ route('confirmtransferbank', ['orderId' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order" value="{{ json_encode($order) }}">
                                <input type="file" name="pdf_file">
                                @error('pdf_file')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <div> <button type="submit" class="btn btn-primary mt-2">Confirmar Carrito</button>
                                </div>
                            </form>
                        </div>

                    </div>

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