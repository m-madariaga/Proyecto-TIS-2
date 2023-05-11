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
                <div class="card p-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Personal Calendar</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="calendar">
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('calendar_agregar') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="start" class="form-label">Start</label>
                                <input type="datetime-local" class="form-control" id="start" name="start" required>
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">End</label>
                                <input type="datetime-local" class="form-control" id="end" name="end" required>
                            </div>
                            <div class="mb-3 col-sm-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="color" class="form-control" id="color" name="color" value="#ff0000"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Edit changes</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
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
                    $("#modal-event").modal("show"); // muestra el modal
                }
            });
            calendar.render();
            $("#btn-primary").click(function() {
                // get datos
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

                // add the event to the calendar
                calendar.addEvent(event);

                // hide the modal
                $("#modal-event").modal("hide");
            });
            $("#btn-info").click(function() {
            
                // hide the modal
                $("#modal-event").modal("hide");
            });

        });
    </script>
@endsection
