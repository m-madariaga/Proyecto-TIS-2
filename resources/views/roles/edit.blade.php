@extends('layouts.argon.app')

@section('title')
    {{ ' Editar Rol' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Roles</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0"> Editar Rol</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Modifique los datos del rol a editar</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PATCH')
    
                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-3">
                                <label for="role_type" class="col-md-4 col-form-label text-md-right">Tipo de rol</label>
    
                                <div class="col-md-6">
                                    <select class="form-select" id="role_type" @error('role_type') is-invalid @enderror" name="role_type" onchange="swapPermissionInputs(this)">
                                        <option value="1"
                                        @if($role->role_type==1)
                                            selected='selected'
                                        @endif>Admin</option>
                                        <option value="2"
                                        @if($role->role_type==2)
                                            selected='selected'
                                        @endif>Analista</option>
                                        {{-- <option value="3"
                                        @if($role->role_type==3)
                                            selected='selected'
                                        @endif>Cliente</option> --}}
                                    </select>
                                    @error('role_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="role_type" class="col-md-4 col-form-label text-md-right">Permisos</label>
    
                                <div class="col-md-6" style="overflow-y: auto; max-height: 19rem">

                                    @foreach ($permissions as $permission)
                                        <div class="form-check" id="check1">
                                            <input class="form-check-input" type="checkbox" value="{{$permission}}" name="{{$permission}}" id="{{$permission}}" 
                                            @if($role->permissions->contains($permission))
                                                checked
                                            @endif>
                                            <label class="form-check-label" for="{{$permission}}" id="label1">
                                                {{$permission}}
                                            </label>
                                        </div>
                                        
                                    @endforeach

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