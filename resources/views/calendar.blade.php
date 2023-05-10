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
        <div class="modal fade" id="modal-event" tabindex="-1" aria-labelledby="modal-event-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('calendar_action')}}">
                            <div class="form-group">
                                <label for="">Tittle</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    aria-describedby="helpId" placeholder="Add event title">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Start</label>
                                <input type="text" class="form-control" name="start" id="start"
                                    aria-describedby="helpId" placeholder="Add event title">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                                <label for="">End</label>
                                <input type="text" class="form-control" name="end" id="end"
                                    aria-describedby="helpId" placeholder="Add event title">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnDelete">Delete</button>
                        <button type="button" class="btn btn-primary" id="btnChanges">Changes</button>
                        <button type="submit" class="btn btn-primary" id="btnSave">Save </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para confirmar eliminación de eventos -->

    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let formulario = document.querySelector("form");
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
            document.getElementById("btnSave").addEventListener("click",function(){
                const datos= new FormData(formulario);
                console.log(datos);
            })
        });
    </script>
@endsection
