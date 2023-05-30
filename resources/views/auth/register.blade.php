@extends('layouts.argon.auth')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
         .custom-modal-body {
        overflow-y: auto;
        max-height: calc(100vh - 200px); /* Ajusta la altura máxima del modal según tus necesidades */
    }
    </style>
@endsection


@section('content')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-color:hotpink; background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <a class="navbar-brand m-0" href="{{ route('home-landing') }}">
                            <img src="{{ asset('argon/assets/img/logo.png') }}" class="navbar-brand-img logo-img mb-2 mt-6"
                                alt="main_logo" id="imgchange_logo">
                            <span class="ms-1 font-weight-bold"></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Regístrate</h5>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3 col-12">

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" aria-label="Name"
                                            placeholder="Nombre" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Correo electrónico" aria-label="Email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3 col-12">
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}" required
                                            autocomplete="phone_number" aria-label="phone_number" placeholder="Teléfono"
                                            autofocus maxlength="10">
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 col-12">
                                        <input id="run" type="text"
                                            class="form-control @error('run') is-invalid @enderror" name="run"
                                            value="{{ old('run') }}" required autocomplete="run" aria-label="Run"
                                            placeholder="Run" autofocus maxlength="10">
                                        @error('run')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row">

                                    <!-- Include other input fields for name, email, password -->
                                    <div class="col-md-6 mb-3 col-12">
                                        <label for="country">Dirección</label>
                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" required autocomplete="address"
                                            aria-label="address" placeholder="Dirección" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-12">
                                        <label for="country">País:</label>
                                        <select id="country" class="form-select @error('country') is-invalid @enderror"
                                            name="country_fk" required>
                                            <option value="">Seleccionar País</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-12">
                                        <label for="region">Región:</label>
                                        <select id="region" class="form-select @error('region') is-invalid @enderror"
                                            name="region_fk" required>
                                            <option value="">Seleccionar Región</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-12">
                                        <label for="city">Ciudad:</label>
                                        <select id="city" class="form-select @error('city') is-invalid @enderror"
                                            name="city_fk" required>
                                            <option value="">Seleccionar Ciudad</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 mb-3 col-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="Contraseña">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 col-12">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Confirme contraseña">
                                    </div>

                                </div>


                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Estoy de acuerdo con <a href="#modal-terminos"
                                            class="text-dark font-weight-bolder modal-trigger">Términos y Condiciones</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-dark w-100 my-4 mb-2">Registrarse</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Iniciar sesión</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL TERMINOS Y CONDICIONES -->
    <div class="modal fade" id="modal-terminos" tabindex="-1" aria-labelledby="editProfileLandingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8C034E;">
                    <h5 class="modal-title pt-3 pb-2" id="modal-terminos" style="color: white">Términos y Condiciones</h5>
                </div>
                <div class="modal-body custom-modal-body">
                    <div class="three-fourths columns medium-down--one-whole offset-by-two is-hidden-offset-mobile-only page" style="padding: 1rem;">
                        <span class="terms_p">
                            "La empresa a la que se adhieren los términos correspondientes corresponde a Vestuarios Que Guay SPA,
                            representada por Francisca Arias"
                        </span>
                        <br>
                        <br>
                        <ol>
                            <li>
                                <strong>GENERAL</strong>
                            </li>
                        </ol>
                        <p class="terms_p">La experiencia de comprar en www.queguay.azurewebsites.net es fácil y segura. En este sentido, la
                            empresa Vestuarios Que Guay trabaja con los más altos estándares de seguridad y toda la información
                            que los usuarios registran en el Sitio se mantiene de forma estrictamente confidencial.</p>
    
                        <ol start="2">
                            <li>
                                <strong>DESPACHOS</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Nuestros productos serán entregados a través de Chilexpress, Starken, BluExpress o 99Minutos
                            dependiendo de la dirección de envío. El plazo de entrega en región metropolitana y en todo el país es de
                            hasta 5 días hábiles.
                            <br>
                            <br>
                            Para Eventos Especiales como Cyber Day, el plazo puede extenderse a un máximo de 15 días hábiles. El tiempo
                            final de despacho está sujeto a los tiempos de distribución y servicio de empresas externas.
                            <br>
                            <br>
                            <strong class="terms_p">Para casos excepcionales o de fuerza mayor (Covid)</strong>
                            ", el plazo estará sujeto a los tiempos de distribución y servicio de las empresas de courier antes
                            mencionadas, así como a las limitaciones
                            declaradas por la autoridad."
                            <br>
                            <br>
                            Al momento de realizar tu pedido el sistema calculará automáticamente un monto de envío según tu dirección.
                            <br>
                            <br>
                            El número de seguimiento de tu pedido te será enviado por mail una vez que sea entregado al courier.
                            <br>
                            <br>
                            En caso de solicitar la opción de retiro en sucursal Chilexpress o Starken es de responsabilidad del cliente
                            retirar el pedido antes de cumplidos 14 días en sucursal. De lo contrario el envío se devolverá a nuestra
                            bodega y el cliente deberá pagar los costos de envío asociados.
                        </p>
                        <p>
                            <span class="terms_p">
                                Vestuarios Que Guay no se responsabiliza por la NO ENTREGA de pedidos por error en la digitación de
                                la dirección de despacho. Se sugiere a todos los clientes corroborar los datos antes de finalizar su
                                compra.
                            </span>
                        </p>
                        <p>
                            <span class="terms_p">
                                Toda Promoción de envío es exclusiva para productos marca Qye Guay! a no ser que se informe lo contrario.
                            </span>
                        </p>
    
                        <ol start="3">
                            <li>
                                <strong>MEDIDAD DE SEGURIDAD</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Para cumplir los objetivos de seguridad Gnomo cuenta con la tecnología SSL (Secure Sockets
                            Layer) que asegura, tanto la autenticidad del Sitio, como el cifrado de toda la información que nos entrega
                            el usuario. Cada vez que el usuario se registra en el Sitio y entrega información de carácter personal,
                            sin importar el lugar geográfico en donde se encuentre, a efectos de comprar un producto, el navegador por
                            el cual ejecuta el acto se conecta al Sitio a través del protocolo SSL que acredita que el usuario se
                            encuentra efectivamente en el Sitio y en nuestros servidores (lo cual se aprecia con la aparición del código
                            HTTPS en la barra de direcciones del navegador). De esta forma se establece un método de cifrado de la
                            información entregada por el usuario y una clave de sesión única. Esta tecnología permite que la información
                            de carácter personal del usuario, como su nombre, dirección y datos de tarjetas bancarias, sean codificadas
                            antes para que no pueda ser leída cuando viaja a través de Internet. Todos los certificados SSL se crean para
                            un servidor particular, en un dominio específico y para una entidad comercial comprobada.
                        </p>
    
                        <br>
    
                        <ol start="4">
                            <li>
                                <strong>DECLARACIÓN DE PRIVACIDAD</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Vestuarios Que Guay no comunica ni cede a terceros, bajo ninguna circunstancia, los datos
                            de carácter personal registrados por los usuarios en el Sitio. Sin perjuicio de lo anterior, esta información
                            podrá ser tratada por Vestuarios Que Guay y sus asociados, únicamente para fines estadísticos y/o para
                            obtener una mejor comprensión de los perfiles de los usuarios y, así, mejorar los productos ofrecidos en el
                            Sitio.</p>
                        <br>
    
                        <ol start="5">
                            <li>
                                <strong>INFORMACIÓN DEL USUARIO</strong>
                            </li>
                        </ol>
                        <p class="terms_p">Al registrarse en el Sitio se le solicitará al usuario solamente aquella información necesaria
                            para el pago del producto y su posterior envío. En ningún caso, esta información será comunicada o transmitida
                            a terceros ajenos a Vestuarios Que Guay, Que guay no almacena ni conserva la información de la tarjeta
                            bancaria del usuario.</p>
                        <br>
    
                        <ol start="6">
                            <li>
                                <strong>DATOS PERSONALES</strong>
                            </li>
                        </ol>
                        <p class="terms_p">El usuario registrado podrá ejercer sus derechos de información, modificación, eliminación,
                            cancelación y/o bloqueo de sus datos personales cuando lo estime pertinente, según lo establecido en la Ley
                            Nº 19.628 sobre Protección de la Vida Privada. Vestuarios Que Guay pone a disposición del usuario una
                            dirección de correo electrónico (contacto@queguay.cl), un número telefónico +569 57162265 a disposición de
                            éste para efectos de poder solicitar la modificación y/o corrección de sus datos personales.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    


    {{-- FINAL MODAL --}}
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#country').on('change', function() {
                var countryId = $(this).val();


                $('#region').empty().append('<option value="">Seleccionar Región</option>');
                $('#city').empty().append('<option value="">Seleccionar Ciudad</option>');


                $.ajax({
                    url: '/regions/' + countryId,
                    type: 'GET',
                    success: function(response) {

                        $.each(response, function(key, value) {
                            $('#region').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });


            $('#region').on('change', function() {
                var regionId = $(this).val();


                $('#city').empty().append('<option value="">Seleccionar Ciudad</option>');


                $.ajax({
                    url: '/cities/' + regionId,
                    type: 'GET',
                    success: function(response) {

                        $.each(response, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
