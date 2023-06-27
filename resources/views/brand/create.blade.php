@extends('layouts.argon.app')

@section('title')
    {{ 'Marcas' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Agregar Marca</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Agregar Marca</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid mt--6 w-50">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Agregar Marca</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('marcas-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="form-control-label" for="nombre">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete='nombre'
                                    autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="descripcion">Logo</label>
                                <img id="imagenSeleccionada" style="max-height: 300px;">
                                <div class="row mb-3">
                                    <input name="logo" id="logo" type="file" required>
                                    @error('imagenSeleccionada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                        href="{{ route('marcas') }}">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-primary">Agregar Marca</button>
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
