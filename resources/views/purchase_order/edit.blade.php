@extends('layouts.argon.app')

@section('title')
    {{ 'Orden' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
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
                        <a class="btn btn-sm btn-outline-success ms-4"
                            href="{{ route('orden-compra-product-add-edit', ['id' => $orden->id]) }}">
                            Agregar más productos a la orden
                        </a>
                        <div class="table-responsive p-0 ">
                            <form id="form-edit" action="{{ route('orden-compra-product-update', ['id' => $orden->id]) }}"
                                method="POST">
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
                                                                            value="{{ $prod->cantidad }}" min="1">
                                                                    </div>
                                                                </td>
                                                                <td class="">
                                                                    <div
                                                                        class="form-group d-flex aling-items-center justify-content-center">
                                                                        <input type="number" class="form-control w-40"
                                                                            id="valor_edit{{ $prod->id }}"
                                                                            name="valor_edit[]" value="{{ $prod->precio }}"
                                                                            min="1">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center aling-items-center">
                                                                    <a type="button"
                                                                        class="btn btn-sm btn-outline-danger delete-product"
                                                                        data-id="{{ $prod->id }}"
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
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var form = document.getElementById('form-edit');
        form.addEventListener('submit', function(event) {
            var inputs = form.querySelectorAll('input');
            event.preventDefault();
            //recorrer los inputs
            var contador = 0;
            inputs.forEach(function(input) {
                //pregunta si el input no es el id del producto
                if (input.hidden == false) {
                    // cada valor debe ser mayor a 0
                    if (parseInt(input.value) > 0) {
                        input.style.borderColor = '';
                    }
                    //se verifica que no se esten comparando valores nulos
                    elseif(parseInt(input.value) != NaN) {
                        input.required = true;
                        input.style.borderColor = 'red';
                        contador++;
                    }
                }
            });
            if (contador === 0) {
                form.submit();
            }
        });
    </script>
    <script>
        $(document).on('click', '.delete-product', function(e) {
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
                        type: 'GET',
                        url: '/admin/orden-compra-product/' + id + '/destroy',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Producto eliminado correctamente!',
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
            $('#table').DataTable({
                dom: 'lfrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });

        });
    </script>
@endsection
