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

        .underline-hover:hover {
            text-decoration: underline;
        }

        .card.selected-shipment-method {
            border: 2px solid black;
        }

        .card.selected-shipment-method::after {
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
                                        <h4 class="mb-0 fw-bold">{{ __('Métodos de Envíos') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @forelse ($shipment_types as $shipment_type)
                                        <div class="card" data-shipment-type-id="{{ $shipment_type->id }}"
                                            onclick="selectShipmentType(this)">
                                            <div class="card-body d-flex flex-column align-items-center selectable-shipment-method"
                                                style="cursor: pointer;">
                                                <h4 class="card-title text-truncate text-center"
                                                    style="font-size: 1.5rem; height: 3rem; overflow: hidden;">
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
                                    @empty
                                        <p>No se encontraron métodos de envío disponibles.</p>
                                    @endforelse
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
        window.onload = function() {
            if (window.performance && window.performance.navigation.type === 1) {
                // La página se ha cargado debido a un evento de recarga
                alert("Advertencia: la página se ha recargado. Verifique los datos antes de continuar.");
            }
        };

        function selectShipmentType(element) {
            const shipmentTypeId = element.getAttribute('data-shipment-type-id');
            const selectedShipmentTypeElement = document.querySelector('.card.selected-shipment-method');
            if (selectedShipmentTypeElement) {
                selectedShipmentTypeElement.classList.remove('selected-shipment-method');
            }
            element.classList.add('selected-shipment-method');
            document.getElementById('selected-shipment-type').value = shipmentTypeId;

            // Marcar el radio input correspondiente como seleccionado
            var radioInput = element.querySelector('.form-check-input');
            radioInput.checked = true;
        }
    </script>
@endsection

