@extends('layouts-landing.welcome')

@section('css')
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function(event) {
                event.preventDefault(); // Evita el envío del formulario

                Swal.fire({
                    title: '¿Está seguro?',
                    text: 'Se modificarán los datos del perfil',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, modificar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma la modificación, se envía el formulario
                        $('#updateForm').off(
                            'submit'); // Desactiva el evento submit para evitar un bucle infinito
                        $('#updateForm').submit(); // Envía el formulario
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 3000, // Tiempo en milisegundos (3 segundos)
                    showConfirmButton: false
                });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#updateFormpassword').submit(function(event) {
                event.preventDefault(); // Evita el envío del formulario

                Swal.fire({
                    title: '¿Está seguro?',
                    text: 'Se modificará la contraseña del Usuario',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, modificar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma la modificación, se envía el formulario
                        $('#updateFormpassword').off(
                            'submit'); // Desactiva el evento submit para evitar un bucle infinito
                        $('#updateFormpassword').submit(); // Envía el formulario
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 6000, // Tiempo en milisegundos (3 segundos)
                    showConfirmButton: false
                });
            @endif
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

    <script>
        $(document).ready(function() {


            $('#editProfileLandingModal').on('show.bs.modal', function() {
                // Do something when the modal is shown
            });

            $('#openModalButton').click(function() {
                $('#editPasswordLandingModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.view-order').on('click', function() {
                var orderId = $(this).data('order-id');
                var modalTableBody = $('#modal-table-body');
                modalTableBody.empty();
                var details = $('#order-details-' + orderId).html();
                modalTableBody.html(details);
                $('#modalvieworder').modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            table = $('#orderTable').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });

        });
    </script>
@endsection

@section('content')
    <div class="container py-4 mb-4" style="margin-top: 12rem;">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="card">
                    <div class="card-header pb-0 text-center text-md-start" id="profile_card_header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0 fw-bold">{{ __('Perfil') }}</h4>

                            </div>
                            <div class="d-flex align-items-center">
                                <button class="button_edit_profile btn btn-sm btn-rounded ms-2 mx-2 me-auto"
                                    data-bs-toggle="modal" data-bs-target="#editProfileLandingModal">Editar perfil</button>
                                <button type="button" class="button_edit_password btn btn-light btn-sm ms-2"
                                    data-bs-toggle="modal" data-bs-target="#editPasswordLandingModal">Cambiar
                                    contraseña</button>
                            </div>

                        </div>
                    </div>
                    <hr class="mt-4 mx-3 my-0"> <!-- Línea separadora -->
                    <div class="card-body" id="profile_card_body">
                        <!-- User Information -->
                        <p class="text-uppercase text-sm" id="profile_title">Información Usuario</p>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label"><b>Nombre</b></label>
                                    <span class="form-control border-0" id="profile_card_body">{{ Auth::user()->name }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="run" class="form-label"><b>RUN</b></label>
                                    <span class="form-control border-0" id="profile_card_body">{{ Auth::user()->run }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number" class="form-label"><b>Teléfono</b></label>
                                    <span class="form-control border-0"
                                        id="profile_card_body">+56 {{ Auth::user()->phone_number }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label"><b>Correo electrónico</b></label>
                                    <span class="form-control border-0" id="profile_card_body">{{ Auth::user()->email }}</span>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <label for="profile_image" class="form-label"><b>Imagen perfil</b></label>
                                <div class="d-flex justify-content-center">
                                    <img src="assets/images/images-profile/{{ Auth::user()->imagen }}" alt="profile_image"
                                        id="profile_image" class="border-radius-lg shadow-sm img-thumbnail"
                                        style="width: 70%;">
                                </div>
                            </div>
                        </div>


                        <hr class="horizontal dark">
                        <!-- Contact Information -->
                        <p class="text-uppercase text-sm" id="profile_title">Información dirección</p>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label"><b>Dirección</b></label>
                                    <span class="form-control border-0 " id="profile_card_body">{{ Auth::user()->address }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country" class="form-label"><b>País</b></label>
                                    <span class="form-control border-0"
                                        id="profile_card_body">{{ Auth::user()->country->name }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="region" class="form-label"><b>Región</b></label>
                                    <span class="form-control border-0"
                                        id="profile_card_body">{{ Auth::user()->region->name }}</span>

                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city" class="form-label"><b>Ciudad</b></label>
                                    <span class="form-control border-0" id="profile_card_body">{{ Auth::user()->city->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 fw-bold">{{ __('Historial de pedidos realizados') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="orderTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">N° PEDIDO</th>
                                        <th class="text-center">FECHA PEDIDO</th>
                                        <th class="text-center">TOTAL</th>
                                        <th class="text-center">ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @if ($order->user_id === Auth::user()->id && $order->estado === 1)
                                            <tr>
                                                <td class="text-center">{{ $order->id }}</td>
                                                <td class="text-center">{{ $order->created_at }}</td>
                                                <td class="text-center">${{number_format($order->total, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="view-order button_edit_profile btn btn-sm btn-rounded ms-2 mx-2 me-auto"
                                                        data-order-id="{{ $order->id }}">Ver Pedido</button>

                                                    <div class="d-none" id="order-details-{{ $order->id }}">
                                                        <table class="table">

                                                            <tbody>
                                                                @foreach ($order->details as $detail)
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            {{ $detail->product->nombre }}
                                                                        </td>

                                                                        <td class="text-center">{{ $detail->cantidad }}
                                                                        </td>
                                                                        <td class="text-center">${{ number_format($detail->precio, 0, ',', '.') }}
                                                                            
                                                                        </td>
                                                                        <td class="text-center">${{ number_format($detail->monto, 0, ',', '.') }}</td>
                                                                        <td class="text-center">
                                                                            {{ $detail->product->color }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $detail->product->talla }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <a href="{{ route('profile_landing_order_pdf', ['id' => $order->id]) }}"
                                                        type="button"
                                                        class="button_edit_profile btn btn-sm btn-rounded text-white me-auto m-2 mx-2">Detalle
                                                        en PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal EDITAR PERFIL -->
    <div class="modal fade" id="editProfileLandingModal" tabindex="-1" aria-labelledby="editProfileLandingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLandingModalLabel">Editar Perfil</h5>
                </div>

                <form method="POST" action="{{ route('profile_landing_edit', ['id' => Auth::user()->id]) }}"
                    enctype="multipart/form-data" id="updateForm">
                    @csrf
                    <div class="modal-body">
                        <p class="text-uppercase text-sm" id="profile_title">Información usuario</p>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text"
                                        class="form-control input-field @error('name') is-invalid @enderror"
                                        name="name" id="profile_card_body" value="{{ Auth::user()->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="run" class="form-label">Run</label>
                                    <input type="text"
                                        class="form-control input-field @error('run') is-invalid @enderror" name="run"
                                        value="{{ Auth::user()->run }}" required>
                                    @error('run')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Teléfono</label>
                                    <input type="text"
                                        class="form-control input-field @error('run') is-invalid @enderror"
                                        name="phone_number" value="{{ Auth::user()->phone_number }}" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="profile_card_body" value="{{ Auth::user()->email }}"
                                        required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="profile_image" class="form-label">Imagen Perfil</label>
                                    <input type="file"
                                        class="form-control input-field @error('profile_image') is-invalid @enderror"
                                        name="profile_image">
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm" id="profile_title">Información dirección</p>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input type="text"
                                        class="form-control input-field @error('address') is-invalid @enderror"
                                        name="address" value="{{ Auth::user()->address }}" required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country" class="form-label">País</label>
                                    <select id="country"
                                        class="form-control input-field @error('country_fk') is-invalid @enderror"
                                        name="country_fk" required>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_fk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="region" class="form-label">Región</label>
                                    <select id="region"
                                        class="form-control input-field @error('region_fk') is-invalid @enderror"
                                        name="region_fk" required>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('region_fk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <select id="city"
                                        class="form-control input-field @error('city_fk') is-invalid @enderror"
                                        name="city_fk" required>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_fk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- END MODAL -->

    <!-- Modal detalle pedido -->
    <div class="modal fade" id="modalvieworder" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detalles del Pedido</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="modal-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Precio Unitario</th>
                                    <th class="text-center">Precio Total</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Talla</th>
                                </tr>
                            </thead>
                            <tbody id="modal-table-body"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal -->

    <!-- MODAL PARA EDITAR CONTRASEÑA -->
    <div class="modal fade" id="editPasswordLandingModal" tabindex="-1" aria-labelledby="editProfileLandingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLandingModalLabel">Cambiar contraseña</h5>
                </div>

                <form method="POST" action="{{ route('change_password_landing') }}" id="updateFormpassword">
                    @csrf
                    <div class="modal-body">
                        <p class="text-uppercase text-sm" id="profile_title">Información usuario</p>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
                                <input id="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    name="current_password" required autofocus>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="form-label">{{ __('Nueva Contraseña') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-outline-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
