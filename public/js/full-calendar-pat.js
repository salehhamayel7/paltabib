$('#calendar').fullCalendar({
    header: {
        left: 'list month',
        center: 'title',
        right: 'prev next'
    },
    height: 600,
    ignoreTimeZone: true,
    navLinks: true,

    eventClick: function(event) {
        
                $.get("/ajax/appointment/get/" + event.id, function(data) {
                    $('#showEventtime').val(data.appointment.time);
                   
                    var startDate = new Date("1/1/1900 " + data.appointment.time);
                    var endDate = new Date("1/1/1900 " + data.appointment.end_time );
                    var difftime=(endDate - startDate)/60000;
        
                    $('#showduration').val(difftime);
        
                    $('#CalenderModalshow').modal('show');
                });
        
        
            },

    dayClick: function(date) {

        if (!$('#doctor_id').val()) {
            alert('اختر طبيبا قبل القيام باي اكشن');
        } else {
            var formattedDate = new Date(date);
            var d = formattedDate.getDate();
            var m = formattedDate.getMonth();
            m += 1; // JavaScript months are 0-11
            var y = formattedDate.getFullYear();
            finalDate = y + "-" + m + "-" + d;
            $('#newEventDate').attr('value', finalDate);
            $('#CalenderModalNew').modal('show');
        }

    },


    eventLimit: true, // for all non-agenda views
    viewRender: function(view, element) {

        if ($('#doctor_id').val() == "") {

        } else if ($('#doctor_id').val() != "") {

            var doc_user_name = $('#doctorCal').find("option:selected").val();
            $.get("/ajax/appointment/show/" + doc_user_name, function(data) {
                $('#calendar').fullCalendar('removeEvents');
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
        }

    },


});

$(document).ready(function() {


    $('#doctorCal').on('change', function() {
        $('#doctor_id').val($(this).selectpicker('val'));
        var doc_user_name = $(this).find("option:selected").val();
        $('#calendar').fullCalendar('removeEvents');
        $.get("/ajax/appointment/show/" + doc_user_name, function(data) {
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
    });

});