@extends('layouts.argon.app')

@section('title')
    {{ 'Roles' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Roles</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Roles</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <h6>Tabla de Roles</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                        <div class="table-responsive p-0">
                            <table id="roles-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Tipo de Rol</th>
                                        <th class="text-center">Cantidad de usuarios</th>


                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td class="text-center">{{ $role->id }}</td>
                                            <td class="text-center">{{ $role->name }}</td>
                                            <td class="text-center">{{ $role->role_type }}</td>
                                            <td class="text-center">{{ $role->role_count }}</td>

                                            <td class="text-center pt-3">
                                                <button id="permissionsButton" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#permissionsModal" data-permissions-list="{{ $role->permissions }}">
                                                    Ver permisos
                                                </button>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-primary"><i
                                                        class="fa fa-edit"></i> Editar</a>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-role"
                                                        data-id="{{ $role->id }}"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="permissionsModal" tabindex="-1" role="dialog" aria-labelledby="permissionsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="permissionsModalLabel">Permisos</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center" id="permissionsList"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: '{{ session('success') }}',
                    timer: 3000
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif

    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            table = $('#roles-table').DataTable({
                dom: 'lrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });

        $('#searchBar').keyup(function(){
            table.search($(this).val()).draw() ;
        })
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-role', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(' kdñsñskd');
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
                    console.log(' kdñsñskd');
                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/roles/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Rol eliminado correctamente!',
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // delay for half a second
                        },
                        error: function(xhr, status, error) {
                            console.log(' kdñsñskd');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            
        });

         $('#permissionsModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget); // Button que triggerea el modal
                const permissions = button.data('permissions-list');

                console.log("permissions");

                console.log(permissions);

                permissions.forEach(function(entry) {
                    console.log(entry);
                });


                // const editForm = $('#editForm');
                var p = document.getElementById("permissionsList");
                p.innerHTML = permissions.join("<br>") ;
                


                // Actualizar ID de la ruta
                // const actionUrl = editForm.attr('action').replace('__ID__', userId);
                // editForm.attr('action', actionUrl);

                // Reemplazar el valor del nombre en el input el modal

            });
    </script>



@endsection