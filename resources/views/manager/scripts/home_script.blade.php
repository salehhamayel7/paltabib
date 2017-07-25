<script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.cancelAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });


            $('.approveAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/approve/"+id,function(data){
                   // alert(data.user.name);
                  var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });
            });



            $('.disapprovedAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });


            $('.editEvent').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/event/get/"+id,function(data){
                    
                   $('#eventTitle').val(data.event.event_name);
                     $('#eventTime').val(data.event.time);
                     $('#eventDate').val(data.event.date);
                     $('#eventDescription').val(data.event.event_description);
                     $('#eventAction').html("تعديل");
                     $("#EventForm").attr('action','/event/update/'+data.event.id);
                     $('#eventModalLabel').html("تعديل حدث");
                     $('#addEventModal').modal('show');

                 });

               

            });

            $('.deleteEvent').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/event/delete/"+id,function(data){
                    
                   location.reload();

                 });

               

            });

            $('#get-id').on('click',function(){
               $('#id-form').submit();
            });

        });

    </script>