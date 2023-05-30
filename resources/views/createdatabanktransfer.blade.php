@extends('layouts.argon.app')

@section('title')
    {{ 'Agregar Cuenta Bancaria' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Datos Transferencia Bancaria</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Agregar Datos</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Agregar Datos</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Formulario</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form method="POST" action="{{ route('databanktransfer.store') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="run" class="col-md-4 col-form-label text-md-right">RUN</label>

                                <div class="col-md-6">
                                    <input id="run" type="text"
                                        class="form-control @error('run') is-invalid @enderror" name="run" required
                                        autocomplete="run">

                                    @error('run')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email" required
                                        autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="bank" class="col-md-4 col-form-label text-md-right">Banco</label>

                                <div class="col-md-6">
                                    <select id="bank" class="form-select @error('bank') is-invalid @enderror"
                                        name="bank" required>
                                        <option value="">Seleccionar banco</option>
                                        <option value="Banco de Chile">Banco de Chile</option>
                                        <option value="Banco Santander">Banco Santander</option>
                                        <option value="Banco Estado">Banco Estado</option>
                                        <!-- Agrega más opciones de bancos aquí -->
                                    </select>

                                    @error('bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="account_type" class="col-md-4 col-form-label text-md-right">Tipo de
                                    cuenta</label>

                                <div class="col-md-6">
                                    <select id="account_type"
                                        class="form-select @error('account_type') is-invalid @enderror" name="account_type"
                                        required>
                                        <option value="">Seleccionar tipo de cuenta</option>
                                        <option value="Cuenta Corriente">Cuenta Corriente</option>
                                        <option value="Cuenta de Ahorro">Cuenta de Ahorro</option>
                                        <option value="Cuenta Vista">Cuenta Vista</option>
                                        <!-- Agrega más opciones de tipos de cuenta aquí -->
                                    </select>

                                    @error('account_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">Número de
                                    cuenta</label>

                                <div class="col-md-6">
                                    <input id="account_number" type="text"
                                        class="form-control @error('account_number') is-invalid @enderror"
                                        name="account_number" required autocomplete="account_number">

                                    @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
@endsection 
