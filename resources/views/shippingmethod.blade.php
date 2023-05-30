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

        /* Ajusta el ancho de los contenedores */

        .container-fluid {
            padding: 0px 10rem 0px;
        }


        /* Añade un poco de margen a los elementos dentro del cuadro de productos */
        .list-group-item .row {
            margin-bottom: 1rem;
        }

        /* Estilos para la tabla de productos */
        .product-table {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .product-table .table-row {
            display: table-row;
        }

        .product-table .table-cell {
            display: table-cell;
            padding: 8px;
            vertical-align: middle;
        }

        .product-table .table-cell img {
            max-width: 70px;
            max-height: 70px;
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

    <div class="container-fluid overflow-hidden py-4" id="container-payment">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="list-group-item">
                    <h6>Productos:</h6>
                    @foreach ($cart as $item)
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <a href="#" class="show-picture-modal" data-img-url="{{ $item->options->urlfoto }}">
                                    <img src="{{ $item->options->urlfoto }}" alt="{{ $item->name }}" width="70">
                                </a>
                            </div>
                            <div class="col-md-10">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">Precio: ${{ $item->price }}</p>
                                <p class="card-text">Cantidad: {{ $item->qty }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-deck">
                    @foreach ($shipment_types as $shipment_type)
                        @if (
                            ($selectedMethod === 'retiro' && stripos($shipment_type->nombre, 'retiro') !== false) ||
                                ($selectedMethod === 'starken' && stripos($shipment_type->nombre, 'starken') !== false))
                            <div class="card" data-shipment-type-id="{{ $shipment_type->id }}"
                                onclick="selectShipmentType(this)">
                                <div class="card-body d-flex flex-column align-items-center selectable-shipment-method"
                                    style="cursor: pointer;">
                                    <h5 class="card-title text-truncate text-center"
                                        style="font-size: 1.2rem; height: 3rem; overflow: hidden;">
                                        {{ $shipment_type->nombre }}</h5>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="shipment_type"
                                            id="shipment_type{{ $shipment_type->id }}" value="{{ $shipment_type->id }}">
                                        <label class="form-check-label"
                                            for="shipment_type{{ $shipment_type->id }}">Seleccionar</label>
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
                        <form action="{{ route('shipments.create') }}" method="POST" id="shipment-form">
                            @csrf
                            <input type="hidden" name="shipment_type_id" id="selected-shipment-type" value="">
                            <input type="hidden" name="shipment_id" id="shipment-id" value="">
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>

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
    </div>
@endsection

@section('js')
    <script>
        function selectShipmentType(element) {
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                card.classList.remove('selected-shipment-type');
            });

            element.classList.add('selected-shipment-type');

            var radioInput = element.querySelector('.form-check-input');
            radioInput.checked = true;

            var shipmentTypeId = element.getAttribute('data-shipment-type-id');
            var shipmentId = element.getAttribute('data-shipment-id'); // Obtén el ID de envío

            document.getElementById('selected-shipment-type').value = shipmentTypeId;
            document.getElementById('shipment-id').value = shipmentId; // Asigna el ID de envío al campo oculto
        }

        // Validación del formulario antes de enviarlo
        document.getElementById('shipment-form').addEventListener('submit', function(event) {
            var selectedShipmentType = document.querySelector('.card.selected-shipment-type');

            if (!selectedShipmentType) {
                event.preventDefault(); // Detiene el envío del formulario

                // Muestra un mensaje de error
                alert('Por favor, selecciona un método de envío antes de continuar.');
            }
        });
    </script>
@endsection
