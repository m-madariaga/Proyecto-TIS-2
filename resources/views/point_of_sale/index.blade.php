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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <style>
        .ctn-btn-d {
            background-color: none;
            width: 5.5rem;
            height: 1.8rem;
            display: inline-block;
            border: 1px solid #8c034e;
            border-radius: 3px;
            margin: 0.1rem;
        }

        .ctn-btn {
            background-color: none;
            width: 5.5rem;
            height: 1.8rem;
            display: inline-block;
            border: 1px solid #8c034e;
            border-radius: 3px;
            margin: 0.1rem;
            transition: background-color 0.4s ease;
            color: black;
        }

        .ctn-btn:hover {
            background-color: #8c034e;
            color: white;
        }

        .ctn-page {
            width: 3rem;
            height: 1.8rem;
            display: inline-block;
            border: 1px solid #8c034e;
            border-radius: 3px;
            margin: 0.1rem;
            transition: background-color 0.4s ease;
            color: black;
        }

        .ctn-page:hover {
            background-color: #8c034e;
            color: white;
        }

        .pag_active {
            background-color: #8c034e;
            color: white;
        }

        .li-cart {
            list-style: none;
            text-align: end;
            padding-right: 4rem;
        }

        .cart-button {
            display: inline-block;
            position: relative;
            color: #8c034e;
            background-color: rgb(255, 255, 255);
            border: 1px solid #8c034e;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .cart-button:hover {
            color: white;
            background-color: #8c034e;
        }

        .cart-count {
            position: absolute;
            top: -18px;
            right: -10px;
            background-color: white;
            border: 1px solid #8c034e;
            color: #8c034e;
            font-size: 18px;
            font-weight: bolder;
            padding: 2px 6px;
            border-radius: 40%;
        }

        .td-cantidad a {
            border: 1px solid #8c034e;
            margin: 1rem;
            padding: 0rem 0.6rem 0rem 0.6rem;
            border-radius: 8px;
            transition: background-color 0.4s ease;
            color: black;
        }

        .td-cantidad a:hover {
            background-color: #8c034e;
            border: 1px solid white;
            color: white;
        }
    </style>
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
                        <li class="li-cart">
                            <a class="cart-button" type="button" data-bs-toggle="modal" data-bs-target="#modal-showCart">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="" class="cart-count">{{ Cart::instance('admin')->count() }}</span> Ver
                                Carrito
                            </a>
                        </li>
                    </div>
                    <div class="card-body d-flex flex-wrap justify-content-center text-center ">
                        @foreach ($productos as $producto)
                            <a href="{{ route('point_of_sale-addProduct', ['id' => $producto->id]) }}" class="">
                                <div class="card m-3" style="width: 9rem;">
                                    <img src="/assets/images/images-products/{{ $producto->imagen }}" class="card-img-top"
                                        height="200">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre }} {{ $producto->color }}</h5>
                                        <p class="card-text">
                                            {{ $producto->marca->nombre }}<br>${{ $producto->precio }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center ">
                            {{-- Botón "Anterior" --}}
                            @if ($productos->onFirstPage())
                                <li class="ctn-btn-d disabled text-center">
                                    <span>Anterior</span>
                                </li>
                            @else
                                <li class="text-center">
                                    <a class="ctn-btn" href="{{ $productos->previousPageUrl() }}" rel="prev">
                                        <div>Anterior</div>
                                    </a>
                                </li>
                            @endif

                            {{-- Números de página --}}
                            @foreach ($productos->getUrlRange(1, $productos->lastPage()) as $page => $url)
                                <li class="text-center">
                                    <a class="ctn-page {{ $page == $productos->currentPage() ? 'pag_active' : '' }}"
                                        href="{{ $url }}">
                                        <div class="">{{ $page }}</div>
                                    </a>
                                </li>
                            @endforeach

                            {{-- Botón "Siguiente" --}}
                            @if ($productos->hasMorePages())
                                <li class="text-center">
                                    <a class="ctn-btn" href="{{ $productos->nextPageUrl() }}" rel="next">
                                        <div>Siguiente</div>
                                    </a>
                                </li>
                            @else
                                <li class="ctn-btn-d disabled text-center">
                                    <span class="">Siguiente</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    <a href="{{ route('point_of_sale-createOrder') }}" type="button"
                        class="btn btn-primary btn-lg btn-continuar-order" id="btn-continuar-order"
                        style="width:100%;">Continuar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Large modal -->
    <div class="modal fade" id="modal-showCart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="header">
                    <h3>Contenido del carrito</h3>
                </div>
                <div class="products">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::instance('admin')->content() as $cartProduct)
                                <tr>
                                    <td class="align-middle">
                                        {{ $cartProduct->name }}
                                    </td>
                                    <td class="align-middle text-center fs-4 td-cantidad">
                                        <a
                                            href="{{ route('point_of_sale-disminuyeCantidad', ['id' => $cartProduct->id]) }}">
                                            - </a>
                                        <span>{{ $cartProduct->qty }}</span>
                                        <a href="{{ route('point_of_sale-addProduct', ['id' => $cartProduct->id]) }}"> +
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        ${{ $cartProduct->price }}
                                    </td>
                                    <td class="align-middle">$ {{ $cartProduct->price * $cartProduct->qty }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('point_of_sale-dropProduct', ['id' => $cartProduct->id]) }}"
                                            class="btn btn-danger bg-transparent" type="button">
                                            <i class="far fa-times-circle fa-2x" style="color: #8c034e"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin large modal-->
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
                text: '{{ session('error') }}',
            });
        </script>
    @endif
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
    <script>
        $(document).on('click', '.btn-continuar-order', function(e) {
            e.preventDefault();
            var btn = document.getElementById('btn-continuar-order');
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
                    setTimeout(() => {
                        window.location.href = btn.getAttribute('href');
                    }, 1000);
                }
            })
        });
    </script>
@endsection
