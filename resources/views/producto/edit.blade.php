@extends('layouts.argon.app')

@section('title')
{{ 'Productos' }}
@endsection

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Productos</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Editar Productos</h6>
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Editar Producto</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('productos-update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label class="form-control-label" for="nombre">Nombre</label>
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $producto->nombre }}" >
            @error('nombre')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
              <label class="form-control-label" for="marca">Marca</label>
              <select class="form-control @error('marca') is-invalid @enderror" id="marca" name="marca">
                @foreach ( $marcas as $marca)
                    <option value='{{$marca->id}}'>{{$marca->nombre}}</option>
                @endforeach
              </select>
              @error('marca')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
              <label class="form-control-label" for="categoria">Categoria</label>
              <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria">
                @foreach ( $categorias as $categoria)
                    <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                @endforeach
              </select>
              @error('categoria')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="color">Color</label>
              <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ $producto->color }}" >
            @error('color')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="talla">Talla</label>
              <input type="text" class="form-control @error('talla') is-invalid @enderror" id="talla" name="talla" value="{{ $producto->talla }}" >
            @error('talla')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="stock">Stock</label>
              <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $producto->stock }}" >
            @error('stock')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="precio">Precio</label>
              <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ $producto->precio }}" >
            @error('precio')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
            @enderror
            </div>
            <div class="form-group">
            <label class="form-control-label" for="imagen">Imagen</label>
               <!-- PARA VISUALIZAR LA IMAGEN -->
               <div class="form-group row mb-3">
                            <img src="/imagen/{{ $producto->imagen}}" id="imagenSeleccionada" style="max-height: 300px;">
                        </div>
                        <!-- input img -->
                        <div class="form-group row mb-3">
                            <input name="imagen" id="imagen" type="file">
                        </div>            
            </div>            
            <div class="form-group">
            <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('productos')}}">{{ __('Cancelar') }}</a>
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