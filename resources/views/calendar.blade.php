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
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-4">
                    <div id="calendar"></div>
                    </div>
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
                        <button type="submit" class="btn btn-primary" id="btn-save-event">Guardar</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prevYear,prev,next,nextYear today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                prevYear: 'Año anterior',
                prev: 'Anterior',
                next: 'Siguiente',
                nextYear: 'Año siguiente',
                today: 'Hoy',
                dayGridMonth: 'Mes',
                timeGridWeek: 'Semana',
                timeGridDay: 'Día'
            },
            dateClick: function(info) {
                $("#modal-event").modal("show");
            },
            eventClick: function(info) {
                var event = info.event;
                $("#edit-title").val(event.title);
                $("#edit-description").val(event.extendedProps.description);
                $("#edit-start").val(event.start.toISOString().slice(0, -8));
                $("#edit-end").val(event.end.toISOString().slice(0, -8));
                $("#edit-color").val(event.backgroundColor);
                $("#btn-update-event").attr("data-event-id", event.id);
                $("#modal-edit-event").modal("show");
            },
            events: [
                // Aquí puedes cargar los eventos desde tu controlador o API
                @foreach($events as $event) {
                    id: '{{ $event->id }}',
                    title: '{{ $event->title }}',
                    description: '{{ $event->description }}',
                    start: '{{ $event->start }}',
                    end: '{{ $event->end }}',
                    backgroundColor: '{{ $event->color }}',
                },
                @endforeach
            ],
        });
        calendar.render();


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
                })
                .catch(function(error) {
                    console.log(error);
                });
        });

        $("#edit-event-form").submit(function(e) {
            e.preventDefault();
            var eventId = $("#btn-update-event").attr("data-event-id");
            var formData = $(this).serialize();
            axios.put("{{ route('event.update', '') }}/" + eventId, formData)
                .then(function(response) {
                    $("#modal-edit-event").modal("hide");
                    var event = calendar.getEventById(eventId);
                    event.setProp('title', response.data.title);
                    event.setExtendedProp('description', response.data.description);
                    event.setStart(response.data.start);
                    event.setEnd(response.data.end);
                    event.setProp('backgroundColor', response.data.color);
                })
                .catch(function(error) {
                    console.log(error);
                });
        });

        $("#btn-delete-event").click(function() {
            var eventId = $("#btn-update-event").attr("data-event-id");
            axios.delete("{{ route('event.destroy', '') }}/" + eventId)
                .then(function(response) {
                    $("#modal-edit-event").modal("hide");
                    calendar.getEventById(eventId).remove();
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script>
@endsection