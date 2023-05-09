@extends('layouts.argon.app')

@section('title')
    {{ 'Calendar' }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Calendar</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Calendar</h6>
@endsection
@section('css')
    <link href="{{ asset('argon/assets/css/fullcalendar.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Personal Calendar</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal para agregar eventos -->
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form-label">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-form-label">Agregar Evento</h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form id="add-event-form">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label>Fecha y Hora de inicio</label>
                                    <input type="datetime-local" class="form-control" name="start" required>
                                </div>
                                <div class="form-group">
                                    <label>Fecha y Hora de fin</label>
                                    <input type="datetime-local" class="form-control" name="end" required>
                                </div>
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para confirmar eliminación de eventos -->
            <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm-label">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-confirm-label">Confirmar Eliminación</h4>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres eliminar este evento?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

        <script>
            $(document).ready(function() {

                var title;

                var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: '/full-calendar',
                    selectable: true,
                    select: function(start, end, allDay) {

                        $('#modal-form').modal('show'); // muestra el modal

                        $('#title').val('');
                        $('#start').val('');
                        $('#end').val('');

                        $('#save-event').unbind().on('click', function() {
                            title = $('#title').val();
                            if (title) {
                                var start = $.fullCalendar.formatDate($('#start').val(),
                                    'Y-MM-DD HH:mm:ss');
                                var end = $.fullCalendar.formatDate($('#end').val(),
                                    'Y-MM-DD HH:mm:ss');

                                $.ajax({
                                    url: "/full-calendar/action",
                                    type: "POST",
                                    data: {
                                        title: title,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    success: function(data) {
                                        calendar.fullCalendar('refetchEvents');
                                    }
                                });
                            }
                            $('#modal-form').modal('hide');
                        });
                    },
                    editable: true,
                    eventResize: function(event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url: "/full-calendar/action",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                id: id,
                                type: 'update'
                            },
                            success: function(response) {
                                calendar.fullCalendar('refetchEvents');
                            }
                        })
                    },
                    eventDrop: function(event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url: "/full-calendar/action",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                id: id,
                                type: 'update'
                            },
                            success: function(response) {
                                calendar.fullCalendar('refetchEvents');
                            }
                        })
                    },

                    eventClick: function(event) {
                        if (confirm("Are you sure you want to remove it?")) {
                            var id = event.id;
                            $.ajax({
                                url: "/full-calendar/action",
                                type: "POST",
                                data: {
                                    id: id,
                                    type: "delete"
                                },
                                success: function(response) {
                                    calendar.fullCalendar('refetchEvents');
                                }
                            })
                        }
                        $('#modal-confirm').modal('show'); // muestra el modal
                    }
                });

            });
        </script>
    @endsection
