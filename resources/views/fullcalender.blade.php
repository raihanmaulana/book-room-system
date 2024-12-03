<!DOCTYPE html>

<html>

<head>

    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

</head>

<body>



    <div class="container">

        <h1>Laravel FullCalender Tutorial Example - ItSolutionStuff.com</h1>
        <div class="room-buttons">
    <button class="room-btn" data-ruangan_id="1">Room 1</button>
    <!-- Add more rooms as needed -->
</div>
        <div id='calendar'></div>

    </div>

    

    <script>
$(document).ready(function() {

    var SITEURL = "{{ url('/') }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        editable: true,
        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            // Ask for event details
            var title = prompt('Event Title:');
            var ruangan_id = prompt('Ruangan ID:'); // New field
            var user_id = prompt('User ID:'); // New field
            var jam_mulai = prompt('Jam Mulai (HH:MM):');  // New field
            var jam_selesai = prompt('Jam Selesai (HH:MM):'); // New field
            var tanggal_peminjaman = $.fullCalendar.formatDate(start, "Y-MM-DD");

            if (title && ruangan_id && user_id && jam_mulai && jam_selesai) {
                $.ajax({
                    url: SITEURL + "/fullcalenderAjax",
                    data: {
                        title: title,
                        tanggal_peminjaman: tanggal_peminjaman,
                        jam_mulai: jam_mulai,
                        jam_selesai: jam_selesai,
                        ruangan_id: ruangan_id,
                        user_id: user_id,
                        type: 'add'
                    },
                    type: "POST",
                    success: function(data) {
                        displayMessage("Event Created Successfully");

                        calendar.fullCalendar('renderEvent', {
                            id: data.id,
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay,
                            ruangan_id: ruangan_id,
                            user_id: user_id,
                        }, true);

                        calendar.fullCalendar('unselect');
                    }
                });
            }
        },

        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: end,
                    id: event.id,
                    ruangan_id: event.ruangan_id,
                    user_id: event.user_id,
                    type: 'update'
                },
                type: "POST",
                success: function(response) {
                    displayMessage("Event Updated Successfully");
                }
            });
        },

        eventClick: function(event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: event.id,
                        type: 'delete'
                    },
                    success: function(response) {
                        calendar.fullCalendar('removeEvents', event.id);
                        displayMessage("Event Deleted Successfully");
                    }
                });
            }
        }
    });

});

function displayMessage(message) {
    toastr.success(message, 'Event');
}
</script>




</body>

</html>