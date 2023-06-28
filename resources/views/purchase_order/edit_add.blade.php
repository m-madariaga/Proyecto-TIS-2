@extends('layouts.argon.app')

@section('title')
    {{ 'Orden' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Editar orden {{$orden->id}}</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Agregar productos a la orden {{$orden->id}}</h6>
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
                        <h6>Orden numero {{$orden->id}}</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <button class="btn btn-sm btn-outline-success ms-4" data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                            Agregar nuevo producto
                        </button>
                        <div class="table-responsive p-0">
                            <form id='formulario_general' action="{{ route('orden-compra-product-store') }}" method="POST">
                                @csrf
                                <input type="number" name="orden_id" value="{{$orden->id}}" hidden>
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
                                            @foreach ($productos as $prod)
                                                <tr>
                                                    <td class="text-center w-1">
                                                        <input type="checkbox" id="prod_id{{ $prod->id }}"
                                                            name="prod_id[]" value="{{ $prod->id }}"
                                                            class="@error('prod_id') is-invalid @enderror">
                                                        @error('prod_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </td>
                                                    <td class="text-center w-4">{{ $prod->nombre }}</td>
                                                    <td class="text-center w-4">{{ $prod->marca->nombre }}
                                                    </td>
                                                    <td class="text-center w-2">{{ $prod->color }}
                                                    </td>
                                                    <td class="text-center w-2">{{ $prod->talla }}
                                                    </td>
                                                    <td class="text-center w-1">
                                                        <div class="form-group">

                                                            <input type="number"
                                                                class="form-control @error('cantidad') is-invalid  @enderror"
                                                                id="cantidad{{ $prod->id }}" name="cantidad[]"
                                                                value="{{ old('cantidad[]') }}">
                                                            @error('cantidad')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td class="text-center w-2">
                                                        <div class="form-group">

                                                            <input type="number"
                                                                class="form-control @error('valor') is-invalid  @enderror"
                                                                id="valor{{ $prod->id }}" name="valor[]"
                                                                value="{{ old('valor[]') }}">
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
                                <div class="form-group text-center m-4">
                                    <a type="button" class="btn btn-sm btn-outline-danger"
                                        href="{{ route('orden-compra-product-edit',['id' => $orden->id]) }}">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-primary">Agregar orden</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addProductModal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Nuevo producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('productos-store') }}" method="POST" enctype="multipart/form-data"
                    id="addProductForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label" for="nombre">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                name="nombre" value="{{ old('nombre') }}" required autocomplete='nombre' autofocus>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="marca">Marca</label>
                            <select class="form-control @error('marca') is-invalid @enderror" id="marca_id"
                                name="marca_id">
                                @foreach ($marcas as $marca)
                                    <option value='{{ $marca->id }}'>{{ $marca->nombre }}</option>
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
                            <select class="form-control @error('categoria') is-invalid @enderror" id="categoria_id"
                                name="categoria_id">
                                @foreach ($categorias as $categoria)
                                    <option value='{{ $categoria->id }}'>{{ $categoria->nombre }}
                                    </option>
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
                            <input type="text" class="form-control @error('color') is-invalid @enderror"
                                id="color" name="color" value="{{ old('color') }}" required
                                autocomplete="color">
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="talla">Talla</label>
                            <input type="text" class="form-control @error('talla') is-invalid @enderror"
                                id="talla" name="talla" value="{{ old('talla') }}">
                            @error('talla')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="stock">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="precio">Precio</label>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror"
                                id="precio" name="precio" value="{{ old('precio') }}">
                            @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="imagen">Subir imagen</label>
                            <img id="imagenSeleccionada" style="max-height: 300px;">
                            <div class="row mb-3">
                                <input name="imagen" id="imagen" type="file" required>
                                @error('imagen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input name='control-hidden' id="control-hidden" value="0" hidden>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="visible">Hacer visible?</label>
                            <select class="form-control @error('visible') is-invalid @enderror" id="visible"
                                name="visible">
                                <option value='0'>No</option>
                                <option value='1' default>Si</option>
                            </select>
                            @error('visible')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-sm btn-outline-success">Añadir</button>
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
        var Form = document.getElementById('formulario_general');
        Form.addEventListener('submit', function(event) {
            var inputs = Form.querySelectorAll('input');
            inputs.forEach(function(input) {
                //recorrer los checkbox marcados
                if (input.type == 'checkbox' && input.checked) {
                    event.preventDefault();
                    // cantidad y valor del checkbox correspondiente
                    var id_valor = 'valor' + input.value;
                    var id_cantidad = 'cantidad' + input.value;
                    var input_cantidad = document.getElementById(id_cantidad);
                    var input_valor = document.getElementById(id_valor);
                    //validaciones
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
            });
        });
    </script>

    <script>
        // Usar Ajax para manejar el envio del formulario del modal para añadir productos
        var addProductForm = document.getElementById('addProductForm');
        addProductForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene enviar de inmediato el form

            var formData = new FormData(addProductForm);
            var xhr = new XMLHttpRequest();
            //usar xhr para manejar la respuesta del controlador
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // se parsea a json debido a que el controlador entrega un json
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // SE crea el usuario
                            $('#addProductModal').modal('hide'); // se esconde el modal
                            location.reload(); // se recarga al mismo tiempo que se esconde el modal
                        } else {
                            // muestra los errores
                            displayErrors(response.errors);
                        }
                    } else {
                        // Handle AJAX request error
                        console.error('AJAX request error');
                    }
                }
            };

            xhr.open('POST', addProductForm.getAttribute('action'));
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(formData);
        });

        // Funcion que muestra errores de validacion
        function displayErrors(errors) {
            // Limpia errores anteriores
            $('.invalid-feedback').html('');
            // Muestra los errores nuevos
            for (var field in errors) {
                var errorMessages = errors[field];
                var errorField = $('#' + field);
                errorField.addClass('is-invalid');
                errorField.siblings('.invalid-feedback').html(errorMessages.join('<br>'));

                var errorLabel = $('<span>').addClass('error-message text-danger').text(errorMessages.join(', '));
                errorField.after(errorLabel);
            }
        }
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
