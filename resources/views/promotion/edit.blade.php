@extends('layouts.argon.app')

@section('title')
    {{ 'Ordenes de Compra' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Promociones</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Promociones</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <h4>Editar promoción</h4><br>
                        <div class="table-responsive p-1">
                            <form action="{{ route('promotion-update', $promocion->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <table class="table display table-stripped align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Descuento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{$promocion->id}}" name="prod_id">
                                        <tr>
                                            <td class="text-center">{{ $promocion->id }}</td>
                                            <td class="text-center">
                                                {{ $promocion->product->nombre }}
                                            </td>
                                            <td class="text-center">{{ $promocion->product->marca->nombre }}</td>
                                            <td class="text-center">${{ $promocion->product->precio }}</td>
                                            <td class="text-center"><input type="number"
                                                    class="form-control @error('descuento') is-invalid @enderror"
                                                    id="descuento" name="descuento" value="{{ $promocion->descuento }}">
                                                @error('descuento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="form-group pt-1">
                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                        href="{{ route('promotion') }}">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });
        });

        $('#searchBar').keyup(function() {
            table.search($(this).val()).draw();
        })
    </script>
@endsection
