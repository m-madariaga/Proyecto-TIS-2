@extends('layouts.argon.app')

@section('title')
    {{ 'Regiones' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Regiones</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Regiones</h6>
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
                        <h6>Tabla de Regiones</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <button class="btn btn-sm btn-outline-success ms-4" data-bs-toggle="modal"
                            data-bs-target="#addRegionModal">
                            Añadir Región
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addRegionModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Añadir Región</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" id="addRegionForm" action="{{ route('regions.store') }}">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nombre Región:</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label for="country_fk">País a que pertenece:</label>
                                                <select class="form-control form-select" id="country_fk" name="country_fk">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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

                        <div class="table-responsive p-0">
                            <table id="regions-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre Región</th>
                                        <th class="text-center">País</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regions as $region)
                                        <tr>
                                            <td class="text-center">{{ $region->name }}</td>
                                            <td class="text-center">{{ $region->country->name }}</td>

                                            <td class="text-center pt-3">
                                                <button id="editButton"
                                                    class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-region-id="{{ $region->id }}"
                                                    data-region-name="{{ $region->name }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form action="{{ route('regions.destroy', $region->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-region"
                                                        data-id="{{ $region->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"> Borrar</i></button>
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
                                            <h5 class="modal-title" id="editModalLabel">Editar Región</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm"
                                            action="{{ route('regions.update', ['id' => '__ID__']) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="editName">Región:</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="editName" name="name"required>
                                                    @error('name')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="country_fk">País al que pertenece:</label>
                                                    <select class="form-control form-select" id="country_fk"
                                                        name="country_fk">
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">
                                                                {{ $country->name }}
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-region', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/regions/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Región eliminado correctamente!',
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // delay for half a second
                        },
                        error: function(xhr, status, error) {

                            console.log(xhr.responseText);
                        }
                    });
                }
            });


        });
    </script>
    <script>
        // Usar Ajax para manejar el envio del formulario del modal para añadir usuarios
        var addRegionForm = document.getElementById('addRegionForm');
        addRegionForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene enviar de inmediato el form

            var formData = new FormData(addRegionForm);
            var xhr = new XMLHttpRequest();
            //usar xhr para manejar la respuesta del controlador
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        // se parsea a json debido a que el controlador entrega un json
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // SE crea el usuario
                            $('#addRegionModal').modal('hide'); // se esconde el modal
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '{{ session('success') }}',
                                timer: 1500
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
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

            xhr.open('POST', addRegionForm.getAttribute('action'));
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));
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
            table = $('#regions-table').DataTable({
                dom: 'lrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });

        $('#searchBar').keyup(function(){
            table.search($(this).val()).draw() ;
        })
        
        $('#addRegionModal').on('hide.bs.modal', function() {

            $('.error-message').remove();
        });

        // Clear error messages when the form is submitted successfully
        addRegionForm.addEventListener('submit', function() {
            $('.invalid-feedback').html('');
            $('.error-message').remove();
        });

        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Button que triggerea el modal
            const regionId = button.data('region-id');
            const regionName = button.data('region-name');

            const editForm = $('#editForm');


            // Actualizar ID de la ruta
            const actionUrl = editForm.attr('action').replace('__ID__', regionId);

            editForm.attr('action', actionUrl);
            const nameInput = $('#editName');
            nameInput.val(regionName);
            // Reemplazar el valor del nombre en el input el modal

        });
    </script>
@endsection
