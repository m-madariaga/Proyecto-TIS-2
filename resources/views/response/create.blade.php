@extends('layouts.argon.app')

@section('title')
{{ 'Respuestas' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
  <li class="breadcrumb-item text-sm text-white active" aria-current="page">Agregar Respuesta</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Agregar Respuesta</h6>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
<div class="container-fluid mt--6 w-50">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Agregar Respuesta de pregunta frecuente</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('respuestas-store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
              <label for="pregunta">Pregunta</label>
              <select class="form-select" id="pregunta" name="frequent_question_id">
                @foreach($frequent_questions as $frequent_question)
                <option value="{{ $frequent_question->id }}">{{ $frequent_question->pregunta }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="respuesta">Respuesta</label>
              <input type="text" class="form-control @error('respuesta') is-invalid @enderror" id="respuesta" name="respuesta" value="{{ old('respuesta') }}" required autocomplete="off" autofocus>
              @error('respuesta')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('respuestas') }}">{{ __('Cancelar') }}</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
  $(document).ready(function() {
    $('#questions-table').DataTable();
  });
</script>
@endsection