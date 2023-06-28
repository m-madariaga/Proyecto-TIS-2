@extends('layouts.argon.app')

@section('title')
{{ 'Marcas' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Marcas</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Marcas</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Editar Marcas</h6>
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Editar Marcas</h3>
        </div>
        <div class="card-body">
        
          <form action="{{ route('marcas-update', $marca->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label class="form-control-label" for="nombre">Nombre</label>
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $marca->nombre }}" >
            @error('nombre')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="descripcion">Logo</label>
            <div class="form-group row mb-3">
                  <img src="/imagen/{{ $marca->logo}}" id="imagenSeleccionada" style="max-height: 300px;">
                </div>
                  <!-- input img -->
                <div class="form-group row mb-3">
                  <input name="logo" id="logo" type="file">
                </div>
            </div>                        
            <div class="form-group">
            <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('marcas')}}">{{ __('Cancelar') }}</a>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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