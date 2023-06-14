@extends('layouts.argon.app')

@section('title')
    {{ 'Editar Rol' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Roles</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Editar Credencial</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Modifique los datos de la credencial a editar</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form action="{{ route('webpaycredentials.update', $webpayCredential->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row mb-3">
                                <label for="commerce_code" class="col-md-4 col-form-label text-md-right">Código de Comercio</label>
                                <div class="col-md-6">
                                    <input type="text" id="commerce_code" name="commerce_code" class="form-control" value="{{ $webpayCredential->commerce_code }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="api_key" class="col-md-4 col-form-label text-md-right">Clave de API</label>
                                <div class="col-md-6">
                                    <input type="text" id="api_key" name="api_key" class="form-control" value="{{ $webpayCredential->api_key }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="integration_type" class="col-md-4 col-form-label text-md-right">Tipo de Integración</label>
                                <div class="col-md-6">
                                    <select id="integration_type" class="form-select @error('integration_type') is-invalid @enderror" name="integration_type" required>
                                        <option value="webpay_plus" {{ $webpayCredential->integration_type === 'webpay_plus' ? 'selected' : '' }}>Webpay Plus</option>
                                        <option value="oneclick_mall" {{ $webpayCredential->integration_type === 'oneclick_mall' ? 'selected' : '' }}>Oneclick Mall</option>
                                        <option value="transaccion_completa" {{ $webpayCredential->integration_type === 'transaccion_completa' ? 'selected' : '' }}>Transacción Completa</option>
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
                                        <option value="integration" {{ $webpayCredential->environment === 'integration' ? 'selected' : '' }}>Integración</option>
                                        <option value="certification" {{ $webpayCredential->environment === 'certification' ? 'selected' : '' }}>Certificación</option>
                                        <option value="production" {{ $webpayCredential->environment === 'production' ? 'selected' : '' }}>Producción</option>
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
                                    <select id="user_id" class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $webpayCredential->user_id === $user->id ? 'selected' : '' }}>
                                                {{ $user->run }} - {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                            
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        Guardar cambios
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
