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
@endsection
