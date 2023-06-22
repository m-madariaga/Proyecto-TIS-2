@extends('layouts.argon.app')

@section('title')
    {{ 'Punto de venta' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Punto de venta</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Punto de venta</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header">
                        <h6>Confirma pedido existente</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table id="orders-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Nombre cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <form action="{{ route('orders.edit', ['id' => $order->id]) }}" method="POST">
                                            @csrf
                                            <tr>
                                                <td><input type="checkbox" name="estado"></td>
                                                <td>{{$order->id}}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header">
                        <h6>Realiza una nueva venta</h6>
                    </div>
                    <div class="card-body">
                        <a>EL A</a>
                        <button>l button</button>
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
            table = $('#orders-table').DataTable({
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
                    console.log(' kdñsñskd');
                    $.ajax({
                        type: 'DELETE',
                        url: '/admin/productos/' + id,
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
                            console.log(' kdñsñskd');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });


        });
    </script>
@endsection
