@extends('layouts.argon.app')

@section('title', 'Payment Methods')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Métodos de Pago</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Métodos de Pago</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="float-start">Tabla</h6>
                            </div>
                            <div class="col-6">
                                <div class="card-header pb-0 text-end">
                                    <a href="{{ route('paymethods.create') }}"
                                        class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="payment-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Imagen</th>
                                        <th class="text-center">Visible</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <tr>
                                            <td class="text-center">{{ $paymentMethod->id }}</td>
                                            <td class="text-center">{{ $paymentMethod->name }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('argon/assets/img/images-paymethods/' . $paymentMethod->imagen) }}"
                                                    alt="Imagen del método de pago" class="img-fluid"
                                                    style="max-width: 50px;">
                                            </td>
                                            <td class="text-center">
                                                @if ($paymentMethod->visible == 1)
                                                    Mostrar
                                                @else
                                                    No mostrar
                                                @endif
                                            </td>
                                            <td class="text-center pt-3">
                                                <a href="{{ route('paymethods.edit', $paymentMethod->id) }}"
                                                    class="btn btn-sm btn-outline-primary"><i
                                                        class="fa fa-edit"></i>Editar</a>
                                                <form action="{{ route('paymethods.destroy', $paymentMethod->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-paymethod" data-id="{{ $paymentMethod->id }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: '{{ session('success') }}',
                    timer: 3000
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            table = $('#payment-table').DataTable({
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-paymethod', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(' kdñsñskd');
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
                    console.log(' kdñsñskd');
                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/paymethods/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Dato bancario eliminado correctamente!',
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // delay for half a second
                        },
                        error: function(xhr, status, error) {
                            console.log(' kdñsñskd');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });        
        });
    </script>
@endsection
