<script type="text/javascript">
    function fetchEvents() {
        $.ajax({
            url: "{{ route('event.get-json') }}", 
            method: "GET", 
            success: function (response) {

                calendar.removeAllEvents();

                response.forEach(function (event) {
                    calendar.addEvent({
                        id: event.id,
                        title: event.title,
                        start: event.start,
                        end: event.end,
                        backgroundColor: '#28a745', 
                    });
                });
            },
            error: function (xhr) {
                console.error("Terjadi kesalahan saat mengambil data acara: ", xhr.responseText);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar'); 
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', 
            events: [], 
        });

        calendar.render();

        fetchEvents();
    });

    $('#refreshButton').on('click', function () {
        fetchEvents(); 
    });
</script>
