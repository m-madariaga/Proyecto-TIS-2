@extends('layouts.argon.app')

@section('title', 'Calendar')

@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Calendario</li>
</ol>
<h6 class="font-weight-bolder text-white mb-0">Calendario</h6>
@endsection

@section('css')
<link href="{{ asset('argon/assets/css/fullcalendar.css') }}" rel="stylesheet" />

<style>
    #calendar {
        padding: 1px;
    }

    .fc-header-toolbar {
        margin-bottom: 20px;
        text-align: center;
    }

    .fc-header-toolbar .fc-button {
        margin-right: 10px;
        background-color: #8c034e;
        background-image: linear-gradient(#8c034e, #6f023c);
        color: #ffffff;
        border-color: #8c034e;
        border-radius: 3px;
    }

    .fc-header-toolbar .fc-button:hover {
        background-image: linear-gradient(#6f023c, #8c034e);
    }

    .fc-header-toolbar .fc-button-group {
        display: inline-block;
        vertical-align: middle;
    }

    .fc-header-toolbar .fc-button.fc-button-primary {
        background-color: #ffffff;
        background-image: none;
        color: #8c034e;
    }

    .fc-header-toolbar .fc-button.fc-button-primary:hover {
        background-color: #f1f1f1;
    }

    .fc-daygrid-view .fc-toolbar-title {
        display: block;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .fc-daygrid-view .fc-daygrid-day-number {
        position: relative;
    }

    .fc-daygrid-view .fc-daygrid-day-number::before {
        content: attr(data-date);
        position: absolute;
        top: 0;
        right: 0;
        padding: 2px 4px;
        background-color: #8c034e;
        color: #ffffff;
        font-size: 10px;
        border-radius: 3px;
    }

    @media (max-width: 767px) {
        .fc-toolbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 10px;
        }

        .fc-toolbar .fc-toolbar-section {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .fc-toolbar .fc-toolbar-section:first-child {
            margin-right: 10px;
        }

        .fc-toolbar .fc-button {
            margin: 0 5px;
        }

        .fc-header-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .fc-header-toolbar .fc-left,
        .fc-header-toolbar .fc-center,
        .fc-header-toolbar .fc-right {
            flex-basis: 33.33%;
        }

        .fc-toolbar .fc-toolbar-section:nth-child(1),
        .fc-toolbar .fc-toolbar-section:nth-child(2) {
            flex-basis: 100%;
            justify-content: center;
        }

        .fc-toolbar .fc-toolbar-section:nth-child(2) .fc-toolbar-chunk {
            color: #8c034e;
            font-size: 1.2rem;
        }

        /* Estilo del botón "Hoy" */
        .fc-toolbar .fc-toolbar-section:nth-child(2) .fc-today-button {
            border: 1px solid #8c034e;
            padding: 8px 15px;
            font-size: 1.2rem;
        }

    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Calendario personal</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar eventos -->
    <div class="modal fade" id="modal-event" tabindex="-1" aria-labelledby="modal-event-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="event-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start" class="form-label">Comienzo</label>
                            <input type="datetime-local" class="form-control" id="start" name="start" required>
                        </div>
                        <div class="mb-3">
                            <label for="end" class="form-label">Término</label>
                            <input type="datetime-local" class="form-control" id="end" name="end" required>
                        </div>
                        <div class="mb-3 col-sm-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" class="form-control" id="color" name="color" value="#ff0000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar eventos -->
    <div class="modal fade" id="modal-edit-event" tabindex="-1" aria-labelledby="modal-edit-event-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-event-label">Editar evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-event-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-start" class="form-label">Comienzo</label>
                            <input type="datetime-local" class="form-control" id="edit-start" name="start" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-end" class="form-label">Término</label>
                            <input type="datetime-local" class="form-control" id="edit-end" name="end" required>
                        </div>
                        <div class="mb-3 col-sm-3">
                            <label for="edit-color" class="form-label">Color</label>
                            <input type="color" class="form-control" id="edit-color" name="color" value="#ff0000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-delete-event">Eliminar</button>
                        <button type="submit" class="btn btn-primary" id="btn-update-event">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        start: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        end: 'prevYear,prev,next,nextYear'
                    },
                    dateClick: function(info) {
                        $("#modal-event").modal("show");
                    },
                    eventClick: function(info) {
                        var event = info.event;

                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            headerToolbar: {
                                start: 'dayGridMonth,timeGridWeek,timeGridDay',
                                center: 'title',
                                end: 'prevYear,prev,next,nextYear'
                            },
                            dateClick: function(info) {
                                $("#modal-event").modal("show"); // muestra el modal
                            },
                            locale: 'es', // Establece el idioma en español
                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Día',
                                list: 'Lista'
                            },
                            allDayText: 'Todo el día',
                            noEventsText: 'No hay eventos para mostrar',
                            eventTimeFormat: {
                                hour: 'numeric',
                                minute: '2-digit',
                                meridiem: 'short'
                            },
                            weekText: 'Sem',
                            moreLinkText: 'más',
                            eventLimitText: 'más',
                            dayPopoverFormat: 'dddd D [de] MMMM [de] YYYY'
                        });

                        calendar.render();

                        $("#btn-primary").click(function() {

                            var title = $("#title").val();
                            var description = $("#description").val();
                            var start = $("#start").val();
                            var end = $("#end").val();

                            var event = {
                                title: title,
                                description: description,
                                start: start,
                                end: end
                            };

                            calendar.addEvent(event);

                            $("#modal-event").modal("hide");
                        });

                        $("#btn-info").click(function() {
                            $("#modal-event").modal("hide");
                        });

                        $("#modal-edit-event").modal("show");
                    },
                    events: {
                        !!$events - > toJson() !!
                    }
                });

                calendar.render();

                $("#edit-event-form").submit(function(event) {
                    event.preventDefault();

                    $("#event-form").submit(function(e) {
                        e.preventDefault();
                        var formData = $(this).serialize();
                        axios.post("{{ route('event.store') }}", formData)
                            .then(function(response) {
                                $("#modal-event").modal("hide");
                                calendar.addEvent({
                                    id: response.data.id,
                                    title: response.data.title,
                                    description: response.data.description,
                                    start: response.data.start,
                                    end: response.data.end,
                                    backgroundColor: response.data.color,
                                });
                                location.reload(true); // Recargar la página de forma inmediata, omitiendo la caché

                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    });

                    $("#edit-event-form").submit(function(e) {
                        e.preventDefault();
                        var eventId = $("#btn-update-event").attr("data-event-id");

                        var formData = new FormData(this);

                        axios.put('/event/' + eventId, formData)
                            .then(function(response) {
                                $("#modal-edit-event").modal("hide");
                                var event = calendar.getEventById(eventId);
                                event.setProp('title', response.data.title);
                                event.setExtendedProp('description', response.data.description);
                                event.setStart(response.data.start);
                                event.setEnd(response.data.end);
                                event.setProp('backgroundColor', response.data.color);
                                location.reload(true); // Recargar la página de forma inmediata, omitiendo la caché

                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    });

                    $("#btn-delete-event").click(function() {
                        var eventId = $("#btn-update-event").attr("data-event-id");

                        axios.delete('/event/' + eventId)
                            .then(function(response) {
                                $("#modal-edit-event").modal("hide");
                                calendar.getEventById(eventId).remove();
                                location.reload(true); // Recargar la página de forma inmediata, omitiendo la caché

                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    });
                });
</script>
@endsection