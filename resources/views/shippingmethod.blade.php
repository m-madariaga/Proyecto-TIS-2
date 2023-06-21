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
            height: 20%;
            width: 100px;
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

        .cart-text{
            color:black;
        }

        .selected-method {
            border: 2px solid black !important;
        }

        .selected-method .card-title {
            color: black;
        }

        .selected-method .form-check-label {
            color: black !important;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4 mb-4" style="margin-top: 15rem;">
        <div class="breadcrumb mt-4">
            <div class="col-6">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm text-black active">
                        <a class="opacity-5 text-black" href="{{ route('showcart') }}">Volver al Carrito</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-black active">
                        <a class="opacity-5 text-black">Método Envío</a>
                    </li>
                </ol>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <form action="{{ route('shipments.create') }}" method="POST" id="shipment-form">
                        @csrf
                        <input type="hidden" name="shipment_type_id" id="selected-shipment-type" value="">
                        <input type="hidden" name="shipment_id" id="shipment-id" value="">
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
                                    @foreach ($shipment_types as $shipment_type)
                                        @if (
                                            ($selectedMethod === 'retiro' && stripos($shipment_type->nombre, 'retiro') !== false) ||
                                                ($selectedMethod === 'starken' && stripos($shipment_type->nombre, 'starken') !== false))
                                            <div class="card" data-shipment-type-id="{{ $shipment_type->id }}"
                                                onclick="selectShipmentType(this)">


                                                <div class="card-body d-flex flex-column align-items-center selectable-shipment-method"
                                                    style="cursor: pointer;">
                                                    <h4 class="card-title text-truncate text-center"
                                                        style="font-size: 1.5rem; height: 3rem; overflow: hidden;">
                                                        {{ $shipment_type->nombre }}</h4>
                                                    <div class="form-check mt-2">
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
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function selectShipmentType(element) {
            const shipmentTypeId = element.getAttribute('data-shipment-type-id');
            const selectedShipmentType = document.getElementById('selected-shipment-type');
            const shipmentForm = document.getElementById('shipment-form');

            if (selectedShipmentType.value === shipmentTypeId) {
                // Si se hace clic en el mismo card, se deselecciona
                element.classList.remove('selected', 'selected-method');
                selectedShipmentType.value = '';
            } else {
                // Seleccionar el card y establecer el valor en el campo oculto
                const selectedCard = document.querySelector('.selectable-shipment-method.selected');
                if (selectedCard) {
                    selectedCard.classList.remove('selected', 'selected-method');
                }
                element.classList.add('selected', 'selected-method');
                selectedShipmentType.value = shipmentTypeId;
            }

            // Mostrar el SweetAlert si no se ha seleccionado un método de envío al enviar el formulario
            shipmentForm.addEventListener('submit', function(event) {
                if (!selectedShipmentType.value) {
                    event.preventDefault();
                    swal('Error', 'Por favor, selecciona un método de envío.', 'error');
                }
            });
        }
    </script>
@endsection
