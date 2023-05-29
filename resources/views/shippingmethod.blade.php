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
            <div class="col-md-8">
                <div class="product-list">
                    <h6>Productos:</h6>
                    <h6>{{ Auth()->user()->name }}</h6>

                    <ul>
                        @foreach ($cart as $item)
                            <li>{{ $item->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-deck mb-4">
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
            <div class="col-md-8">
                <div class="col-md-4">
                    <div class="button-container">
                        <a href="{{ route('showcart') }}" class="btn btn-secondary">Volver al carrito</a>
                        <form action="{{ route('shipments.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shipment_type_id" id="selected-shipment-type" value="">
                            <input type="hidden" name="shipment_id" id="shipment-id" value="">
                            <button type="submit" class="btn btn-primary">Continuar</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
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

    </script>
@endsection
