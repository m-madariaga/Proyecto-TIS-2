@extends('layouts.argon.app')

@section('title')
    {{ 'Usuarios' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Usuarios</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Usuarios</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <h6>Tabla de Usuarios</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <button class="btn btn-sm btn-outline-success ms-4" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            Añadir Usuario
                        </button>

                        <!-- MODAL ADD USER -->
                        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Añadir Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" id="addUserForm" action="{{ route('users.store') }}">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nombre:</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail:</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_number">Número Celular:</label>
                                                <input type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                                    name="phone_number" required>
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Contraseña:</label>
                                                <input type="password"
                                                    class="form-control  @error('password') is-invalid @enderror"
                                                    id="password" name="password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="run">RUN:</label>
                                                <input type="text"
                                                    class="form-control @error('run') is-invalid @enderror" id="run"
                                                    name="run" required>

                                                @error('run')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Dirección:</label>
                                                <input type="text"
                                                    class="form-control  @error('address') is-invalid @enderror"
                                                    id="address" name="address" required>

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="role">Rol:</label>
                                                <select id="role1"
                                                    class="form-select @error('role') is-invalid @enderror" name="role"
                                                    required>
                                                    <option value="">Seleccionar Rol</option>
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="country">País:</label>
                                                <select id="country"
                                                    class="form-select @error('country') is-invalid @enderror"
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

                                            <div class="mb-3">
                                                <label for="region">Región:</label>
                                                <select id="region"
                                                    class="form-select @error('region') is-invalid @enderror"
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

                                            <div class="mb-3">
                                                <label for="city">Ciudad:</label>
                                                <select id="city"
                                                    class="form-select @error('city') is-invalid @enderror" name="city_fk"
                                                    required>
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

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-sm btn-outline-success">Añadir</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('users.generate_pdf') }}" hidden>Descargar pdf</a>
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Run</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Número Celular</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Visto ultima vez</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->run }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->phone_number }}</td>
                                            <td class="text-center">
                                                {{ $user->roleName() }}
                                            </td>
                                            <td class="text-center">
                                                @if (Cache::has('is_online' . $user->id))
                                                    <span class="text-success">En linea</span>
                                                @else
                                                    <span class="text-secondary">Desconectado</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                El {{ \Carbon\Carbon::parse($user->last_seen)->format('d') }}
                                                de {{ \Carbon\Carbon::parse($user->last_seen)->format('F') }}
                                                a las {{ \Carbon\Carbon::parse($user->last_seen)->format('H') }} hrs
                                            </td>
                                            <td class="text-center pt-3">
                                                <button id="editButton"
                                                    class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-user-id="{{ $user->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-user"
                                                        data-id="{{ $user->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"> Delete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Editar rol de usuario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm"
                                            action="{{ route('users.update', ['id' => '__ID__']) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="role">Rol:</label>
                                                    <select class="form-control form-select" id="role"
                                                        name="role">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-success">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        // Usar Ajax para manejar el envio del formulario del modal para añadir usuarios
        var addUserForm = document.getElementById('addUserForm');
        addUserForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene enviar de inmediato el form

            var formData = new FormData(addUserForm);
            var xhr = new XMLHttpRequest();
            //usar xhr para manejar la respuesta del controlador
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        // se parsea a json debido a que el controlador entrega un json
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // SE crea el usuario
                            $('#addUserModal').modal('hide'); // se esconde el modal
                            location.reload(); // se recarga al mismo tiempo que se esconde el modal
                        } else {
                            // muestra los errores
                            displayErrors(response.errors);
                        }
                    } else {
                        // Handle AJAX request error
                        console.error('AJAX request error');
                    }
                }
            };

            xhr.open('POST', addUserForm.getAttribute('action'));
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(formData);
        });

        // Funcion que muestra errores de validacion
        function displayErrors(errors) {
            // Limpia errores anteriores
            $('.invalid-feedback').html('');

            // Muestra los errores nuevos
            for (var field in errors) {
                var errorMessages = errors[field];
                var errorField = $('#' + field);
                errorField.addClass('is-invalid');
                errorField.siblings('.invalid-feedback').html(errorMessages.join('<br>'));

                var errorLabel = $('<span>').addClass('error-message text-danger').text(errorMessages.join(', '));
                errorField.after(errorLabel);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                dom: 'lfrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });
        $('#addUserModal').on('hide.bs.modal', function() {
            $('.invalid-feedback').html('');
            $('.error-message').remove();
        });

        // Clear error messages when the form is submitted successfully
        addUserForm.addEventListener('submit', function() {
            $('.invalid-feedback').html('');
            $('.error-message').remove();
        });

        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Button que triggerea el modal
            const userId = button.data('user-id');


            const editForm = $('#editForm');


            // Actualizar ID de la ruta
            const actionUrl = editForm.attr('action').replace('__ID__', userId);
            editForm.attr('action', actionUrl);

            // Reemplazar el valor del nombre en el input el modal

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
