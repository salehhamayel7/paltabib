<script type="text/javascript">

    $('#calendar').fullCalendar({
    header: {
        left: 'list month',
        center: 'title',
        right: 'prev next'
    },
    height: 600,
    ignoreTimeZone: true,
    navLinks: true,
    editable: true,
    dayClick: function(date) {


        var formattedDate = new Date(date);
        var d = formattedDate.getDate();
        var m = formattedDate.getMonth();
        m += 1; // JavaScript months are 0-11
        var y = formattedDate.getFullYear();
        finalDate = y + "-" + m + "-" + d;
        $('#newEventDate').attr('value', finalDate);
        $('#CalenderModalNew').modal('show');


    },
    eventClick: function(event) {

        $.get("/ajax/appointment/get/" + event.id, function(data) {
            $('#appoinmentID').val(data.appointment.id);
            $('#editEventDate').attr('value', data.appointment.date);
            $('#Eventtitle').selectpicker('val', data.appointment.color);
            $('#Eventtime').val(data.appointment.time);
            $('#Eventdoctor').val(data.doctor.name);
            $('.deleteEvent').attr('data', data.appointment.id);
            if( data.appointment.is_approved){
                $('#approver').css('display','block');
                $('#notapprover').css('display','none');
            }
            else{
                 $('#notapprover').css('display','block');
                $('#approver').css('display','none');
            }

            $('#CalenderModaledit').modal('show');
        });


    },

    eventLimit: true, // for all non-agenda views
    viewRender: function(view, element) {

        $('#calendar').fullCalendar('removeEvents');
        $.get("/ajax/patient/getAppointments", function(data) {
            data.appointments.forEach(function(appointment) {
                var myEvent = {
                    id: appointment.id,
                    title: appointment.title,
                    start: appointment.date,
                    color: appointment.color,
                };
                $('#calendar').fullCalendar('renderEvent', myEvent);
            });
        });


    },
    eventDrop: function(event, delta, revertFunc) {

        $.get("/ajax/appointment/changeDate/" + event.start.format() + "/" + event.id);

    },



});

$(document).ready(function() {

    $('.deleteEvent').on('click', function() {
        var id = $(this).attr('data');

        $.get("/ajax/appointment/delete/" + id);
        $('#calendar').fullCalendar('removeEvents', id);

        $('#CalenderModaledit').modal('hide');
    });


});
</script>