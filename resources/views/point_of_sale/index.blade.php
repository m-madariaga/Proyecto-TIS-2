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
            <div class="col-md-5">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header">
                        <h4>Confirma pedido existente</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table id="orders-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">Id</th>
                                        <th class="text-center align-middle">Fecha</th>
                                        <th class="text-center align-middle">Cliente</th>
                                        <th class="text-center align-middle"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center align-middle">{{ $order->id }}</td>
                                            <td class="text-center align-middle">{{ $order->created_at }}</td>
                                            <td class="text-center align-middle">{{ $order->user->name }}</td>
                                            <td class="text-center align-middle"><a type="button"
                                                    class="btn btn-primary btn-sm pagar_orden"
                                                    href="{{ route('point_of_sale-update', $order->id) }}"
                                                    id='{{ $order->id }}' data-id="{{ $order->id }}">Pagar</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mb-4 ps-3 pe-3 pt-2 ">
                    <div class="card-header">
                        <h4>Registrar una nueva venta</h4>
                    </div>
                    <form action="{{ route('point_of_sale-store') }}" method="POST" class="text-center">
                        @csrf
                        <div class="card-body d-flex flex-wrap justify-content-center text-center ">
                            @foreach ($productos as $producto)
                                <div class="card m-3" style="width: 9rem;">
                                    <img src="/assets/images/images-products/{{ $producto->imagen }}" class="card-img-top"
                                        height="200">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre }} {{ $producto->color }}</h5>
                                        <p class="card-text"> {{ $producto->marca->nombre }}<br>${{ $producto->precio }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {!! $productos->links() !!}


                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%;">Continuar</button>
                    </form>
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
        $(document).on('click', '.pagar_orden', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var btn = document.getElementById(id);

            swal.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, adelante',
                cancelButtonText: 'No, cancela!'
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.fire(
                        'Pagado!',
                        'La orden ha sido completada.',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = btn.getAttribute('href');
                    }, 1000);
                } else {
                    swal.fire(
                        'Cancelado',
                        'El pago no se ha completado',
                        'error'
                    )
                }
            })
        });
    </script>
@endsection
