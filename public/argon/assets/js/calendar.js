document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",
        headerToolbar: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'prev,next today'
        },
        dateClick: function() {
            alert('a day has been clicked!');
        }

    });
    calendar.render();
});