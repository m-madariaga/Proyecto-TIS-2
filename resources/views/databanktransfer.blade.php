@extends('layouts.argon.app')

@section('title', 'Datos Transferencia Bancaria')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Datos Transferencia Bancaria</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Datos</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="float-start">Tabla de Datos Bancarios</h6>
                            </div>
                            <div class="col-6">
                                <div class="card-header pb-0 text-end">
                                    <a href="{{ route('databanktransfer.create') }}" class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="databank-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">RUN</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Banco</th>
                                        <th class="text-center">Tipo Cuenta</th>
                                        <th class="text-center">N° Cuenta</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($databanktransfers as $databanktransfer)
                                        <tr>
                                            <td class="text-center">{{ $databanktransfer->id }}</td>
                                            <td class="text-center">{{ $databanktransfer->name }}</td>
                                            <td class="text-center">{{ $databanktransfer->run }}</td>
                                            <td class="text-center">{{ $databanktransfer->email }}</td>
                                            <td class="text-center">{{ $databanktransfer->bank }}</td>
                                            <td class="text-center">{{ $databanktransfer->account_type }}</td>
                                            <td class="text-center">{{ $databanktransfer->account_number }}</td>
                                            <td class="text-center pt-3">
                                                <a href="{{ route('databanktransfer.edit', ['id' => $databanktransfer->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Editar</a>
                                                <form action="{{ route('databanktransfer.destroy', ['id' => $databanktransfer->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-databanktransfer" data-id="{{ $databanktransfer->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#databank-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });

            $('.delete-databanktransfer').click(function(event) {
                event.preventDefault();
                var name = $(this).data('name');
                var form = $(this).closest('form');

                Swal.fire({
                    title: '¿Está seguro?',
                    text: 'Se eliminará el método de pago "' + name + '"',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 3000, // Tiempo en milisegundos (3 segundos)
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endsection
