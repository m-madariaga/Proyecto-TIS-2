@extends('layouts.argon.app')

@section('title')
    {{ 'Ordenes de Compra' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
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
                        <h4>Nueva promoción</h4><br>
                        <div class="table-responsive p-0">
                            <form id='formulario_general' action="{{ route('promotion-store') }}" method="POST">
                                @csrf
                                <table id="users-table" class="table display table-stripped align-items-center">
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
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" id="prod_id{{ $producto->id }}" name="prod_id[]"
                                                        value="{{ $producto->id }}"
                                                        class="@error('prod_id') is-invalid @enderror">
                                                    @error('prod_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td>
                                                <td class="text-center">
                                                    {{ $producto->nombre }}
                                                </td>
                                                <td class="text-center">{{ $producto->marca->nombre }}</td>
                                                <td class="text-center">${{ $producto->precio }}</td>
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control @error('descuento') is-invalid  @enderror"
                                                            id="descuento{{ $producto->id }}" name="descuento[]"
                                                            value="{{ old('descuento[]') }}" placeholder="Se restará al precio del producto" min="0" max="{{$producto->precio}}">
                                                        @error('descuento')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group text-center m-4">
                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                        href="{{ route('promotion') }}">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-primary">Agregar promoción</button>
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
        $(document).on('click', '.delete-order', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/orden-compra/' + id + '/destroy',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Orden eliminada correctamente!',
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // delay for half a second
                        },
                        error: function(xhr, status, error) {

                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

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
    <script>
        var Form = document.getElementById('formulario_general');
        Form.addEventListener('submit', function(event) {
            var inputs = Form.querySelectorAll('input');
            inputs.forEach(function(input) {
                //recorrer los checkbox marcados
                if (input.type == 'checkbox' && input.checked) {
                    event.preventDefault();
                    // cantidad y valor del checkbox correspondiente
                    var id_descuento = 'descuento' + input.value;
                    var input_descuento = document.getElementById(id_descuento);
                    //validaciones
                    if (input_descuento.value !== '' && input_descuento.value > 0) {
                        //el campo descuento ingresado es valido
                        input_descuento.style.borderColor = '';
                        Form.submit();
                    } else {
                        //el campo descuento no ha sido ingresado o no es valido
                        input_descuento.required = true;
                        input_descuento.style.borderColor = 'red';
                    }
                }
            });
        });
    </script>
@endsection
