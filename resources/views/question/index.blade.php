@extends('layouts.argon.app')

@section('title', 'Question')

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Páginas</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Preguntas Frecuentes</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Preguntas</h6>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 ps-3 pe-3 pt-2">
                <div class="card-header pb-0">
                    <h6>Tabla de Preguntas</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <a href="{{ route('preguntas-create') }}" class="btn btn-sm btn-outline-success mb-2">Agregar</a>
                    <div class="table-responsive p-0">
                        <table id="questions-table" class="table display table-striped align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Pregunta</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($frequent_questions as $frequent_question)
                                <tr>
                                    <td class="text-center">{{ $frequent_question->id }}</td>
                                    <td class="text-center">{{ $frequent_question->pregunta }}</td>
                                    <td class="text-center pt-3">
                                        <a href="{{ route('preguntas-edit', ['id' => $frequent_question->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> Editar</a>
                                        <form action="{{ route('preguntas-destroy', ['id' => $frequent_question->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger delete-question" data-id="{{ $frequent_question->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#questions-table').DataTable({
            dom: 'lrtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
        });

        // Eliminar pregunta con SweetAlert
        $('.delete-question').click(function(e) {
            e.preventDefault();
            var deleteForm = $(this).closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, borrarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.submit();
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
</script>
@endsection
