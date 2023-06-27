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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                                <button id="editButton" class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal" data-user-id="">
                                                    <i class="fa fa-edit"></i> Editar
                                                </button>
                                                <form action="{{ route('databanktransfer.destroy', $databanktransfer->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-user" data-id="{{ $databanktransfer->id }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar
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
                    title: 'Éxito',
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#databank-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        });

        $('#searchBar').keyup(function() {
            $('#databank-table').search($(this).val()).draw();
        })
    </script>
@endsection
