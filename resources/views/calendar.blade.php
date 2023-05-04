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
    </div>


    <!-- Modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
@endsection

@section('js')
<script>
    <script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js
"></script>
</script>
    <script>
        src = "{{ asset('argon/assets/js/calendar.js') }}"
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek',
                    center: 'title',
                  
                    right: 'prev,next today'
                },

            });
            calendar.render();
        });
    </script>
@endsection
