@extends('layouts.argon.app')

@section('title')
    {{ 'Promociones' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Promociones</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Promociones</h6>
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
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <a class="btn btn-sm btn-outline-success ms-4" href="{{ route('promotion-create') }}">Agregar
                            promocion</a>
                        <div class="table-responsive p-0">
                            <table id="promotion-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Marca</th>
                                        <th class="text-center">Descuento</th>
                                        <th class="text-center">Precio Final</th>
                                        <th class="text-center">Quitar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promociones as $promocion)
                                        <tr>
                                            <td class="text-center">{{ $promocion->id }}</td>
                                            <td class="text-center">
                                                {{ $promocion->product->nombre }}
                                            </td>
                                            <td class="text-center">{{ $promocion->product->marca->nombre }}</td>
                                            <td class="text-center">${{ $promocion->descuento }}</td>
                                            <td class="text-center">${{ $promocion->product->precio }}</td>
                                            <td class="text-center">
                                                <a id="a-edit-promotion" href="{{ route('promotion-edit', ['id' => $promocion->id]) }}"
                                                    class="btn btn-sm btn-outline-primary edit-promotion" data-id="{{$promocion->id}}"><i class="fa fa-edit"></i>
                                                    Editar</a><br>
                                                <form id="form-delete"
                                                    action="{{ route('promotion-destroy', ['id' => $promocion->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-promotion"
                                                        data-id="{{ $promocion->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i> Eliminar</button>
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
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            //datatable promociones
            table = $('#promotion-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });
            //sweetAlert eliminar promocion
            $('.delete-promotion').click(function(e) {
                e.preventDefault();
                var form = document.getElementById('form-delete');
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
                        form.submit();
                    }
                });
            });
            //sweetAlert editar promocion
            $('.edit-promotion').click(function(e) {
                e.preventDefault();
                var a = document.getElementById('a-edit-promotion');
                var id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, editar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/admin/promociones/edit/' + id;
                    }
                });
            });
        });

        $('#searchBar').keyup(function() {
            table.search($(this).val()).draw();
        })
    </script>
@endsection
