@extends('layouts.argon.app')

@section('title')
    {{ 'Paises' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Paises</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Paises</h6>
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
                        <h6>Tabla de Paises</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <button class="btn btn-sm btn-outline-success ms-4" data-bs-toggle="modal"
                            data-bs-target="#addCountryModal">
                            Añadir País
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addCountryModal" tabindex="-1" aria-labelledby="addModalLabel"
                            aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Añadir País</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" id="addCountryForm" action="{{ route('countries.store') }}">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nombre País:</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback d-block" role="alert">
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

                        <div class="table-responsive p-0">
                            <table id="countries-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre País</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $country)
                                        <tr>
                                            <td class="text-center">{{ $country->name }}</td>


                                            <td class="text-center pt-3">
                                                <button id="editButton"
                                                    class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-country-id="{{ $country->id }}"
                                                    data-country-name="{{ $country->name }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-country"
                                                        data-id="{{ $country->id }}"><i class="fa fa-trash"
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
                                            <h5 class="modal-title" id="editModalLabel">Editar nombre país</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm"
                                            action="{{ route('countries.update', ['id' => '__ID__']) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="editName">Pais:</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="editName" name="name"required>
                                                    @error('name')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
        var addCountryForm = document.getElementById('addCountryForm');
        addCountryForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene enviar de inmediato el form

            var formData = new FormData(addCountryForm);
            var xhr = new XMLHttpRequest();
            //usar xhr para manejar la respuesta del controlador
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {

                        // se parsea a json debido a que el controlador entrega un json
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // SE crea el usuario
                            $('#addCountryModal').modal('hide'); // se esconde el modal
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

            xhr.open('POST', addCountryForm.getAttribute('action'));
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
            $('#countries-table').DataTable({
                dom: 'lfrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });
        $('#addCountryModal').on('hide.bs.modal', function() {

            $('.error-message').remove();
        });

        // Clear error messages when the form is submitted successfully
        addCountryForm.addEventListener('submit', function() {
            $('.invalid-feedback').html('');
            $('.error-message').remove();
        });

        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Button que triggerea el modal
            const countryId = button.data('country-id');
            const countryName = button.data('country-name');

            const editForm = $('#editForm');


            // Actualizar ID de la ruta
            const actionUrl = editForm.attr('action').replace('__ID__', countryId);

            editForm.attr('action', actionUrl);
            const nameInput = $('#editName');
            nameInput.val(countryName);
            // Reemplazar el valor del nombre en el input el modal

        });

        // Clear error messages when the edit modal is hidden
        $('#editModal').on('hidden.bs.modal', function() {
            $(this).find('.invalid-feedback').html('');
            $(this).find('.error-message').remove();
        });
    </script>
@endsection
