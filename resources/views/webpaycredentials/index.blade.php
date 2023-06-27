@extends('layouts.argon.app')

@section('title')
    {{ 'WebPay' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">WebPay</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Credenciales Webpay</h6>
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ps-3 pe-3 pt-2">
                    <div class="card-header pb-0">
                        <h6>Tabla de las Credenciales</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <a href="{{ route('webpaycredentials.create') }}"
                            class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                        <div class="table-responsive p-0">
                            <table id="credentials-table" class="table display table-stripped align-items-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Código Comercio</th>
                                        <th class="text-center">Código API</th>
                                        <th class="text-center">Tipo de Integración</th>
                                        <th class="text-center">Ambiente</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($webpayCredentials as $credential)
                                        <tr>
                                            <td class="text-center">{{ $credential->id }}</td>
                                            <td class="text-center">{{ $credential->user->name }}</td>
                                            <td class="text-center">{{ $credential->commerce_code }}</td>
                                            <td class="text-center">{{ $credential->api_key }}</td>
                                            <td class="text-center">{{ $credential->integration_type }}</td>
                                            <td class="text-center">{{ $credential->environment }}</td>
                                            <td class="text-center pt-4">

                                                <a href="{{ route('webpaycredentials.edit', $credential->id) }}"
                                                    class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i>
                                                    Editar</a>
                                                <form action="{{ route('webpaycredentials.destroy', $credential->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger delete-credential"
                                                        data-id="{{ $credential->id }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                                    </button>
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
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            table = $('#credentials-table').DataTable({
                dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
            $('.delete-credential').click(function(event) {
                event.preventDefault();
                var name = $(this).data('name');
                var form = $(this).closest('form');

                Swal.fire({
                    title: '¿Está seguro?',
                    text: 'Se eliminará la credencial "' + name + '"',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 3000, // Tiempo en milisegundos (3 segundos)
                    showConfirmButton: true
                });
            @endif
        });


        $('#searchBar').keyup(function() {
            table.search($(this).val()).draw();
        });
    </script>
@endsection
