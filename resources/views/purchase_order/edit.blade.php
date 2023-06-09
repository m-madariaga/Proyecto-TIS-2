@extends('layouts.argon.app')

@section('title')
    {{ 'Orden' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar Orden</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Editar Orden</h6>
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
                        <h6>Editar orden de compra</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <button class="btn btn-sm btn-outline-success ms-4" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            Agregar más productos a la orden
                        </button>
                        <div class="table-responsive p-0 ">
                            <form action="{{ route('orden-compra-product-update', ['id' => $orden->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <table id="users-table" class="table display table-stripped align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Productos</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center">{{ $orden->id }}</td>
                                            <td class="text-center">
                                                <table
                                                    class="table display table-stripped aling-items-center justify-content-center">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Marca</th>
                                                            <th scope="col">Unidades</th>
                                                            <th scope="col">Valor de compra</th>
                                                            <th scope="col">Accion</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($orden_productos as $prod)
                                                        <tbody>
                                                            <tr class="">
                                                                <td>
                                                                    <input type="number" name="prod_id_edit[]"
                                                                        id="prod_id_edit" value="{{ $prod->id }}"
                                                                        class='form-control' hidden>
                                                                    {{ $prod->product->nombre }}
                                                                </td>
                                                                <td class="text-center aling-items-center">
                                                                    {{ $prod->product->marca->nombre }}</td>
                                                                <td class="">
                                                                    <div
                                                                        class="d-flex form-group text-center aling-items-center justify-content-center">
                                                                        <input type="number" class="form-control w-20"
                                                                            id="cantidad_edit" name="cantidad_edit[]"
                                                                            value="{{ $prod->cantidad }}">
                                                                    </div>
                                                                </td>
                                                                <td class="">
                                                                    <div
                                                                        class="form-group d-flex aling-items-center justify-content-center">
                                                                        <input type="number" class="form-control w-40"
                                                                            id="valor_edit" name="valor_edit[]"
                                                                            value="{{ $prod->precio }}">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center aling-items-center">
                                                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                                                        href="{{ route('orden-compra-product-destroy', $prod->id) }}"><i
                                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                                        Eliminar</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">{{ $orden->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group text-center m-4">
                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                        href="{{ route('orden-compra') }}">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-xl" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Nuevos productos a agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_addprods" action="{{ route('orden-compra-product-store') }}" method="POST">
                    @csrf
                    <input type='number' name="orden_id" id="orden_id" value='{{ $orden->id }}' hidden>
                    <div class="table-responsive p-0 mt-2">
                        <table id="table" class="table display table-stripped align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Talla</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Valor</th>

                                </tr>
                            </thead>
                            @if (isset($empty))
                            @else
                                <tbody>

                                    @foreach ($productosall as $prod)
                                        <tr>
                                            <td class="text-center pt-3 w-2">
                                                <input type="checkbox" id="prod_id{{ $prod->id }}" name="prod_id[]"
                                                    value="{{ $prod->id }}"
                                                    class="@error('prod_id{{ $prod->id }}') is-invalid @enderror">
                                                @error('prod_id{{ $prod->id }}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td class="text-center w-6">{{ $prod->nombre }}</td>
                                            <td class="text-center pt-3 w-6">{{ $prod->marca->nombre }}
                                            </td>
                                            <td class="text-center pt-3 w-6">{{ $prod->color }}
                                            </td>
                                            <td class="text-center pt-3 w-6">{{ $prod->talla }}
                                            </td>
                                            <td class="text-center pt-3 w-1">
                                                <div class="form-group">
                                                    <input type="number"
                                                        class="form-control @error('cantidad') is-invalid @enderror"
                                                        id="cantidad{{ $prod->id }}" name="cantidad[]"
                                                        value="{{ old('cantidad') }}">
                                                    @error('cantidad')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="text-center pt-3 w-3">
                                                <div class="form-group">
                                                    <input type="number"
                                                        class="form-control @error('valor') is-invalid @enderror"
                                                        id="valor{{ $prod->id }}" name="valor[]"
                                                        value="{{ old('valor') }}">
                                                    @error('valor')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="form-group text-center m-4">
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar productos</button>
                    </div>
                </form>
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
    <script>
        var Form = document.getElementById('form_addprods');
        Form.addEventListener('submit', function(event) {
            event.preventDefault();
            var inputs = Form.querySelectorAll('input');
            var checkboxs = [];
            inputs.forEach(function(input) {
                if (input.type === 'checkbox') {
                    checkboxs.push(input);
                }
            });
            $('.invalid-feedback').html('')
            var contador=0;
            checkboxs.forEach(function(checkbox) {
                $('.invalid-feedback').html('');
                //recorre los checkbox marcados
                if (checkbox.checked) {
                    contador++;
                    // busca la cantidad y el valor del producto
                    var id_valor = 'valor' + checkbox.value;
                    var id_cantidad = 'cantidad' + checkbox.value;
                    var input_cantidad = document.getElementById(id_cantidad);
                    var input_valor = document.getElementById(id_valor);
                    if (input_cantidad.value !== '' && input_cantidad.value > 0) {
                        //el campo cantidad ingresado es valido
                        input_cantidad.style.borderColor = '';
                        if (input_valor.value !== '' && input_valor.value > 0) {
                            //el campo valor ingresado es valido
                            input_valor.style.borderColor = '';
                            Form.submit();
                        } else {
                            //el campo valor no ha sido ingresado o no es valido
                            input_valor.required = true;
                            input_valor.style.borderColor = 'red';
                        }
                    } else {
                        //el campo cantidad no ha sido ingresado o no es valido
                        input_cantidad.required = true;
                        input_cantidad.style.borderColor = 'red';
                    }
                }
                if (contador===0) {
                    var errorField = $('#prod_id' + checkbox.value);
                    var errorLabel = $('<span>').addClass('error-message text-danger is-invalid').text(
                        'Seleccione un producto');
                    errorField.addClass('is-invalid');
                    errorField.siblings('.invalid-feedback').html('');
                    errorField.after(errorLabel);
                    $('.invalid-feedback').html('')
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'lfrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });

        });
    </script>
@endsection
