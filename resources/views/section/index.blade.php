@extends('layouts.argon.app')

@section('title', 'Section Landing')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Vista Cliente</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Vista Cliente</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <style>
        .hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
@endsection

@section('content')
    <div class="row px-4">
        <div class="col-12 px-4 py-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="float-start">Modificaciones en la Vista Cliente</h5>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="col-6">
                            <h6 class="float-start">Configuración de Contacto</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('socialnetwork.create') }}"
                                class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Red Social</th>
                                                <th class="text-center">Valor</th>
                                                <th class="text-center">Mostrar</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($redesSociales as $redsocial)
                                                <tr>
                                                    <td class="text-center">{{ $redsocial->nombre }}</td>
                                                    <td class="text-center">{{ $redsocial->valor }}</td>
                                                    <td class="text-center">
                                                        @if ($redsocial->visible == '1')
                                                            Mostrar
                                                        @else
                                                            No mostrar
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('socialnetwork.edit', $redsocial->id) }}"
                                                            class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Editar</a>
                                                        <form action="{{ route('socialnetwork.destroy', $redsocial->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger delete-role"
                                                                data-id="{{ $redsocial->id }}"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i> Borrar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-4">
        <div class="col-12 px-4 py-4">
            <div class="card mt-1">
                <div class="card-body">
                    <div class="table-responsive">
                        <h6 class="float-start">Secciones Cliente</h6>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach ($secciones as $seccion)
                                        <th class="text-center">{{ $seccion->nombre }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <form id="sectionForm" action="{{ route('section.update') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <tr>
                                        @foreach ($secciones as $seccion)
                                            <td>
                                                <div class="form-group mb-0 ">
                                                    <select class="form-select" id="visible_{{ $seccion->id }}"
                                                        name="visible[]">
                                                        <option value="1"
                                                            {{ $seccion->visible == 1 ? 'selected' : '' }}>
                                                            Mostrar</option>
                                                        <option value="0"
                                                            {{ $seccion->visible == 0 ? 'selected' : '' }}>
                                                            No mostrar</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="{{ count($secciones) }}">
                                            <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-4">
        <div class="col-12 px-4 py-4">
            <div class="card mt-1">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="card">
                            <h6 class="float-start mt-4 px-4">Imagen del Logo</h6>

                            <div class="card-body text-center">
                                <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row mb-3">
                                            <input name="imagen" id="imagen" type="file" required>
                                            @error('imagen')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Imagen</button>
                                </form>
                            </div>

                            <!-- ------------------------------------------ -->
                            <hr class="horizontal dark my-sm-4">
                            <!-- ------------------------------------------ -->
                            <div class="imagen mx-auto w-100 text-center">
                                <form action="{{ route('images.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    @foreach ($images as $image)
                                        <li>
                                            <input type="checkbox" name="seleccion[]" value="{{ $image->id }}"
                                                @if ($image->seleccionada) checked @endif>
                                            <img src="{{ asset($image->direccion_imagen) }}" alt="Imagen"
                                                style="max-width: 400px; height: 60px;">
                                        </li>
                                    @endforeach
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar selección</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="float-start">Imagen del Logo Abajo</h6>
                            </div>
                            <div class="card-body">
                                <!-- Aquí puedes agregar tu código para cargar la imagen -->
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
    <script>
        // Obtener todas las casillas de verificación de imagen
        const checkboxes = document.querySelectorAll('input[name="seleccion[]"]');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                // Desactivar todas las casillas de verificación
                checkboxes.forEach((cb) => {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <script>
        // Agregar SweetAlert a todos los botones de borrado
        $('.delete-role').click(function(e) {
            e.preventDefault();
            var roleId = $(this).data("id");
            var form = $(this).closest("form");
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
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
    </script>
    <script>
        $('.toggle-visibility').click(function(e) {
            e.preventDefault();
            var sectionId = $(this).data("id");
            var sectionVisible = $(this).data("visible");
            var newVisible = sectionVisible == 1 ? 0 : 1;

            Swal.fire({
                title: '¿Estás seguro?',
                text: `Cambiar la visibilidad a ${newVisible == 1 ? 'Mostrar' : 'No mostrar'}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes realizar la llamada AJAX o enviar el formulario para actualizar la visibilidad en el backend
                    // Por ejemplo, puedes utilizar jQuery AJAX:
                    $.ajax({
                        url: '/section/' + sectionId,
                        type: 'PATCH',
                        data: {
                            visible: newVisible
                        },
                        success: function(response) {
                            // Actualizar la visualización del botón y mostrar una alerta de éxito
                            $(this).data("visible", newVisible);
                            $(this).text(newVisible == 1 ? 'Mostrar' : 'No mostrar');
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'La visibilidad ha sido actualizada',
                                icon: 'success'
                            });
                        },
                        error: function(xhr) {
                            // Mostrar una alerta de error si ocurre algún problema en el servidor
                            Swal.fire({
                                title: 'Error',
                                text: 'Se ha producido un error al actualizar la visibilidad',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>



@endsection
