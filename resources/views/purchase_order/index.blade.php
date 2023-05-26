@extends('layouts.argon.app')

@section('title')
    {{ 'Ordenes de Compra' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ordenes de Compra</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Ordenes de Compra</h6>
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
                        <h6>Tabla de ordenes de compra</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <a href="{{route('users.generate_pdf')}}" hidden>Descargar pdf</a>
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Productos</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenes as $orden)
                                        <tr>
                                            <td class="text-center">{{ $orden->id }}</td>
                                            @foreach ($orden->product as $prod)
                                            <td class="text-center">{{ $prod->nombre }}<br></td>
                                            @endforeach               
                                            <td class="text-center">{{ $orden->product }}</td>                        <td class="text-center pt-3">
                                                <a href="{{ route('orden-compra-edit', $orden->id) }}" class="btn btn-sm btn-outline-primary"><i
                                                        class="fa fa-edit"></i></a>
                                                <form action="{{ route('orden-compra-destroy', $orden->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-user"
                                                        data-id="{{ $orden->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

    <script>
        $(document).ready(function() {
            table = $('#users-table').DataTable({
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
@endsection
