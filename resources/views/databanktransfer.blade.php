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
@endsection 
