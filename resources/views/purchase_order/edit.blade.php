@extends('layouts.argon.app')

@section('title')
{{ 'Orden' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Orden</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Editar Orden</h6>
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
                    <h6>Editar orden de compra</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0 ">
                        <form action="{{ route('orden-compra-product-store') }}" method="POST">
                            @csrf
                            <table id="table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Marca</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Talla</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Valor</th>

                                    </tr>
                                </thead>
                                @if (isset($empty))
                                @else
                                <tbody>

                                    @foreach ($orden->products as $prod)
                                        {{dd($prod)}}
                                    <tr>
                                        <td class="text-center pt-3 w-2">
                                            <input type="checkbox" id="prod_id" name="prod_id[]"
                                                value="">
                                        </td>
                                        <td class="text-center w-6"></td>
                                        <td class="text-center pt-3 w-6">
                                        </td>
                                        <td class="text-center pt-3 w-6">
                                        </td>
                                        <td class="text-center pt-3 w-6">
                                        </td>
                                        <td class="text-center pt-3 w-1">
                                            <div class="form-group">

                                                <input type="number"
                                                    class="form-control @error('cantidad') is-invalid @enderror"
                                                    id="cantidad" name="cantidad[]" value="{{ old('cantidad') }}">

                                                @error('cantidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td class="text-center pt-3 w-3">
                                            <div class="form-group">

                                                <input type="number"
                                                    class="form-control @error('valor') is-invalid @enderror" id="valor"
                                                    name="valor[]" value="{{ old('valor') }}">

                                                @error('valor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                            <div class="form-group text-center m-4">
                                <a type="button" class="btn btn-sm btn-outline-danger"
                                    href="{{ route('orden-compra') }}">{{ __('Cancelar') }}</a>
                                <button type="submit" class="btn btn-primary">Agregar orden</button>
                            </div>
                        </form>
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
<script>
    $(document).ready(function() {
            $('#table').DataTable({
                dom: 'lfrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });
            $('#addModal').modal({
                show: false
            });

            $('#editModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget); // Button que triggerea el modal
                const shipmentTypeId = button.data('shipment-type-id');
                const shipmentTypeName = button.data('shipment-type-name');

                const editForm = $('#editForm');
                const nombreInput = editForm.find('#nombre');

                // Actualizar ID de la ruta
                const actionUrl = editForm.attr('action').replace('__ID__', shipmentTypeId);
                editForm.attr('action', actionUrl);

                // Reemplazar el valor del nombre en el input el modal
                nombreInput.val(shipmentTypeName);
            });

            $('#addForm').submit(function(event) {
                var nombre = $('#nombre').val();

                if (nombre.trim() === '') {
                    event.preventDefault();
                    alert('El campo "Nombre del tipo de envío" es obligatorio.');
                }
            });

        });
</script>
@endsection
