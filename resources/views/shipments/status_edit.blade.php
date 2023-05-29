@extends('layouts.argon.app')

@section('title')
    {{ ' Editar estado de envío' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Envíos</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar estado</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0"> Editar estado del envío</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Modifique el estado del envío</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form method="POST" action="{{ route('shipments.status_update', $shipment->id) }}">
                            @csrf
                            @method('PATCH')
    
                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Estado</label>
    
                                <div class="col-md-6">
                                    <select class="form-select" id="status" @error('status') is-invalid @enderror" name="status">
                                        <option value="pendiente"
                                        @if($shipment->status=="pendiente")
                                            selected='selected'
                                        @endif>Pendiente</option>
                                        <option value="pagado"
                                        @if($shipment->status=="pagado")
                                            selected='selected'
                                        @endif>Pagado</option>
                                        <option value="enviado"
                                        @if($shipment->status=="enviado")
                                            selected='selected'
                                        @endif>Enviado</option>
                                        <option value="cancelado"
                                        @if($shipment->status=="cancelado")
                                            selected='selected'
                                        @endif>Cancelado</option>
                                    </select>
    
                                    @error('status')
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