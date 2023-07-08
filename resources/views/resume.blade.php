@extends('layouts-landing.welcome')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/css/method_style.css') }}">

    <style>
        .header-content {
            display: flex;
            align-items: center;
            height: 100%;
            padding-left: 15px;
        }

        .navbar-brand-img {
            height: 70%;
            width: 300px;
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

        .cart-text {
            color: black;
        }
    </style>
@endsection

@section('content')

    <div class="container py-4 mb-4" style="margin-top: 15rem;">

        <div class="breadcrumb mt-4">
            <div class="col-6">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm underline-hove"><a class="opacity-5 text-black"
                            href="{{ route('showcart') }}">Volver al Carrito</a></li>
                    <li class="breadcrumb-item text-sm underline-hover"><a class="opacity-5 text-black"
                            style="cursor: pointer;">Método Envío</a></li>
                    <li class="breadcrumb-item text-sm underline-hove"><a class="opacity-5 text-black">Método Pago</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-black active" aria-current="page">Resumen</li>

                </ol>
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
                                                <span class="card-text">Precio: ${{ number_format($item->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-body border border-primary rounded">
                                <div class="d-flex justify-content-end">
                                    <span class="card-text">Total a Pagar: ${{ Cart::subtotal() }}</span>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="form-check form-check-info text-end">
                                        <input class="form-check-input me-1" type="checkbox" value=""
                                            id="terms-checkbox">
                                        <label class="form-check-label d-flex align-items-center" for="terms-checkbox">
                                            <span class="me-2">Estoy de acuerdo con los <a href="#modal-terminos"
                                                    class="text-dark font-weight-bolder modal-trigger"><b>Términos y
                                                        Condiciones</b></a></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="card">
                            <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-0 fw-bold">{{ __('Resumen Información') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <span class="cart-text">Nombre: {{ Auth::user()->name }}</span>
                                        <hr>
                                        <span class="cart-text">Número de Celular:
                                            {{ Auth::user()->phone_number }}</span>
                                        <hr>
                                        <span class="cart-text">Correo Electrónico: {{ Auth::user()->email }}</span>
                                        <hr>
                                        <span class="cart-text">Dirección: {{ Auth::user()->address }},
                                            {{ Auth::user()->city->name }}</span>
                                        <hr>
                                        <span class="cart-text">Método de Envío: {{ $shipment_type }}</span>
                                        <hr>
                                        <span class="cart-text">Método de Pago: {{ $paymentMethod->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="d-flex justify-content-center">
                @if (strtolower($paymentMethod->name) == 'transferencia bancaria')
                    <form action="{{ route('checkout_transfer') }}" method="POST" id="shipment-form">
                        @csrf
                        <input type="hidden" name="paymentMethod" id="paymentMethod" value="{{ $paymentMethod->id }}">
                        <input type="hidden" name="shipment_type" id="shipment_type" value="{{ $shipment_type }}">
                        <button type="submit-button" class="btn btn-primary" id="submit-button">Continuar</button>
                        <input type="hidden" name="order" value="{{ json_encode($order) }}">
                    </form>
                @elseif (strtolower($paymentMethod->name) == 'webpay')
                    <form action="{{ route('checkout_transbank') }}" method="POST" id="webpay-form">
                        @csrf
                        <input type="hidden" name="order" value="{{ json_encode($order) }}">
                        <button type="submit" id="submit-button"class="btn btn-primary">Confirmar
                            Carrito</button>
                    </form>
                @elseif (strtolower($paymentMethod->name) == 'efectivo')
                    <form action="{{ route('confirmationcart', ['orderId' => $order->id]) }}" method="POST"
                        id="shipment-form">
                        @csrf

                        <button type="submit" class="btn btn-primary" id="submit-button">Confirmar
                            Carrito</button>
                    </form>
                @endif
            </div>
               </div>
        @endif


        <div id="modal-terminos" class="modal" style="width: 50%; max-height: 100%; top: 50%; left: 25%">
            <div class="modal-content" style="background-color: white;">
                <!-- Header del modal -->
                <div
                    style="display: flex; justify-content: space-between; align-items: center; background-color: #8c034e; padding: 1rem;">
                    <h4 class="modal-header" style="color: white; margin: 0;">Términos y Condiciones</h4>
                    <button type="button" class="modal-close" aria-label="Close"
                        style="padding: 0.5rem; background-color: transparent; border: none; color: white;">
                        <i class="fas fa-times"></i>

                    </button>
                </div>
                <!-- Contenido del modal -->
                <div style="padding: 2rem; overflow-y: auto; max-height: 600px;">
                    <div
                        class="three-fourths columns medium-down--one-whole offset-by-two is-hidden-offset-mobile-only page">
                        <span class="terms_p">
                            "La empresa a la que se adhieren los términos correspondientes corresponde a Vestuarios Que
                            Guay
                            SPA,
                            representada por Francisca Arias"
                        </span>
                        <br>
                        <br>
                        <ol>
                            <li>
                                <strong> GENERAL</strong>
                            </li>
                        </ol>
                        <P class="terms_p">La experiencia de comprar en www.queguay.azurewebsites.net es fácil y
                            segura. En
                            este sentido, la empresa Vestuarios Que Guay
                            trabaja con los más altos estándares de seguridad y toda la información que los usuarios
                            registran en el Sitio se mantiene de
                            forma estrictamente confidencial.</P>

                        <ol start="2">
                            <li>
                                <strong> DESPACHOS</strong>
                            </li>
                        </ol>
                        <P class="terms_p">Nuestros productos serán entregados a través de Chilexpress, Starken,
                            BluExpress
                            o 99Minutos dependiendo de la dirección de envío.
                            El plazo de entrega en región metropolitana y en todo el país es de hasta 5 días hábiles.
                            <br>
                            <br>
                            Para Eventos Especiales como Cyber Day, el plazo puede extenderse a un máximo de 15 días
                            hábiles. El tiempo final de despacho está sujeto
                            a los tiempos de distribución y servicio de empresas externas.
                            <br>
                            <br>

                            <strong class="terms_p">Para casos excepcionales o de fuerza mayor (Covid)</strong>
                            ", el plazo estará sujeto a los tiempos de distribución y servicio de las empresas de
                            courier
                            antes mencionadas, así como a las limitaciones
                            declaradas por la autoridad."
                            <br>
                            <br>
                            Al momento de realizar tu pedido el sistema calculará automáticamente un monto de envío
                            según tu
                            dirección.
                            <br>
                            <br>
                            El número de seguimiento de tu pedido te será enviado por mail una vez que sea entregado al
                            courier.
                            <br>
                            <br>
                            En caso de solicitar la opción de retiro en sucursal Chilexpress o Starken es de
                            responsabilidad
                            del cliente retirar el pedido antes de cumplidos 14
                            días en sucursal. De lo contrario el envío se devolverá a nuestra bodega y el cliente deberá
                            pagar los costos de envío asociados.
                        </p>
                        <p>
                            <span class="terms_p">
                                Vestuarios Que Guay no se responsabiliza por la NO ENTREGA de pedidos por error en la
                                digitación de la dirección de despacho.
                                Se sugiere a todos los clientes corroborar los datos antes de finalizar su compra.
                            </span>
                        </p>
                        <p>
                            <span class="terms_p">
                                Toda Promoción de envío es exclusiva para productos marca Que Guay! a no ser que se
                                informe
                                lo contrario.
                            </span>
                        </p>

                        <ol start="3">
                            <li>
                                <strong>MEDIDAD DE SEGURIDAD</strong>
                            </li>
                        </ol>
                        <P class="terms_p">Para cumplir los objetivos de seguridad Que Guay! cuenta con la tecnología
                            SSL
                            (Secure Sockets Layer) que asegura, tanto la autenticidad del Sitio,
                            como el cifrado de toda la información que nos entrega el usuario. Cada vez que el usuario
                            se
                            registra en el Sitio y entrega información de carácter
                            personal, sin importar el lugar geográfico en donde se encuentre, a efectos de comprar un
                            producto, el navegador por el cual ejecuta el acto se
                            conecta al Sitio a través del protocolo SSL que acredita que el usuario se encuentra
                            efectivamente en el Sitio y en nuestros servidores
                            (lo cual se aprecia con la aparición del código HTTPS en la barra de direcciones del
                            navegador).
                            De esta forma se establece un método de
                            cifrado de la información entregada por el usuario y una clave de sesión única. Esta
                            tecnología
                            permite que la información de carácter personal
                            del usuario, como su nombre, dirección y datos de tarjetas bancarias, sean codificadas antes
                            para que no pueda ser leída cuando viaja a través de
                            Internet. Todos los certificados SSL se crean para un servidor particular, en un dominio
                            específico y para una entidad comercial comprobada. </P>

                        <br>


                        <ol start="4">
                            <li>
                                <strong>DECLARACIÓN DE PRIVACIDAD</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Vestuarios Que Guay no comunica ni cede a terceros, bajo ninguna
                            circunstancia,
                            los datos de carácter personal registrados por los usuarios
                            en el Sitio. Sin perjuicio de lo anterior, esta información podrá ser tratada por Vestuarios
                            Que
                            Guay y sus asociados, únicamente para fines
                            estadísticos y/o para obtener una mejor comprensión de los perfiles de los usuarios y, así,
                            mejorar los productos ofrecidos en el Sitio.</p>
                        <br>

                        <ol start="5">
                            <li>
                                <strong>INFORMACIÓN DEL USUARIO</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Al registrarse en el Sitio se le solicitará al usuario solamente aquella
                            información necesaria para el pago del producto y
                            su posterior envío. En ningún caso, esta información será comunicada o transmitida a
                            terceros
                            ajenos a Vestuarios Que Guay , Que guay
                            no almacena ni conserva la información de la tarjeta bancaria del usuario.</p>
                        <br>
                        <ol start="6">
                            <li>
                                <strong>DATOS PERSONALES</strong>
                            </li>
                        </ol>
                        <p class="terms_p">El usuario registrado podrá ejercer sus derechos de información,
                            modificación,
                            eliminación, cancelación y/o bloqueo de sus datos personales
                            cuando lo estime pertinente, según lo establecido en la Ley Nº 19.628 sobre Protección de la
                            Vida Privada. Vestuarios Que Guay pone a
                            disposición del usuario una dirección de correo electrónico (contacto@queguay.cl), un número
                            telefónico +569 57162265 a disposición de éste
                            para efectos de poder solicitar la modificación y/o corrección de sus datos personales.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "Confirmar Carrito" button element
            var confirmButton = document.getElementById('confirmar-carrito');

            // Add a click event listener to the button
            confirmButton.addEventListener('click', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Show the Sweet Alert confirmation dialog
                swal({
                        title: "Confirmar Pedido",
                        text: "¿Estás seguro de confirmar el carrito?",
                        icon: "warning",
                        buttons: ["Cancelar", "Confirmar"],
                        dangerMode: true,
                    })
                    .then(function(confirm) {
                        // If the user confirms, submit the form
                        if (confirm) {
                            document.getElementById('shipment-form').submit();
                        }
                    });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endsection
