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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .disabled-pdf {
            color: gray;
            pointer-events: none;
            text-decoration: none;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">producto más deseado</p>
                                    <h5 class="font-weight-bolder mt-1">
                                        {{ $product->nombre }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">{{ $count }}</span>
                                        veces
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center w-2">RUN</th>
                                        <th class="text-center w-3">Nombre</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->run }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            @if ($user->product_desired->isNotEmpty())
                                                <td class="text-center">
                                                    <table class="table display table-stripped aling-items-left">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-center">Nombre</th>
                                                                <th scope="col" class="text-center">Marca</th>
                                                                <th scope="col" class="text-center">Stock</th>
                                                                <th scope="col" class="text-center">Precio</th>
                                                            </tr>
                                                        </thead>
                                                        @foreach ($user->product_desired as $prod)
                                                            <tbody>
                                                                <tr>
                                                                    <td scope="row">{{ $prod->product->nombre }}
                                                                    </td>
                                                                    <td>{{ $prod->product->marca->nombre }}</td>
                                                                    <td>{{ $prod->product->stock }}</td>
                                                                    <td>${{ $prod->product->precio }}</td>
                                                                </tr>
                                                            </tbody>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <h4> Este usuario no tiene productos deseados</h4>
                                                </td>
                                            @endif
                                            <td class="text-center pt-3">
                                                <a href="{{ route('product_desired_pdf', ['id' => $user->id]) }}"
                                                    class="btn btn-sm btn-outline-primary {{ $user->product_desired->isNotEmpty() === true ? '' : 'disabled-pdf' }}">
                                                    Descargar PDF</a>
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
