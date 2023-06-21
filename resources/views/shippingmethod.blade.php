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

        /* Ajusta el ancho de los contenedores */
        .container-fluid {
            padding: 0px 25rem 0px;
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

        .cart-text {
            color: black;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4 mb-4" style="margin-top: 15rem;">
        <div class="button-container">
            <button class="btn btn-secondary" onclick="goBack()">Regresar</button>
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
                                    @foreach ($shipment_types as $shipment_type)
                                        @if (
                                            ($selectedMethod === 'retiro' && stripos($shipment_type->nombre, 'retiro') !== false) ||
                                                ($selectedMethod === 'starken' && stripos($shipment_type->nombre, 'starken') !== false))
                                            <div class="card" data-shipment-type-id="{{ $shipment_type->id }}"
                                                onclick="selectShipmentType(this)">
                                                <div class="card-body d-flex flex-column align-items-center selectable-shipment-method"
                                                    style="cursor: pointer;">
                                                    <h4 class="card-title text-truncate text-center"
                                                        style="font-size: 1.2rem; height: 3rem; overflow: hidden;">
                                                        {{ $shipment_type->nombre }}</h4>
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="radio" name="shipment_type"
                                                            id="shipment_type{{ $shipment_type->id }}"
                                                            value="{{ $shipment_type->id }}">
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
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="button-container">
                                    <a href="{{ route('showcart') }}" class="btn btn-secondary">Volver al carrito</a>
                                    <form action="{{ route('shipments.create') }}" method="POST" id="shipment-form">
                                        @csrf

                                        <input type="hidden" name="shipment_type_id" id="selected-shipment-type"
                                            value="">
                                        <input type="hidden" name="shipment_id" id="shipment-id" value="">
                                        <input type="hidden" name="order" value="{{ json_encode($order) }}">

                                        <button type="submit" class="btn btn-primary">Continuar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
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
