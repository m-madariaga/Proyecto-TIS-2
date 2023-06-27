@extends('layouts.argon.app')

@section('title')
{{ 'Preguntas' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
  <li class="breadcrumb-item text-sm text-white active" aria-current="page">Agregar Pregunta</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Agregar Pregunta</h6>
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid mt--6 w-50">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Agregar Pregunta Frecuente</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('preguntas-store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
              <label class="form-control-label" for="pregunta">Pregunta</label>
              <input type="text" class="form-control @error('pregunta') is-invalid @enderror" id="pregunta" name="pregunta" value="{{ old('pregunta') }}" required autocomplete='pregunta' autofocus>
              @error('pregunta')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('preguntas')}}">{{ __('Cancelar') }}</a>
              <button type="submit" class="btn btn-primary">Agregar</button>
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