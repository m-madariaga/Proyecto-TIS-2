@extends('layouts.argon.app')

@section('title')
    {{ 'Datos Transferencia Bancaria' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Datos Transferencia Bancaria</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Datos</h6>
@endsection

@section('css')
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
                                    <a href="{{ route('databanktransfer.create') }}"
                                        class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="users-table" class="table display table-stripped align-items-center">
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
                                                <button id="editButton"
                                                    class="btn btn-sm btn-outline-primary edit-modal-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal" data-user-id="">
                                                    <i class="fa fa-edit">Editar</i>
                                                </button>
                                                <form
                                                    action="{{ route('databanktransfer.destroy', $databanktransfer->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-user"
                                                        data-id="{{ $databanktransfer->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"> Eliminar</i></button>
                                                </form>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Editar Datos Bancarios</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm" action="">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nombre:</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $databanktransfer->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="run">RUN:</label>
                                                    <input type="text" class="form-control" id="run" name="run"
                                                        value="{{ $databanktransfer->run }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Correo:</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ $databanktransfer->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank">Banco:</label>
                                                    <select id="bank" class="form-select @error('bank') is-invalid @enderror" name="bank" required>
                                                        <option value="">Seleccionar banco</option>
                                                        <option value="Banco de Chile" {{ $databanktransfer->bank == 'Banco de Chile' ? 'selected' : '' }}>Banco de Chile</option>
                                                        <option value="Banco Santander" {{ $databanktransfer->bank == 'Banco Santander' ? 'selected' : '' }}>Banco Santander</option>
                                                        <option value="Banco Estado" {{ $databanktransfer->bank == 'Banco Estado' ? 'selected' : '' }}>Banco Estado</option>
                                       
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="account_type">Tipo Cuenta:</label>
                                                    <select id="account_type" class="form-select @error('account_type') is-invalid @enderror" name="account_type" required>
                                                        <option value="">Seleccionar tipo de cuenta</option>
                                                        <option value="Cuenta Corriente" {{ $databanktransfer->account_type == 'Cuenta Corriente' ? 'selected' : '' }}>Cuenta Corriente</option>
                                                        <option value="Cuenta de Ahorro" {{ $databanktransfer->account_type == 'Cuenta de Ahorro' ? 'selected' : '' }}>Cuenta de Ahorro</option>
                                                        <option value="Cuenta Vista" {{ $databanktransfer->account_type == 'Cuenta Vista' ? 'selected' : '' }}>Cuenta Vista</option>
                                                        <!-- Agrega más opciones de tipos de cuenta aquí -->
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="account_number">N° Cuenta:</label>
                                                    <input type="text" class="form-control" id="account_number"
                                                        name="account_number"
                                                        value="{{ $databanktransfer->account_number }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-success">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
