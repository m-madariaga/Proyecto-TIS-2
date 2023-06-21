@extends('layouts.argon.app')

@section('title')
    {{ 'Crear Credenciales WebPay' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">WebPay</li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Crear</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Crear Credenciales</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Ingrese datos de las Credenciales</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form method="POST" action="{{ route('webpaycredentials.store') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="commerce_code" class="col-md-4 col-form-label text-md-right">Código de Comercio</label>

                                <div class="col-md-6">
                                    <input id="commerce_code" type="text" class="form-control @error('commerce_code') is-invalid @enderror" name="commerce_code" required autocomplete="commerce_code">

                                    @error('commerce_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="api_key" class="col-md-4 col-form-label text-md-right">Clave de API</label>

                                <div class="col-md-6">
                                    <textarea id="api_key" class="form-control @error('api_key') is-invalid @enderror" name="api_key" required autocomplete="api_key" rows="3"></textarea>

                                    @error('api_key')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="integration_type" class="col-md-4 col-form-label text-md-right">Tipo de Integración</label>

                                <div class="col-md-6">
                                    <select id="integration_type" class="form-select @error('integration_type') is-invalid @enderror" name="integration_type" required>
                                        <option value="webpay_plus">Webpay Plus</option>
                                        <option value="oneclick_mall">Oneclick Mall</option>
                                        <option value="transaccion_completa">Transacción Completa</option>
                                    </select>

                                    @error('integration_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="environment" class="col-md-4 col-form-label text-md-right">Entorno</label>

                                <div class="col-md-6">
                                    <select id="environment" class="form-select @error('environment') is-invalid @enderror" name="environment" required>
                                        <option value="integration">Integración</option>
                                        <option value="certification">Certificación</option>
                                        <option value="production">Producción</option>
                                    </select>

                                    @error('environment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">Usuario</label>
                            
                                <div class="col-md-6">
                                    <input id="user_id" type="text" class="form-control" value="{{ $userName }}" disabled>
                            
                                    <input type="hidden" name="user_id" value="{{ $userId }}">
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
