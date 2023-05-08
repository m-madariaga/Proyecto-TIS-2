@extends('layouts.argon.app')

@section('title')
    {{ ' Crear Rol' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Roles</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Create</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0"> Crear Rol</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Ingrese datos del rol a crear</h6>
                    </div>
                    <div class="card-body px-5 pb-2">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
    
                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
    
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
                                        <option value="1">Admin</option>
                                        <option value="2">Analista</option>
                                        <option value="3">Cliente</option>
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
    
                                <div class="col-md-6">
                                    <div class="form-check" id="check1">
                                        <input class="form-check-input" type="checkbox" value="1" name="defaultCheck1" id="defaultCheck1" checked>
                                        <label class="form-check-label" for="defaultCheck1" id="label1">
                                          Dashboard
                                        </label>
                                    </div>

                                    <div class="form-check" id="check2">
                                        <input class="form-check-input" type="checkbox" value="2" name="defaultCheck2" id="defaultCheck2" checked>
                                        <label class="form-check-label" for="defaultCheck2" id="label2">
                                          Mantenedor de usuarios
                                        </label>
                                    </div>

                                    <div class="form-check" id="check3">
                                        <input class="form-check-input" type="checkbox" value="3" name="defaultCheck3" id="defaultCheck3" checked>
                                        <label class="form-check-label" for="defaultCheck3" id="label3">
                                          Mantenedor de roles
                                        </label>
                                    </div>

                                    <div class="form-check" id="check4">
                                        <input class="form-check-input" type="checkbox" value="4" name="defaultCheck4" id="defaultCheck4" checked>
                                        <label class="form-check-label" for="defaultCheck4" id="label4">
                                          Mantenedor de permisos
                                        </label>
                                    </div>
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
    <script>
        function swapPermissionInputs(select){
            // const fecha = urlParams.get('fecha');
            // console.log(fecha);
            if(select.value==1){
                document.getElementById('label1').innerHTML = 'Dashboard';
                document.getElementById('label2').innerHTML = 'Mantenedor usuarios';
                document.getElementById('label3').innerHTML = 'Mantenedor roles';
                document.getElementById('label4').innerHTML = 'Mantenedor permisos';

                document.getElementById('defaultCheck1').disabled = false;
                document.getElementById('defaultCheck2').disabled = false;
                document.getElementById('defaultCheck3').disabled = false;
                document.getElementById('defaultCheck4').disabled = false;

                document.getElementById('check1').style.display = "block";
                document.getElementById('check2').style.display = "block";
                document.getElementById('check3').style.display = "block";
                document.getElementById('check4').style.display = "block";
            }else if(select.value==2){
                document.getElementById('label1').innerHTML = 'Dashboard';

                document.getElementById('defaultCheck1').disabled = false;
                document.getElementById('defaultCheck2').disabled = true;
                document.getElementById('defaultCheck3').disabled = true;
                document.getElementById('defaultCheck4').disabled = true;

                document.getElementById('check1').style.display = "block";
                document.getElementById('check2').style.display = "none";
                document.getElementById('check3').style.display = "none";
                document.getElementById('check4').style.display = "none";
            }else{

                document.getElementById('defaultCheck1').disabled = true;
                document.getElementById('defaultCheck2').disabled = true;
                document.getElementById('defaultCheck3').disabled = true;
                document.getElementById('defaultCheck4').disabled = true;

                document.getElementById('check1').style.display = "none";
                document.getElementById('check2').style.display = "none";
                document.getElementById('check3').style.display = "none";
                document.getElementById('check4').style.display = "none";
            }
        }
    </script>
@endsection