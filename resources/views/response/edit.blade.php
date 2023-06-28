@extends('layouts.argon.app')

@section('title')
{{ 'Respuestas' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
  <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Respuesta</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Editar Respuestas</h6>
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Editar respuestas</h3>
        </div>
        <div class="card-body">

          <form action="{{route('respuestas-update',$frequent_response->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label class="form-control-label" for="respuesta">Respuesta</label>
              <input type="text" class="form-control @error('respuesta') is-invalid @enderror" id="respuesta" name="respuesta" value="{{ $frequent_response->respuesta }}">
              @error('respuesta')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>


            <div class="form-group">
              <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('respuestas')}}">{{ __('Cancelar') }}</a>
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