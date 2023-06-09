@extends('layouts.argon.app')

@section('title')
    {{ 'Productos' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Productos</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Productos</h6>
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
                        <h6>Tabla de Productos</h6>
                        <div class="card-body px-0 pt-0 pb-2">
                            <a href="{{ route('productos-create') }}"
                                class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                            <div class="table-responsive p-0">
                                <table id="products-table" class="table display table-stripped align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Categoría</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Talla</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center w-10">Imagen</th>


                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $prod)
                                            <tr>
                                                <td class="text-center">{{ $prod->id }}</td>
                                                <td class="text-center">{{ $prod->nombre }}</td>
                                                <td class="text-center">{{ $prod->marca->nombre }}</td>
                                                <td class="text-center">{{ $prod->categoria->nombre }}</td>
                                                <td class="text-center">{{ $prod->color }}</td>
                                                <td class="text-center">{{ $prod->talla }}</td>
                                                <td class="text-center">{{ $prod->stock }}</td>
                                                <td class="text-center">${{ $prod->precio }}</td>
                                                <td class="text-center">
                                                    <div class="container d-flex justify-content-center">
                                                        <img src="/assets/images/images-products/{{ $prod->imagen }}" width="100%">
                                                    </div>
                                                </td>

                                                <td class="text-center pt-3">
                                                    <a href="{{ route('productos-edit', ['id' => $prod->id]) }}"
                                                        class="btn btn-sm btn-outline-primary edit-product" data-id="{{$prod->id}}"><i class="fa fa-edit"></i>
                                                        Editar</a>
                                                    <form action="{{ route('productos-destroy', ['id' => $prod->id]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger delete-product"
                                                            data-id="{{ $prod->id }}"><i class="fa fa-trash"
                                                                aria-hidden="true"> Borrar</i></button>
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
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            table = $('#products-table').DataTable({
                dom: 'lrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
            //sweetAlert editar producto
            $('.edit-product').click(function(e) {
                e.preventDefault();
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
                        window.location.href = '/admin/productos/'+ id +'/edit';
                    }
                });
            });
        });

        $('#searchBar').keyup(function() {
            table.search($(this).val()).draw();
        })
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-product', function(e) {
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
                        url: '/admin/productos/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Producto eliminado correctamente!',
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
@endsection
