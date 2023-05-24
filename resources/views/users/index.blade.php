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

                        <!-- Modal -->
                        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Añadir Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('users.store') }}">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nombre Usuario:</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">E-mail:</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Contraseña:</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Run:</label>
                                                <input type="text" class="form-control" id="run" name="run" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Dirección:</label>
                                                <input type="text" class="form-control" id="address" name="address" required>
                                            </div>
                                            <div class="mb-3">
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

                                            <div class="mb-3">
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

                                            <div class="mb-3">
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





                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-sm btn-outline-success">Añadir</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('users.generate_pdf')}}" hidden>Descargar pdf</a>
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Run</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Rol</th>


                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->run }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                {{ $user->roleName() }}
                                            </td>

                                            <td class="text-center pt-3">
                                                <button id="editButton"
                                                class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-user-id="{{ $user->id }}"
                                                >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-user"
                                                        data-id="{{ $user->id }}"><i class="fa fa-trash" aria-hidden="true"> Delete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Editar rol de usuario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm" action="{{ route('users.update', ['id' => '__ID__']) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="role">Rol:</label>
                                                    <select class="form-control form-select" id="role" name="role">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-sm btn-outline-success">Editar</button>
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
        $(document).ready(function() {
            $('#users-table').DataTable({
                dom: 'lfrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });
        $('#addUserModal').modal({
                show: false
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
