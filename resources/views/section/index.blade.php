@extends('layouts.argon.app')

@section('title', 'Section Landing')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Vista Cliente</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Vista Cliente</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 px-2 py-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="float-start">Modificaciones en la Vista Cliente</h5>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="float-start">Configuración de Contacto</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Red Social</th>
                                                        <th>Valor</th>
                                                        <th>Visible</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Telefono de contacto</td>
                                                        <td>
                                                            <input type="text" class="form-control" id="telefono"
                                                                name="telefono">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="visible_telefono"
                                                                name="visible_telefono">
                                                                <option value="1">Mostrar</option>
                                                                <option value="0">No mostrar</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Facebook</td>
                                                        <td>
                                                            <input type="text" class="form-control" id="facebook"
                                                                name="facebook">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="visible_facebook"
                                                                name="visible_facebook">
                                                                <option value="1">Mostrar</option>
                                                                <option value="0">No mostrar</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Twitter</td>
                                                        <td>
                                                            <input type="text" class="form-control" id="twitter"
                                                                name="twitter">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="visible_twitter"
                                                                name="visible_twitter">
                                                                <option value="1">Mostrar</option>
                                                                <option value="0">No mostrar</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Instagram</td>
                                                        <td>
                                                            <input type="text" class="form-control" id="instagram"
                                                                name="instagram">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="visible_instagram"
                                                                name="visible_instagram">
                                                                <option value="1">Mostrar</option>
                                                                <option value="0">No mostrar</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telegram</td>
                                                        <td>
                                                            <input type="text" class="form-control" id="telegram"
                                                                name="telegram">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="visible_telegram"
                                                                name="visible_telegram">
                                                                <option value="1">Mostrar</option>
                                                                <option value="0">No mostrar</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card mt-2">

                    <div class="card-body">
                        <div class="table-responsive">
                            <h6 class="float-start">Secciones Cliente</h6>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        @foreach ($secciones as $seccion)
                                            <th class="text-center">{{ $seccion->nombre }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="sectionForm" action="{{ route('section.update') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <tr>
                                            @foreach ($secciones as $seccion)
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <select class="form-select" id="visible_{{ $seccion->id }}"
                                                            name="visible[]">
                                                            <option value="1"
                                                                {{ $seccion->visible == 1 ? 'selected' : '' }}>
                                                                Mostrar</option>
                                                            <option value="0"
                                                                {{ $seccion->visible == 0 ? 'selected' : '' }}>
                                                                No mostrar</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="{{ count($secciones) }}">
                                                <button type="submit" class="btn btn-primary"
                                                    id="guardarBtn">Guardar</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="card mt-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="float-start">Imagen del Logo</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Aquí puedes agregar tu código para cargar la imagen -->
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="float-start">Imagen del Logo</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Aquí puedes agregar tu código para cargar la imagen -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@endsection
