@extends('layouts.argon.app')

@section('title')
    {{ 'Permissions' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Permissions</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Permisos</h6>
@endsection

@section('css')

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                    </div>
                    <div class="card-body pb-2">
                        <div class="table-responsive">
                            <table id="permissions-table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Id</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nombre</th>
                                        
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="text-center">{{ $permission->id }}</td>
                                        <td class="text-center">{{ $permission->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-permission"
                                                    data-id="{{ $permission->id }}">Eliminar</button>
                                                </button>
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
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    

    <script>
        $(document).ready(function() {
            $('#permissions-table').DataTable({
                responsive: true,
                dom: 'lfrtip',
                
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-permission', function(e) {
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
                        url: '/admin/permissions/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Permiso eliminado correctamente!',
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
    </script>



@endsection