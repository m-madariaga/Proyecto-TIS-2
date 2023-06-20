@extends('layouts.argon.app')

@section('title')
    {{ 'Productos deseados' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Productos deseados</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Productos deseados</h6>
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
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <a class="btn btn-sm btn-outline-success ms-4" href="{{ route('orden-compra-create') }}">Agregar
                            orden</a>
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id user</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Fecha de compra</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos_deseados as $producto)
                                        <tr>
                                            <td class="text-center">{{ $producto->user->id }}</td>
                                            <td class="text-center">
                                                <table class="table display table-stripped aling-items-left">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Marca</th>
                                                            <th scope="col">Stock</th>
                                                            <th scope="col">Precio</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($producto->product as $prod)
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">{{ $prod->nombre }}
                                                                </td>
                                                                <td>{{ $prod->product->marca->nombre }}</td>
                                                                <td>{{ $prod->product->stock }}</td>
                                                                <td>{{ $prod->product->precio }}</td>
                                                            </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>


                                            </td>
                                            <td class="text-center">{{ $orden->total }}</td>
                                            <td class="text-center">{{ $orden->created_at }}</td>
                                            <td class="text-center pt-3">
                                                <a href="{{ route('orden-compra-pdf', ['id' => $orden->id]) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Descargar PDF</a><br>
                                                <a href="{{ route('orden-compra-edit', ['id' => $orden->id]) }}"
                                                    class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i>
                                                    Editar</a><br>
                                                <form action="{{ route('orden-compra-destroy', $orden->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-order"
                                                        data-id="{{ $orden->id }}"><i class="fa fa-trash"
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
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });
        });

        $('#searchBar').keyup(function() {
            table.search($(this).val()).draw();
        })
    </script>
@endsection
