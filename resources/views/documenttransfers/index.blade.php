@extends('layouts.argon.app')

@section('title')
{{ 'Comprobantes Transferencias' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Comprobantes</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Comprobantes Transferencia Bancarias</h6>
@endsection

@section('css')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<style>
    .ctn-btn-d {
        background-color: none;
        width: 5.5rem;
        height: 1.8rem;
        display: inline-block;
        border: 1px solid #8c034e;
        border-radius: 3px;
        margin: 0.1rem;
    }

    .ctn-btn {
        background-color: none;
        width: 5.5rem;
        height: 1.8rem;
        display: inline-block;
        border: 1px solid #8c034e;
        border-radius: 3px;
        margin: 0.1rem;
        transition: background-color 0.4s ease;
        color: black;
    }

    .ctn-btn:hover {
        background-color: #8c034e;
        color: white;
    }

    .ctn-page {
        width: 3rem;
        height: 1.8rem;
        display: inline-block;
        border: 1px solid #8c034e;
        border-radius: 3px;
        margin: 0.1rem;
        transition: background-color 0.4s ease;
        color: black;
    }

    .ctn-page:hover {
        background-color: #8c034e;
        color: white;
    }

    .pag_active {
        background-color: #8c034e;
        color: white;
    }

    .li-cart {
        list-style: none;
        text-align: end;
        padding-right: 4rem;
    }

    .cart-button {
        display: inline-block;
        position: relative;
        color: #8c034e;
        background-color: rgb(255, 255, 255);
        border: 1px solid #8c034e;
        padding: 10px 10px;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .cart-button:hover {
        color: white;
        background-color: #8c034e;
    }

    .cart-count {
        position: absolute;
        top: -18px;
        right: -10px;
        background-color: white;
        border: 1px solid #8c034e;
        color: #8c034e;
        font-size: 18px;
        font-weight: bolder;
        padding: 2px 6px;
        border-radius: 40%;
    }

    .td-cantidad a {
        border: 1px solid #8c034e;
        margin: 1rem;
        padding: 0rem 0.6rem 0rem 0.6rem;
        border-radius: 8px;
        transition: background-color 0.4s ease;
        color: black;
    }

    .td-cantidad a:hover {
        background-color: #8c034e;
        border: 1px solid white;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 ps-3 pe-3 pt-2">
                <div class="card-header">
                    <h4>Tabla Comprobantes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="orders-table" class="table display table-stripped align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">Id</th>
                                    <th class="text-center align-middle">Fecha</th>
                                    <th class="text-center align-middle">Cliente</th>
                                    <th class="text-center align-middle">Pedido</th>
                                    <th class="text-center align-middle">Ver</th>
                                    <th class="text-center align-middle">Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                <tr>
                                    <td class="text-center align-middle">{{ $document->id }}</td>
                                    <td class="text-center align-middle">{{ $document->created_at }}</td>
                                    <td class="text-center align-middle">{{ $document->order->user->name }}</td>
                                    <td class="text-center align-middle">{{ $document->order_id}}</td>
                                    <td class="text-center align-middle">
                                        @if (file_exists(public_path($document->direccion_comprobante)))
                                        <a href="{{ asset($document->direccion_comprobante) }}" target="_blank">Ver documento</a>
                                        @else
                                        Archivo no encontrado
                                        @endif
                                    </td>
                                    <td class="text-center pt-3">
                                        <button class="btn btn-sm btn-outline-primary btnEntregar" data-bs-toggle="modal" data-bs-target="#editDeliver-{{ $document->order_id }}"><i class="fa fa-edit"></i>Confirmar Pedido</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editDeliver-{{ $document->order_id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Confirmar Pedido</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('validartransfer', ['orderId' => $document->order_id]) }}" method="POST">
                                                            @csrf
                                                            <h5>Cliente</h5>
                                                            <div>
                                                                <span>Nombre: {{ $document->order->user->name }}</span>
                                                            </div>
                                                            <!-- Additional form fields can be added here -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary guardar-entrega-btn">Guardar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
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
        table = $('#orders-table').DataTable({
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