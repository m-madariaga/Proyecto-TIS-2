@extends('layouts.argon.app')

@section('title', 'Pedido')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ver Pedido</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Ver Pedido</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Detalle del Pedido</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Talla</th> 
                                        <th class="text-center">Precio Unitario</th>
                                        <th class="text-center">Precio Total</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td class="text-center">{{ $detail->product->nombre }}</td>
                                            <td class="text-center">{{ $detail->cantidad }}</td>
                                            <td class="text-center">{{ $detail->product->color }}</td>
                                            <td class="text-center">{{ $detail->product->talla }}</td>
                                            <td class="text-center">$ {{ $detail->product->precio }}</td>
                                            <td class="text-center">$ {{ $detail->monto }}</td>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        });
    </script>
@endsection
