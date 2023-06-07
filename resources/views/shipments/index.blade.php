@extends('layouts.argon.app')

@section('title')
    {{ 'Envíos' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Envíos</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Envíos</h6>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <h6>Tabla de Envíos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        {{-- <a href="" class="btn btn-sm btn-outline-success mb-2">Agregar</a> --}}
                        <div class="table-responsive p-0">
                            <table id="shipments-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Dirección</th>
                                        <th class="text-center">Tipo de envío</th>
                                        <th class="text-center">Estado</th>


                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shipments as $shipment)
                                        <tr>
                                            <td class="text-center">{{ $shipment->id }}</td>
                                            <td class="text-center">{{ $shipment->user->name }}</td>
                                            <td class="text-center">{{ $shipment->address }}</td>
                                            <td class="text-center">{{ $shipment->shipment_type->nombre }}</td>
                                            <td class="text-center">{{ $shipment->status }}</td>

                                            <td class="text-center pt-3">
                                                <button id="productsButton" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#productsModal" data-products-list="{{ json_encode($shipment->products) }}">
                                                    Ver productos
                                                </button>
                                                <button id="statusButton" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal" 
                                                data-shipment-id="{{$shipment->id}}" data-status-list="{{ json_encode($shipment->statuses) }}">
                                                    Ver estado
                                                </button>
                                                <!-- <a href="{{ route('shipments.status_edit', $shipment->id) }}" class="btn btn-sm btn-outline-primary"><i
                                                        class="fa fa-edit"></i> Editar estado</a> -->
                                                <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-shipment"
                                                        data-id="{{ $shipment->id }}"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productsModalLabel">Productos</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center" id="productsList"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productsModalLabel">Estado del envío</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center" id="statusList"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cancelar envío</button>
                                            <a id='editStatus' href="{{ route('shipments.status_edit', ['id' => '5']) }}" class="btn btn-sm btn-outline-primary"><i
                                                        class="fa fa-edit"></i> Avanzar estado</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            table = $('#shipments-table').DataTable({
                dom: 'lrtip',

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },


            });
        });

        $('#searchBar').keyup(function(){
            table.search($(this).val()).draw() ;
        })
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-shipment', function(e) {
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
                        url: '/admin/shipments/' + id,
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito',
                                text: '¡Envío eliminado correctamente!',
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

         $('#productsModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget); // Button que triggerea el modal
                const products = button.data('products-list');

                console.log("products");

                console.log(products);
                var p = document.getElementById("productsList");
                p.setAttribute('style', 'white-space: pre;');
                p.textContent = "";
                

                products.forEach(function(entry) {
                    console.log(entry.name);
                    name = entry.name;
                    p.textContent += name + " x" + entry.quantity + "\r\n";
                    console.log(entry.quantity);
                });


                // const editForm = $('#editForm');
                
                // p.innerHTML = products.name.join("<br>") ;
                


                // Actualizar ID de la ruta
                // const actionUrl = editForm.attr('action').replace('__ID__', userId);
                // editForm.attr('action', actionUrl);

                // Reemplazar el valor del nombre en el input el modal

            });

            $('#statusModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget); // Button que triggerea el modal
                const status = button.data('status-list');
                const shipmentId= button.data('shipment-id');

                console.log("statuses");

                console.log(status);
                console.log(shipmentId);
                var p = document.getElementById("statusList");
                p.setAttribute('style', 'white-space: pre;');
                p.textContent = "";

                var index= 1;

                status.forEach(function(entry) {
                    console.log(entry.nombre_estado);
                    name = entry.nombre_estado;
                    p.textContent += index + ". Cambió a estado " + name + " en " + entry.created_at + "\r\n";
                    console.log(entry.created_at);
                    index++;
                });


                const editStatus = $('#editStatus');
                
                // p.innerHTML = products.name.join("<br>") ;
                


                // Actualizar ID de la ruta
                const actionUrl = editStatus.attr('href').replace(/(\/admin\/shipments\/)\d+/, '$1'+shipmentId);
                editStatus.attr('href', actionUrl);

                // Reemplazar el valor del nombre en el input el modal

            });
    </script>



@endsection